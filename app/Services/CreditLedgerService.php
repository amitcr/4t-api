<?php
namespace App\Services;

use Illuminate\Database\Capsule\Manager as DB;
use Carbon\Carbon;
use RuntimeException;

/**
 * Credit ledger for affiliates and companies ({prefix}affcp_credit_ledger).
 *
 * API-side mirror of wp-affiliates-coupons' affcp_ledger_post() / affcp_ledger_charge()
 * (includes/ledger-functions.php + class-credit-ledger-db.php). Every change to an affiliate's
 * code credits (`unused_credits`) or earnings (`credits`), or a company's code credits (`credits`),
 * goes through post() / charge(), which in ONE database transaction:
 *
 *   1. lock the account row (SELECT ... FOR UPDATE) and read every bucket balance,
 *   2. build the legs from those locked balances,
 *   3. return the existing entry if the first leg's idempotency key was already posted,
 *   4. apply the legs, update the changed balance columns,
 *   5. insert one ledger entry per leg with the balance it left behind,
 *   6. run an optional callback (e.g. raise a coupon's usage_limit) and commit.
 *
 * Any exception rolls everything back. Keep the bucket map, entry types, charge split and rounding
 * in step with the WordPress side.
 *
 * The table is created by the wp-affiliates-coupons plugin (1.1.2+); the API never changes its schema.
 */
class CreditLedgerService
{
    /** Ledger table, without the WP prefix (the connection adds it). */
    public const TABLE = 'affcp_credit_ledger';

    /**
     * account_type => [table, primary key, bucket => [column, integer]].
     */
    public const ACCOUNTS = [
        'affiliate' => [
            'table'   => 'affcp_wp_affiliates',
            'pk'      => 'affiliate_id',
            'buckets' => [
                'code_credits' => ['column' => 'unused_credits', 'integer' => false],
                'earnings'     => ['column' => 'credits',        'integer' => false],
            ],
        ],
        'company' => [
            'table'   => 'affcp_wp_companies',
            'pk'      => 'company_id',
            'buckets' => [
                'code_credits' => ['column' => 'credits', 'integer' => true],
            ],
        ],
    ];

    public const SOURCES = ['wp_dashboard', 'wp_admin', 'api_cron', 'migration', 'system'];

    /**
     * Posts one change on one bucket.
     *
     * @param string $accountType 'affiliate' or 'company'.
     * @param int    $accountId   Affiliate ID or company ID.
     * @param array  $leg         bucket, entry_type, amount (signed, non-zero), and optionally status,
     *                            reference_type, reference_id, idempotency_key, public_note, admin_note,
     *                            source (default api_cron), actor_user_id.
     * @param array  $options     allow_negative (default true), inside (callable run in the transaction
     *                            after the entries are written; receives the result array).
     * @return array{entry_id:int, balance_after:string, entries:array, duplicate:bool}
     * @throws RuntimeException On invalid input or a database failure (nothing is written).
     */
    public static function post(string $accountType, int $accountId, array $leg, array $options = []): array
    {
        $account = self::account($accountType, $accountId);
        $built   = self::buildLeg($account, $leg);

        return self::postLegs($account, [$built], $options);
    }

    /**
     * Charges an account.
     *
     * Companies: the whole charge comes from code credits. Affiliates: positive code credits first,
     * the rest from earnings (one or two entries); code credits at or below zero are left as they are.
     * Same split as affcp_ledger_charge() on the WordPress side.
     *
     * @param float $amount Positive charge size.
     * @param array $leg    entry_type (default 'charge') and the optional fields of post(); the
     *                      idempotency key goes on the first entry, a second entry gets "<key>:2".
     */
    public static function charge(string $accountType, int $accountId, float $amount, array $leg = [], array $options = []): array
    {
        $account = self::account($accountType, $accountId);
        $charge  = round($amount, 2);

        if ($charge <= 0) {
            throw new RuntimeException('Charge amount must be a positive number.');
        }

        $leg += ['entry_type' => 'charge'];
        $key  = (string) ($leg['idempotency_key'] ?? '');

        $planner = function (array $balances) use ($account, $leg, $charge, $key): array {
            $parts = [];

            if (isset($account['buckets']['earnings'])) {
                $fromCode = min($charge, max(0.0, (float) $balances['code_credits']));
                $rest     = round($charge - $fromCode, 2);
                if ($fromCode > 0) {
                    $parts['code_credits'] = $fromCode;
                }
                if ($rest > 0) {
                    $parts['earnings'] = $rest;
                }
            } else {
                $parts['code_credits'] = $charge;
            }

            $legs = [];
            foreach ($parts as $bucket => $part) {
                $legs[] = self::buildLeg($account, array_merge($leg, [
                    'bucket'          => $bucket,
                    'amount'          => -$part,
                    'idempotency_key' => $key === '' ? null : ($legs ? $key . ':' . (count($legs) + 1) : $key),
                ]));
            }

            return $legs;
        };

        return self::postLegs($account, $planner, $options);
    }

