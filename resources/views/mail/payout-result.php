<?php
$amount  = '$' . number_format((float) $payout->amount, 2);
$account = htmlspecialchars((string) $payout->paypal_email, ENT_QUOTES, 'UTF-8');
?>
<!doctype html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Your withdrawal</title>
</head>

<body style="font-family: Helvetica, Arial, sans-serif; font-size: 16px; line-height: 1.4; color: #333; background-color: #f4f5f6; margin: 0; padding: 24px;">
    <div style="max-width: 600px; margin: 0 auto; background: #fff; border: 1px solid #eaebed; border-radius: 16px; padding: 24px;">
        <?php if ($status === 'paid') : ?>
            <p>Your withdrawal of <?= $amount ?> has been paid to your PayPal account <?= $account ?>.</p>
        <?php else : ?>
            <p>PayPal could not complete your withdrawal of <?= $amount ?> to <?= $account ?>, and the amount is back in your balance.</p>
            <p>Please check your PayPal account, then request it again.</p>
        <?php endif; ?>
    </div>
</body>

</html>
