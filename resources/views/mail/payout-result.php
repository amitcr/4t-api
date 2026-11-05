<?php
/**
 * Paid and returned withdrawal emails, in the participant report email's layout. WordPress sends the
 * same emails from affcp_payout_email_affiliate(): keep the wording in step.
 *
 * @var object $payout  Payout row.
 * @var string $status  'paid' or 'returned'.
 * @var string $name    Affiliate's name.
 * @var string $payoutsUrl Payouts page.
 */
$esc    = static fn($value) => htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
$money  = static fn($value) => '$' . number_format((float) $value, 2);
$date   = static fn($value) => empty($value) ? '' : date('F j, Y', strtotime($value . ' UTC'));
$amount = $money($payout->amount);
$fee    = (float) ($payout->fee ?? 0);
$paysFee = ($payout->fee_payer ?? '') === 'affiliate' && $fee > 0;

$details = ['Withdrawal ID' => '#' . ($payout->payout_id ?? ''), 'Requested on' => $date($payout->requested_at ?? '')];

if ($status === 'paid') {
    $details['Paid on'] = $date($payout->paid_at ?? '');
}

$details['Amount'] = $amount;

if ($paysFee) {
    $details['Fee'] = $money($fee);
    $details[$status === 'paid' ? 'You received' : 'Amount sent'] = $money((float) $payout->amount - $fee);
}

$details['PayPal account'] = $payout->paypal_email ?? '';

if ($status === 'paid' && !empty($payout->paypal_item_id)) {
    $details['PayPal reference'] = $payout->paypal_item_id;
}

$email = $status === 'paid' ? [
    'title'     => 'Your withdrawal has been paid',
    'preheader' => "Your withdrawal of {$amount} has been paid.",
    'heading'   => 'Your Withdrawal Has Been Paid',
    'intro'     => ["Good news! Your withdrawal of {$amount} has been sent to your PayPal account. Here are the details:"],
    'outro'     => ['The payment should appear in your PayPal account shortly. You can see all your withdrawals in your dashboard.'],
] : [
    'title'     => 'Your withdrawal was returned',
    'preheader' => "Your withdrawal of {$amount} was returned, and the amount is back in your balance.",
    'heading'   => 'Your Withdrawal Was Returned',
    'intro'     => ["PayPal could not complete your withdrawal of {$amount}, so the full amount is back in your available balance. Here are the details:"],
    'outro'     => ['This can happen when a PayPal account is limited, or when a payment is not claimed within 30 days. Please check your PayPal account, then request the withdrawal again from your dashboard.'],
];

$email += [
    'greeting'     => 'Hello ' . ($name ?? ''),
    'details'      => $details,
    'button_url'   => $payoutsUrl ?? '',
    'button_label' => 'View Your Withdrawals',
];
?>
<!doctype html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo $esc( $email['title'] ); ?></title>
    <style media="all" type="text/css">
    @media all {
        .btn-primary table td:hover {
            background-color: #0867ec !important;
        }

        .btn-primary a:hover {
            background-color: #0867ec !important;
            border-color: #0867ec !important;
        }
    }

    @media only screen and (max-width: 640px) {

        .main p,
        .main td,
        .main span {
            font-size: 16px !important;
        }

        .wrapper {
            padding: 8px !important;
        }

        .content {
            padding: 0 !important;
        }

        .container {
            padding: 0 !important;
            padding-top: 8px !important;
            width: 100% !important;
        }

        .main {
            border-left-width: 0 !important;
            border-radius: 0 !important;
            border-right-width: 0 !important;
        }

        .btn table {
            max-width: 100% !important;
            width: 100% !important;
        }

        .btn a {
            font-size: 16px !important;
            max-width: 100% !important;
            width: 100% !important;
        }
    }

    @media all {
        .ExternalClass {
            width: 100%;
        }

        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
            line-height: 100%;
        }

        .apple-link a {
            color: inherit !important;
            font-family: inherit !important;
            font-size: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            text-decoration: none !important;
        }

        #MessageViewBody a {
            color: inherit;
            text-decoration: none;
            font-size: inherit;
            font-family: inherit;
            font-weight: inherit;
            line-height: inherit;
        }
    }
    </style>
</head>