    /**
     * The newest (by date) balance_after of one bucket, or null when it has no entries.
     * Date order, as on the WordPress side: migrated old history can have higher entry IDs
     * than newer entries.
     */
    public static function lastBalance(string $accountType, int $accountId, string $bucket): ?string
    {
        $value = DB::table(self::TABLE)
            ->where(['account_type' => $accountType, 'account_id' => $accountId, 'bucket' => $bucket])
            ->orderByDesc('created_at')
            ->orderByDesc('entry_id')
            ->value('balance_after');

        return $value === null ? null : (string) $value;
    }

    /**
     * Normalises a number to the ledger's 2-decimal string form ("12", "12.5", "-3.25").
     * Trailing zeros are dropped so the text balance columns keep their current look.
     */
    public static function normalise(mixed $value): string
    {
        $number = is_numeric($value) ? round((float) $value, 2) : 0.0;
        $string = rtrim(rtrim(number_format($number, 2, '.', ''), '0'), '.');

        return ($string === '-0' || $string === '') ? '0' : $string;
    }

    // ---------------------------------------------------------------------------------------------

    private static function account(string $accountType, int $accountId): array
    {
        if (!isset(self::ACCOUNTS[$accountType])) {
            throw new RuntimeException('Account type must be affiliate or company.');
        }
        if ($accountId <= 0) {
            throw new RuntimeException('Account ID is required.');
        }

        return self::ACCOUNTS[$accountType] + ['account_type' => $accountType, 'account_id' => $accountId];
    }

