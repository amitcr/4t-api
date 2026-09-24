<?php

declare(strict_types=1);

namespace App\Services\Crypto;

use App\Core\Logger;

/**
 * WpCryptoService
 *
 * Replicates the decrypt half of the WordPress plugin's MyTemperament_Crypto class
 * so that /api can read credentials stored encrypted in wp_options without
 * requiring a full WordPress bootstrap.
 *
 * Algorithm: AES-256-CBC
 * Key:       SHA-256( AUTH_KEY . SECURE_AUTH_KEY . siteurl )
 *              - AUTH_KEY and SECURE_AUTH_KEY are parsed from wp-config.php via regex.
 *              - siteurl is read from the wp_options table via get_settings_option().
 *
 * Format:    mytemp_enc::<base64( IV[16 bytes] . ciphertext )>
 *
 * If a stored value does not start with the prefix it is returned as-is,
 * matching the WP class's plain-text legacy fallback behaviour.
 *
 * @since 2.0
 */
class WpCryptoService
{
    private const CIPHER    = 'aes-256-cbc';
    private const IV_LENGTH = 16;
    private const PREFIX    = 'mytemp_enc::';

    /** Cached derived key to avoid repeated file reads per request. */
    private static ?string $cachedKey = null;

    /**
     * Decrypts a value that was encrypted by MyTemperament_Crypto::encrypt().
     *
     * @param  string $stored The value read from wp_options (may be encrypted or plain-text).
     * @return string Decrypted plaintext, or the original value if not encrypted, or '' on failure.
     */
    public static function decrypt(string $stored): string
    {
        if (empty($stored)) {
            return '';
        }

        // Plain-text fallback — value was saved before encryption was introduced.
        if (strpos($stored, self::PREFIX) !== 0) {
            return $stored;
        }

        $encoded = substr($stored, strlen(self::PREFIX));
        $decoded = base64_decode($encoded, true);

        if ($decoded === false || strlen($decoded) <= self::IV_LENGTH) {
            Logger::error('WpCryptoService: base64 decode failed or payload too short.');
            return '';
        }

        $key = self::deriveKey();

        if (empty($key)) {
            return '';
        }

        $iv         = substr($decoded, 0, self::IV_LENGTH);
        $ciphertext = substr($decoded, self::IV_LENGTH);

        $plaintext = openssl_decrypt($ciphertext, self::CIPHER, $key, OPENSSL_RAW_DATA, $iv);

        return ($plaintext === false) ? '' : $plaintext;
    }

    // ── Private helpers ───────────────────────────────────────────────────────

    /**
     * Derives the 32-byte AES key using the same formula as the WP plugin.
     * Result is cached for the lifetime of the request.
     */
    private static function deriveKey(): string
    {
        if (self::$cachedKey !== null) {
            return self::$cachedKey;
        }

        $authKey       = self::readWpConfigConstant('AUTH_KEY');
        $secureAuthKey = self::readWpConfigConstant('SECURE_AUTH_KEY');
        $siteUrl       = (string) get_settings_option('siteurl');

        if (empty($authKey) || empty($secureAuthKey) || empty($siteUrl)) {
            Logger::error('WpCryptoService: AUTH_KEY, SECURE_AUTH_KEY, or siteurl is missing — cannot derive decryption key.');
            return '';
        }

        self::$cachedKey = hash('sha256', $authKey . $secureAuthKey . $siteUrl, true);

        return self::$cachedKey;
    }

    /**
     * Reads a define()'d constant value from wp-config.php using regex.
     * The file is read but never executed, so no WP globals are side-effected.
     *
     * Handles both single- and double-quoted values and optional whitespace.
     *
     * @param  string $constant e.g. 'AUTH_KEY'
     * @return string           The constant value, or '' if not found.
     */
    private static function readWpConfigConstant(string $constant): string
    {
        $configPath = defined('PROJECT_ROOT')
            ? rtrim((string) PROJECT_ROOT, '/\\') . DIRECTORY_SEPARATOR . 'wp-config.php'
            : '';

        if (empty($configPath) || !is_readable($configPath)) {
            Logger::error("WpCryptoService: wp-config.php not readable at [{$configPath}].");
            return '';
        }

        $content = file_get_contents($configPath);

        if ($content === false) {
            Logger::error('WpCryptoService: failed to read wp-config.php.');
            return '';
        }

        // Matches: define( 'CONSTANT', 'value' );  and  define("CONSTANT", "value");
        $pattern = '/define\s*\(\s*[\'"]' . preg_quote($constant, '/') . '[\'"]\s*,\s*[\'"]([^\'"]+)[\'"]\s*\)/';

        if (preg_match($pattern, $content, $matches) === 1) {
            return $matches[1];
        }

        Logger::error("WpCryptoService: constant [{$constant}] not found in wp-config.php.");
        return '';
    }
}
