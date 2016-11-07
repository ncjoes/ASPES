<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Mail from {{config('app.name')}}</title>

        <style type="text/css">
            /* Client-specific Styles */
            div, p, a, li, td { -webkit-text-size-adjust:none; }
            #outlook a {padding:0;} /* Force Outlook to provide a "view in browser" menu link. */
            html{width: 100%; }
            body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}
            /* Prevent Webkit and Windows Mobile platforms from changing default font sizes, while not breaking desktop design. */
            .ExternalClass {width:100%;} /* Force Hotmail to display emails at full width */
            .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing. */
            #backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
            img {outline:none; text-decoration:none;border:none; -ms-interpolation-mode: bicubic;}
            a img {border:none;}
            .image_fix {display:block;}
            p {margin: 0px 0px !important;}
            table td {border-collapse: collapse;}
            table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }
            a {color: #0099cc;text-decoration: none;text-decoration:none!important;}
            /*STYLES*/
            table[class=full] { width: 100%; clear: both; }
            /*IPAD STYLES*/
            @media only screen and (max-width: 640px) {
                a[href^="tel"], a[href^="sms"] {
                    text-decoration: none;
                    color: #0099cc; /* or whatever your want */
                    pointer-events: none;
                    cursor: default;
                }
                .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
                    text-decoration: default;
                    color: #0099cc !important;
                    pointer-events: auto;
                    cursor: default;
                }
                table[class=devicewidth] {width: 440px!important;text-align:center!important;}
                table[class=devicewidthinner] {width: 420px!important;text-align:center!important;}
                img[class=banner] {width: 440px!important; height: auto!important;}
                img[class=col2img] {width: 440px!important;height:220px!important;}
                img[class=book] {width: 140px!important;}

            }
            /*IPHONE STYLES*/
            @media only screen and (max-width: 480px) {
                a[href^="tel"], a[href^="sms"] {
                    text-decoration: none;
                    color: #0099cc; /* or whatever your want */
                    pointer-events: none;
                    cursor: default;
                }
                .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
                    text-decoration: default;
                    color: #0099cc !important;
                    pointer-events: auto;
                    cursor: default;
                }
                table[class=devicewidth] {width: 280px!important;text-align:center!important;}
                table[class=devicewidthinner] {width: 260px!important;text-align:center!important;}
                img[class=banner] {width: 280px!important; height: auto!important;}
                img[class=col2img] {width: 280px!important;height:140px!important;}
                img[class=book] {width: 140px!important;}


            }
        </style>
    </head>
    <body>
        <!-- Start of preheader -->
        <table width="100%" bgcolor="#fcfcfc" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="preheader" >
            <tbody>
                <tr>
                    <td>
                        <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                            <tbody>
                                <tr>
                                    <td width="100%">
                                        <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                                            <tbody>
                                                <!-- Spacing -->
                                                <tr>
                                                    <td width="100%" height="20"></td>
                                                </tr>
                                                <!-- Spacing -->
                                                <tr>
                                                    <td width="100%" align="left" valign="middle" style="font-family: Helvetica, arial, sans-serif; font-size: 13px;color: #282828" st-content="preheader">
                                                        Can't see this Email? View it in your <a href="{{url('mail/'.$slug)}}" style="text-decoration: none; color: #0099cc">Browser </a>
                                                    </td>
                                                </tr>
                                                <!-- Spacing -->
                                                <tr>
                                                    <td width="100%" height="20"></td>
                                                </tr>
                                                <!-- Spacing -->
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- End of preheader -->
        <!-- Start of header -->
        <table width="100%" bgcolor="#fcfcfc" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="header">
            <tbody>
                <tr>
                    <td>
                        <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                            <tbody>
                                <tr>
                                    <td width="100%">
                                        <table width="600" bgcolor="#0099cc" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <!-- logo -->
                                                        <table bgcolor="#ffffff" width="140" align="left" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="140" height="50" align="center">
                                                                        <div class="imgpop">
                                                                            <a target="_blank" href="#">
                                                                                <img src="{{url('/images/logo.png')}}" alt="" border="0" width="140" height="50" style="display:block; border:none; outline:none; text-decoration:none;">
                                                                            </a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!-- end of logo -->
                                                        <!-- start of menu -->
                                                        <table bgcolor="#0099cc" width="250" height="50" border="0" align="right" valign="middle" cellpadding="0" cellspacing="0" border="0" class="devicewidth">
                                                            <tbody>
                                                                <tr>
                                                                    <td height="50" align="center" valign="middle" style="font-family: Helvetica, arial, sans-serif; font-size: 13px;color: #ffffff" st-content="menu">
                                                                        <a href="{{url('/')}}" style="color: #ffffff;text-decoration: none;">Home</a>
                                                                        &nbsp;&nbsp;&nbsp;
                                                                        <a href="{{url('explorer')}}" style="color: #ffffff;text-decoration: none;">Explore</a>
                                                                        &nbsp;&nbsp;&nbsp;
                                                                        <a href="{{url('contact')}}" style="color: #ffffff;text-decoration: none;">Contact</a>
                                                                        &nbsp;&nbsp;&nbsp;
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!-- end of menu -->
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- End of Header -->
        @yield('content')
        <!-- Start of seperator -->
        <table width="100%" bgcolor="#fcfcfc" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="seperator">
            <tbody>
                <tr>
                    <td>
                        <table width="600" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
                            <tbody>
                                <tr>
                                    <td align="center" height="30" style="font-size:1px; line-height:1px;">&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- End of seperator -->
        <!-- Start of footer -->
        <table width="100%" bgcolor="#fcfcfc" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="footer">
            <tbody>
                <tr>
                    <td>
                        <table width="600" bgcolor="#0099cc" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                            <tbody>
                                <tr>
                                    <td width="100%">
                                        <table bgcolor="#0099cc" width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                                            <tbody>
                                                <!-- Spacing -->
                                                <tr>
                                                    <td height="10" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                                                </tr>
                                                <!-- Spacing -->
                                                <tr>
                                                    <td>
                                                        <!-- Social icons -->
                                                        <table  width="150" align="center" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="43" height="43" align="center">
                                                                        <div class="imgpop">
                                                                            <a target="_blank" href="{{env('FACEBOOK_URL')}}">
                                                                                <img src="{{url('/images/emails/facebook.png')}}" alt="" border="0" width="43" height="43" style="display:block; border:none; outline:none; text-decoration:none;">
                                                                            </a>
                                                                        </div>
                                                                    </td>
                                                                    <td align="left" width="20" style="font-size:1px; line-height:1px;">&nbsp;</td>
                                                                    <td width="43" height="43" align="center">
                                                                        <div class="imgpop">
                                                                            <a target="_blank" href="{{env('TWITTER_URL')}}">
                                                                                <img src="{{url('/images/emails/twitter.png')}}" alt="" border="0" width="43" height="43" style="display:block; border:none; outline:none; text-decoration:none;">
                                                                            </a>
                                                                        </div>
                                                                    </td>
                                                                    <td align="left" width="20" style="font-size:1px; line-height:1px;">&nbsp;</td>
                                                                    <td width="43" height="43" align="center">
                                                                        <div class="imgpop">
                                                                            <a target="_blank" href="{{env('LINKEDIN_URL')}}">
                                                                                <img src="{{url('/images/emails/linkedin.png')}}" alt="" border="0" width="43" height="43" style="display:block; border:none; outline:none; text-decoration:none;">
                                                                            </a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!-- end of Social icons -->
                                                    </td>
                                                </tr>
                                                <!-- Spacing -->
                                                <tr>
                                                    <td height="10" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                                                </tr>
                                                <!-- Spacing -->
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- End of footer -->
        <!-- Start of Postfooter -->
        <table width="100%" bgcolor="#fcfcfc" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="postfooter" >
            <tbody>
                <tr>
                    <td>
                        <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                            <tbody>
                                <!-- Spacing -->
                                <tr>
                                    <td width="100%" height="20"></td>
                                </tr>
                                <!-- Spacing -->
                                <tr>
                                    <td align="center" valign="middle" style="font-family: Helvetica, arial, sans-serif; font-size: 13px;color: #282828" st-content="preheader">
                                        Don't want to receive email updates? <a href="{{url('unsubscribe/'.$notifiable->email)}}" style="text-decoration: none; color: #0099cc">Unsubscribe here </a>
                                    </td>
                                </tr>
                                <!-- Spacing -->
                                <tr>
                                    <td width="100%" height="20"></td>
                                </tr>
                                <!-- Spacing -->
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- End of postfooter -->
    </body>
</html>