    /**
     * Validates one leg and returns it as a ledger row (without balance_after).
     * Amounts on a whole-number bucket (company credits) are rounded, with the original kept in
     * the admin note — that column cannot store decimals.
     */
    private static function buildLeg(array $account, array $leg): array
    {
        $bucket = $leg['bucket'] ?? '';
        if (!isset($account['buckets'][$bucket])) {
            throw new RuntimeException(sprintf('A %s has no %s bucket.', $account['account_type'], $bucket));
        }

        $entryType = strtolower(preg_replace('/[^a-z0-9_\-]/i', '', (string) ($leg['entry_type'] ?? '')));
        if ($entryType === '' || strlen($entryType) > 30) {
            throw new RuntimeException('Entry type is required (30 characters at most).');
        }

        $amountIn = $leg['amount'] ?? null;
        if (!is_numeric($amountIn) || round((float) $amountIn, 2) == 0.0) {
            throw new RuntimeException('Amount must be a non-zero number.');
        }

        $source = $leg['source'] ?? 'api_cron';
        if (!in_array($source, self::SOURCES, true)) {
            throw new RuntimeException('Unknown source.');
        }

        $amount    = self::normalise($amountIn);
        $adminNote = isset($leg['admin_note']) && $leg['admin_note'] !== '' ? (string) $leg['admin_note'] : null;

        if ($account['buckets'][$bucket]['integer'] && str_contains($amount, '.')) {
            $rounded   = self::normalise(round((float) $amount));
            $adminNote = trim(($adminNote ?? '') . ' (amount ' . $amount . ' rounded to ' . $rounded . ': company credits are whole numbers)');
            $amount    = $rounded;
            if ($amount === '0') {
                throw new RuntimeException('Amount rounds to zero on a whole-number balance.');
            }
        }

        $string = static fn($value, int $max) => ($value === null || $value === '') ? null : mb_substr((string) $value, 0, $max);

        return [
            'account_type'    => $account['account_type'],
            'account_id'      => $account['account_id'],
            'bucket'          => $bucket,
            'entry_type'      => $entryType,
            'amount'          => $amount,
            'status'          => (string) ($leg['status'] ?? 'success'),
            'reference_type'  => $string($leg['reference_type'] ?? null, 30),
            'reference_id'    => $string($leg['reference_id'] ?? null, 64),
            'source'          => $source,
            'actor_user_id'   => !empty($leg['actor_user_id']) ? (int) $leg['actor_user_id'] : null,
            'idempotency_key' => $string($leg['idempotency_key'] ?? null, 100),
            'public_note'     => $string(isset($leg['public_note']) ? strip_tags(html_entity_decode((string) $leg['public_note'], ENT_QUOTES)) : null, 255),
            'admin_note'      => $adminNote,
            'created_at'      => Carbon::now('UTC')->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * The transaction itself. $legs is a list of built legs, or a callable(array $balances): array.
     */
    private static function postLegs(array $account, array|callable $legs, array $options): array
    {
        $allowNegative = $options['allow_negative'] ?? true;
        $inside        = $options['inside'] ?? null;

        return DB::connection()->transaction(function () use ($account, $legs, $allowNegative, $inside) {

            $columns = array_map(static fn($b) => $b['column'], $account['buckets']);

            // 1. Lock the account row; concurrent posts for this account wait here.
            $row = DB::table($account['table'])
                ->where($account['pk'], $account['account_id'])
                ->lockForUpdate()
                ->first(array_values(array_unique(array_merge([$account['pk']], $columns))));

            if (!$row) {
                throw new RuntimeException(sprintf('No %s found with ID %d.', $account['account_type'], $account['account_id']));
            }

            $balances = [];
            foreach ($columns as $bucket => $column) {
                $balances[$bucket] = self::normalise($row->{$column});
            }

            // 2. Build the legs from the locked balances.
            $legs = is_callable($legs) ? $legs($balances) : $legs;
            if (!$legs) {
                throw new RuntimeException('There is nothing to post.');
            }
            $legs = array_values($legs);

            // 3. Already posted (cron retry, overlapping run)?
            $firstKey = (string) ($legs[0]['idempotency_key'] ?? '');
            if ($firstKey !== '') {
                $existing = DB::table(self::TABLE)->where('idempotency_key', $firstKey)->first(['entry_id', 'balance_after']);
                if ($existing) {
                    return ['entry_id' => (int) $existing->entry_id, 'balance_after' => self::normalise($existing->balance_after), 'entries' => [], 'duplicate' => true];
                }
            }

            // 4. Apply the legs in order.
            $new = $balances;
            foreach ($legs as $i => $leg) {
                $bucket = $leg['bucket'];
                if ($leg['status'] === 'success') {
                    $new[$bucket] = self::normalise((float) $new[$bucket] + (float) $leg['amount']);
                    if (!$allowNegative && (float) $new[$bucket] < 0) {
                        throw new RuntimeException("This change would take the {$bucket} balance below zero.");
                    }
                }
                $legs[$i]['balance_after'] = $new[$bucket];
            }

            // 5. Update the changed balance columns.
            $changes = [];
            foreach ($account['buckets'] as $bucket => $config) {
                if ($new[$bucket] !== $balances[$bucket]) {
                    $changes[$config['column']] = $config['integer'] ? (int) $new[$bucket] : $new[$bucket];
                }
            }
            if ($changes) {
                DB::table($account['table'])->where($account['pk'], $account['account_id'])->update($changes);
            }

            // 6. One entry per leg.
            $entries = [];
            foreach ($legs as $leg) {
                $row = array_filter($leg, static fn($v) => $v !== null);
                $id  = (int) DB::table(self::TABLE)->insertGetId($row, 'entry_id');
                $entries[] = ['entry_id' => $id, 'bucket' => $leg['bucket'], 'amount' => $leg['amount'], 'balance_after' => $leg['balance_after'], 'row' => $leg];
            }

            $result = [
                'entry_id'      => $entries[0]['entry_id'],
                'balance_after' => end($entries)['balance_after'],
                'entries'       => $entries,
                'duplicate'     => false,
            ];

            // 7. Caller's own writes that must commit or roll back with the balance change.
            if (is_callable($inside)) {
                $inside($result);
            }

            return $result;
        });
    }
}
