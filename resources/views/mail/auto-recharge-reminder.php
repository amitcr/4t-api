<!doctype html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Code Auto Recharge Reminder Notification</title>
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
                    <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">We’ll auto-recharge your code soon using your saved payment method.</span>
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
                                                <h3 style="margin-bottom: 16px;font-family: Helvetica, sans-serif;  font-weight: bold;font-size: 20px;text-align:left;margin: 0;padding-bottom: 15px; color: #001c40;">Dear <?=$coupon->user->display_name?>,</h3>
                                                <p style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: normal; margin: 0; margin-bottom: 16px;">
                                                Just a quick heads-up: your prepaid code <?=$coupon->coupon_code?> is running low. Since auto-recharge is enabled, we’ll automatically top it off using your saved payment method when usage runs out.
                                                </p>
                                                <p style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: normal; margin: 0; margin-bottom: 0;">
                                                    <strong>Current Usage Summary:</strong>
                                                </p>
                                                <ul style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: normal; margin: 0; margin-bottom: 16px;">
                                                    <li><strong>Usage Limit:</strong> <?=$coupon->usage_limit?></li>
                                                    <li><strong>Used:</strong> <?=$coupon->usage_count?></li>
                                                    <li><strong>Remaining:</strong> <?=( $coupon->usage_limit - $coupon->usage_count) ?></li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>


                                <p style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: normal; margin: 0; margin-bottom: 16px; color:#000;">No action is required unless you want to update your payment method, disable auto-recharge, or adjust the code settings.</p>
                                <p style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: normal; margin: 0; margin-bottom: 16px; color:#000;">
                                    <?php 
                                    if(!empty($coupon->affiliate) && $coupon->user_id == $coupon->affiliate->user_id){
                                        $user_dashboard = get_settings_option('home').'/affiliate-area/?tab=coupons';
                                    }else if(!empty($coupon->company) && $coupon->user_id == $coupon->company->user_id){
                                        $user_dashboard = get_settings_option('home').'/company-area/?tab=coupons';
                                    }
                                    ?>
                                    You can log in to your account to make any changes: <a style="color:#4688dd" href="<?=$user_dashboard?>" target="_blank"><?=$user_dashboard?></a>
                                </p>
                                <p style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: normal; margin: 0; margin-bottom: 16px; color:#000;">
                                    If you have any questions, please email <a href="mailto:support@fourtemperaments.com">support@fourtemperaments.com</a>
                                </p>
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
                                <td class="content-block powered-by" style="font-family: Helvetica, sans-serif; vertical-align: top; color: #9a9ea6; font-size: 16px; text-align: center;" valign="top" align="center"> 
                                    Powered by <a href="<?=get_settings_option('home')?>" style="color: #9a9ea6; font-size: 16px; text-align: center; text-decoration: none;"><?=get_settings_option('blogname')?></a>
                                </td>
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