<body style="font-family: Helvetica, sans-serif; -webkit-font-smoothing: antialiased; font-size: 16px; line-height: 1.3; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #fff; margin: 0; padding: 0;">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fff; width: 100%;" width="100%" bgcolor="#fff">
        <tr>
            <td style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top;" valign="top">&nbsp;</td>
            <td class="container" style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top; max-width: 600px; padding: 0; padding-top: 24px; width: 600px; margin: 0 auto;" width="600" valign="top">
                <div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 600px; padding: 0;">

                    <!-- START CENTERED WHITE CONTAINER -->
                    <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;"><?php echo $esc( $email['preheader'] ); ?></span>
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #ffffff; width: 100%;" width="100%">

                        <!-- START MAIN CONTENT AREA -->
                        <tr>
                            <td class="content-block" style="font-family: Helvetica, sans-serif; vertical-align: top; color: #9a9ea6; font-size: 16px; text-align: center; padding-bottom:15px;padding-top:20px;" valign="top" align="center">
                                <img src="<?=get_app_option('app_logo')?>" style="width:50%;" />
                            </td>
                        </tr>

                        <tr>
                            <td class="wrapper" style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top; box-sizing: border-box; padding: 24px;" valign="top">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; width: 100%; min-width: 100%;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td align="left" style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top; padding-bottom: 5px;" valign="top">
                                                <h3 style="margin-bottom: 16px;font-family: Helvetica, sans-serif;  font-weight: bold;font-size: 20px;text-align:left;margin: 0;padding-bottom: 15px; color: #001c40;"><?php echo $esc( $email['greeting'] ); ?></h3>
                                                <h4 style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: bold; margin: 0; margin-bottom: 16px;"><?php echo $esc( $email['heading'] ); ?></h4>
                                                <?php foreach ( $email['intro'] as $line ) : ?>
                                                <p style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: normal; margin: 0; margin-bottom: 16px;"><?php echo $esc( $line ); ?></p>
                                                <?php endforeach; ?>
                                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; margin: 0 0 20px;" width="100%"><?php foreach ( $email['details'] as $label => $value ) : ?><tr><td style="font-family: Helvetica, sans-serif; font-size: 15px; color: #555; padding: 10px 12px; border: 1px solid #e3e6e8; background: #f4f6f7; width: 42%;" width="42%"><?php echo $esc( $label ); ?></td><td style="font-family: Helvetica, sans-serif; font-size: 15px; color: #001c40; padding: 10px 12px; border: 1px solid #e3e6e8; font-weight: bold; word-break: break-word;"><?php echo $esc( $value ); ?></td></tr><?php endforeach; ?></table>
                                                <?php foreach ( $email['outro'] as $line ) : ?>
                                                <p style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: normal; margin: 0; margin-bottom: 16px;"><?php echo $esc( $line ); ?></p>
                                                <?php endforeach; ?>
                                                <?php if ( ! empty( $email['button_url'] ) ) : ?>
                                                <p style="margin: 8px 0 24px;"><a href="<?php echo $esc( $email['button_url'] ); ?>" target="_blank" style="display: inline-block; font-size: 18px; font-family:'Open Sans', sans-serif !important;padding: 10px 20px;line-height: normal;border-radius: 1px!important;color: #fff;background-color: #007bff;border-color: #007bff;text-decoration:none;text-transform: uppercase;"><?php echo $esc( $email['button_label'] ); ?></a></p>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <p style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: normal; margin: 0; margin-bottom: 16px;">If you have questions, please visit us online at <a href="<?=get_settings_option('home')?>" target="_blank"><?=get_settings_option('home')?></a></p>
                            </td>
                        </tr>

                        <!-- END MAIN CONTENT AREA -->
                    </table>

                    <!-- START FOOTER -->
                    <div class="footer" style="clear: both; padding: 24px 0px; text-align: center; width: 100%; background:#f4f4f4;">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" width="100%">
                            <tr>
                                <td class="content-block" style="font-family: Helvetica, sans-serif; vertical-align: top; color: #9a9ea6; font-size: 16px; text-align: center;" valign="top" align="center">
                                    <span class="apple-link" style="color: #9a9ea6; font-size: 16px; text-align: center;">4848 Lemmon Ave. STE 152, Dallas, Texas 75219</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="content-block powered-by" style="font-family: Helvetica, sans-serif; vertical-align: top; color: #9a9ea6; font-size: 16px; text-align: center;" valign="top" align="center">Powered by <a href="<?=get_settings_option('home')?>" style="color: #9a9ea6; font-size: 16px; text-align: center; text-decoration: none;"><?=get_settings_option('blogname')?></a></td>
                            </tr>
                        </table>
                    </div>

                    <!-- END FOOTER -->

                    <!-- END CENTERED WHITE CONTAINER -->
                </div>
            </td>
            <td style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top;" valign="top">&nbsp;
            </td>
        </tr>
    </table>
</body>

</html>