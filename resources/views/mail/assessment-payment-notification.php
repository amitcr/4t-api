<!doctype html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Simple Transactional Email</title>
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
                    <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">Please find your payment confirmation details of Four Temperaments.</span>
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
                                                <h3 style="margin-bottom: 16px;font-family: Helvetica, sans-serif;  font-weight: bold;font-size: 20px;text-align:left;margin: 0;padding-bottom: 15px; color: #001c40;">Hi <?=$assessment->user ? $assessment->user->display_name : $assessment->first_name?>,</h3>
                                                <p style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: normal; margin: 0; margin-bottom: 16px;">
                                                    Thank you for your purchase of the MyTemperament<sup>TM</sup>
                                                    Assessment. Your receipt is below.
                                                </p>
                                                <?php if(!isset($holdReport) || $holdReport == false){ ?>
                                                    <p style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: normal; margin: 0; margin-bottom: 16px;">To download your report, click on the button below.</p>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <?php if(!isset($holdReport) || $holdReport == false){ ?>
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; width: 100%; min-width: 100%;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="left" style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top; padding-bottom: 16px;" valign="top">
                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top; border-radius: 4px; text-align: left; background-color: #d15d72; color:#fff;" valign="top" align="center" bgcolor="#d15d72">
                                                                    <a href="<?=get_settings_option('home').'/assessments/pdf/'.$personalReportName?>" target="_blank" style="border: solid 2px #0867ec; border-radius: 4px; box-sizing: border-box; cursor: pointer; display: inline-block; font-size: 16px; font-weight: bold; margin: 0; padding: 12px 24px; text-decoration: none; text-transform: capitalize; background-color: #0867ec; border-color: #0867ec; color: #ffffff;">Download Your Report</a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <?php } ?>

                                <h3 style="font-family: Helvetica, sans-serif;  font-weight: bold;font-size: 20px;text-align:left;margin: 0;padding-bottom: 5px; margin-top: 20px; color: #001c40;">Order Summary</h3>
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="width:100%;border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin-bottom: 20px; border: 1px solid #d3d3d3; font-size:14px; color:#000;">
                                    <thead>
                                        <tr>
                                            <th width="40%" align="left" bgcolor="#f6f6f6" valign="middle" style="border-collapse:collapse;background-color:#f6f6f6;padding:12px 8px;">
                                                <p style="text-align:left;Margin-top:0px;Margin-bottom:0px;font-family: Helvetica, sans-serif; vertical-align: top;color:#000">Item</p>
                                            </th>
                                            <th width="20%" align="center" bgcolor="#f6f6f6" valign="middle" style="border-collapse:collapse;background-color:#f6f6f6;padding:12px 8px;border-left:1px solid #d3d3d3;">
                                                <p style="text-align:center;Margin-top:0px;Margin-bottom:0px;font-family: Helvetica, sans-serif; vertical-align: top;color:#000">Quantity</p>
                                            </th>
                                            <th width="20%" align="center" bgcolor="#f6f6f6" valign="middle" style="border-collapse:collapse;background-color:#f6f6f6;padding:12px 8px;border-left:1px solid #d3d3d3;">
                                                <p style="text-align:center;Margin-top:0px;Margin-bottom:0px;font-family: Helvetica, sans-serif; vertical-align: top;color:#000">Payment Date</p>
                                            </th>
                                            <th width="20%" align="center" bgcolor="#f6f6f6" valign="middle" style="border-collapse:collapse;background-color:#f6f6f6;padding:12px 8px;border-left:1px solid #d3d3d3;">
                                                <p style="text-align:center;Margin-top:0px;Margin-bottom:0px;font-family: Helvetica, sans-serif; vertical-align: top;color:#000">Price</p>
                                            </th>
                                        </tr>
                                    </thead>
                                    <?php $global_static_price = get_settings_option('mytemp_settings.global_static_price'); ?>
                                    <tbody>
                                        <tr>
                                            <td valign="top" align="left" style="padding:12px 8px;border-collapse:collapse;border-bottom:1px solid #d3d3d3">
                                                <p style="text-align:left;Margin-top:0px;Margin-bottom:0px;font-family: Helvetica, sans-serif; vertical-align: top;">MyTemperament<sup>TM</sup> Assessment</p>
                                            </td>
                                            <td valign="top" style="padding:12px 8px;border-collapse:collapse;border-left:1px solid #d3d3d3;border-bottom:1px solid #d3d3d3" align="center">
                                                <p style="text-align:center;Margin-top:0px;Margin-bottom:0px;font-family: Helvetica, sans-serif; vertical-align: top;">1</p>
                                            </td>
                                            <td valign="top" style="padding:12px 8px;border-collapse:collapse;border-left:1px solid #d3d3d3;border-bottom:1px solid #d3d3d3" align="center">
                                                <p style="text-align:center;Margin-top:0px;Margin-bottom:0px;font-family: Helvetica, sans-serif; vertical-align: top;"> 
                                                    <?=date("m-d-Y", strtotime($assessment->payment->payment_datetime))?>
                                                </p>
                                            </td>
                                            <td style="padding:12px 8px;text-align:right;border-collapse:collapse;border-left:1px solid #d3d3d3;border-bottom:1px solid #d3d3d3">
                                                <p style="text-align:right;margin-top: 0px;margin-bottom: 5px;font-family:'Open Sans', sans-serif;font-size:14px;line-height:14px;color:#343a40">
                                                    <?="$".number_format( $global_static_price, 2 )?>
                                                </p>
                                            </td>
                                        </tr>

                                        <?php 
                                        $assessment_price = get_settings_option('mytemp_settings.assessment_price');
                                        if(!empty($global_static_price) && $global_static_price > $assessment_price){
                                            $global_static_discount = $global_static_price - $assessment_price;
                                        ?>
                                            <tr>
                                                <td colspan="2" bgcolor="#ffffff" align="left" style="padding:12px 8px;border-collapse:collapse;text-align:left;vertical-align:top">
                                                    <p style="text-align:left;Margin-top:0px;Margin-bottom:0px;font-family: Helvetica, sans-serif; vertical-align: top;color:#000">DISCOUNT</p>
                                                </td>
                                                <td colspan="2" align="right" bgcolor="#ffffff" style="padding:12px 8px;border-collapse:collapse;text-align:right;vertical-align:top">
                                                    <p style="text-align:right;Margin-top:0px;Margin-bottom:0px;font-family: Helvetica, sans-serif; vertical-align: top;">
                                                        <strong style="color:#000; font-weight:bold;">
                                                            <?="-$".number_format( $global_static_discount, 2)?>
                                                        </strong>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" bgcolor="#ffffff" align="left" style="padding:12px 8px;border-collapse:collapse;text-align:left;vertical-align:top">
                                                    <p style="text-align:left;Margin-top:0px;Margin-bottom:0px;font-family: Helvetica, sans-serif; vertical-align: top;color:#000">Sub Total</p>
                                                </td>
                                                <td colspan="2" align="right" bgcolor="#ffffff" style="padding:12px 8px;border-collapse:collapse;text-align:right;vertical-align:top">
                                                    <p style="text-align:right;Margin-top:0px;Margin-bottom:0px;font-family: Helvetica, sans-serif; vertical-align: top;">
                                                        <strong style="color:#000; font-weight:bold;">
                                                            <?="$".number_format( $assessment_price,2)?>
                                                        </strong>
                                                    </p>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        
                                        <?php 
                                        if(isset($assessmentCoupons) && $assessmentCoupons->isNotEmpty()){
                                            foreach($assessmentCoupons as $index=>$couponRow){
                                                ?>
                                                <tr>
                                                    <td colspan="2" bgcolor="#ffffff" align="left" style="padding:12px 8px;border-collapse:collapse;text-align:left;vertical-align:top">
                                                        <p style="text-align:left;Margin-top:0px;Margin-bottom:0px;font-family: Helvetica, sans-serif; vertical-align: top;color:#000">
                                                            Code (<strong style="color:#64bf79; font-wight: bold;"><?=$couponRow->coupon->coupon_code?></strong>) Applied:
                                                        </p>
                                                    </td>
                                                    <td colspan="2" align="right" bgcolor="#ffffff" style="padding:12px 8px;border-collapse:collapse;text-align:right;vertical-align:top">
                                                        <p style="text-align:right;Margin-top:0px;Margin-bottom:0px;font-family: Helvetica, sans-serif; vertical-align: top;">
                                                            <strong style="color:#000; font-weight:bold;">
                                                                <?="-$".number_format( $couponRow->coupon->discount_amount, 2)?>
                                                            </strong>
                                                        </p>
                                                    </td>
                                                </tr>
                                                <?php 
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="2" bgcolor="#ffffff" align="left" style="padding:12px 8px;border-collapse:collapse;text-align:left;vertical-align:top">
                                                <p style="text-align:left;Margin-top:0px;Margin-bottom:0px;font-family: Helvetica, sans-serif; vertical-align: top;color:#000; font-weight:bold;">
                                                    Total:
                                                </p>
                                            </td>
                                            <td colspan="2" align="right" bgcolor="#ffffff" style="padding:12px 8px;border-collapse:collapse;text-align:right;vertical-align:top">
                                                <p style="text-align:right;Margin-top:0px;Margin-bottom:0px;font-family: Helvetica, sans-serif; vertical-align: top;color:#000; font-weight:bold;">
                                                    <?="$".number_format( $assessment->payment->end_price, 2)?>
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <?php 
                                if(isset($promotionalCoupon) && !empty($promotionalCoupon)){
                                ?>
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; width: 100%; min-width: 100%; margin-top:30px;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="left" style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top; padding-bottom: 5px;" valign="top">
                                                    <h3 style="font-family: Helvetica, sans-serif;  font-weight: bold;font-size: 20px;text-align:left;margin: 0;padding-bottom: 5px; margin-top: 20px; color: #001c40;">Share with Others</h3>
                                                    <p style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: normal; margin: 0; margin-bottom: 16px; line-height: 24px;">As a token of our appreciation, we're excited to offer you a special link to share. Your friends, loved ones, and co-workers can access our comprehensive online personality assessment and receive their Personal Report, for just $<?=$promotionalCoupon->end_price?> - a $<?=$promotionalCoupon->discount_amount?> discount off the regular price!</p>

                                                    
                                                    <div style="width:100%; display:inline-block; padding-bottom:25px;">
                                                        <div style="width:6%; display:inline-block; vertical-align: middle;">
                                                            <img src="<?=get_settings_option('home')?>/wp-content/plugins/wp-affiliates-coupons/assets/images/share-from-square-solid.png" style="width:100%;"/> 
                                                        </div>
                                                        <div style="width:90%; display:inline-block; vertical-align: middle; padding-left:10px;">
                                                            <div style="font-weight:bold; font-size:17px; margin-bottom:3px;">Click below to get your exclusive link:</div>
                                                            <div style="font-weight:bold; font-size:16px;"><a href="<?=strtolower(get_settings_option('home').'/share/?src='.$assessment->participant_id.'q' )?>" style="color:#41afef !important;"><?=strtolower(get_settings_option('home').'/share/?src='.$assessment->participant_id.'q' )?></a></div>
                                                        </div> 
                                                    </div>  
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <?php } ?>

                                <p style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: normal; margin: 0; margin-bottom: 16px; color:#000;">
                                    If you have questions, <a style="color:#4688dd" href="<?=get_settings_option('home')?>/contact" target="_blank">please click here to contact us</a>
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