@extends('layouts.email')
@section('content')
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
<!-- start of Full text -->
<table width="100%" bgcolor="#fcfcfc" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="full-text">
    <tbody>
        <tr>
            <td>
                <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                    <tbody>
                        <tr>
                            <td width="100%">
                                <table bgcolor="#ffffff" width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                                    <tbody>
                                        <!-- Spacing -->
                                        <tr>
                                            <td height="20" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                                        </tr>
                                        <!-- Spacing -->
                                        <tr>
                                            <td>
                                                <table width="560" align="center" cellpadding="0" cellspacing="0" border="0" class="devicewidthinner">
                                                    <tbody>
                                                        <!-- Title -->
                                                        <tr>
                                                            <td style="font-family: Helvetica, arial, sans-serif; font-size: 1.6em; color: #282828; text-align:center; line-height: 24px;">
                                                                Welcome {{$notifiable->first_name}}! Let's get started.
                                                            </td>
                                                        </tr>
                                                        <!-- End of Title -->
                                                        <!-- spacing -->
                                                        <tr>
                                                            <td width="100%" height="15" style="font-size:5px; line-height:5px; mso-line-height-rule: exactly;">&nbsp;</td>
                                                        </tr>
                                                        <!-- End of spacing -->
                                                        <!-- content -->
                                                        <tr>
                                                            <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #889098; text-align:center; line-height: 24px;">
                                                                {{config('app.name')}} gives you access to unlimited books and other published works for free!<br/>
                                                                For more fun, you can also upload your books and publications to reach an even wider audience.
                                                                Join groups created by authors of publications to discuss, ask questions and give feedback.
                                                            </td>
                                                        </tr>
                                                        <!-- End of content -->
                                                        <!-- Spacing -->
                                                        <tr>
                                                            <td width="100%" height="15" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                                                        </tr>
                                                        <!-- /Spacing -->
                                                        <tr>
                                                            <td>

                                                                <!-- Start of Left Image -->
                                                                <table width="100%" bgcolor="#fcfcfc" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="left-image">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td width="100%">
                                                                                                <table width="400" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <!-- Start of left column -->
                                                                                                                <table width="200" align="left" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                                                                                                    <tbody>
                                                                                                                        <tr>
                                                                                                                            <td>
                                                                                                                                <!-- button -->
                                                                                                                                <table width="150" height="48" bgcolor="#0099cc" align="center" valign="middle" border="0" cellpadding="0" cellspacing="0" style="border-radius:3px;" st-button="learnmore">
                                                                                                                                    <tbody>
                                                                                                                                        <tr>
                                                                                                                                            <td height="9" align="center" style="font-size:1px; line-height:1px;">&nbsp;</td>
                                                                                                                                        </tr>
                                                                                                                                        <tr>
                                                                                                                                            <td height="30" align="center" valign="middle" style="font-family: Helvetica, Arial, sans-serif; font-size: 1.1em; line-height: 20px; font-weight:bold;color: #ffffff; text-align:center; -webkit-text-size-adjust:none;" st-title="fulltext-btn">
                                                                                                                                                <a style="text-decoration: none;color: #ffffff; text-align:center;" href="{{url('explorer')}}">Start Reading</a>
                                                                                                                                            </td>
                                                                                                                                        </tr>
                                                                                                                                        <tr>
                                                                                                                                            <td height="9" align="center" style="font-size:1px; line-height:1px;">&nbsp;</td>
                                                                                                                                        </tr>
                                                                                                                                    </tbody>
                                                                                                                                </table>
                                                                                                                                <!-- /button -->
                                                                                                                            </td>
                                                                                                                        </tr>
                                                                                                                    </tbody>
                                                                                                                </table>
                                                                                                                <!-- end of left column -->
                                                                                                                <!-- spacing for mobile devices-->
                                                                                                                <table align="left" border="0" cellpadding="0" cellspacing="0" class="mobilespacing">
                                                                                                                    <tbody>
                                                                                                                        <tr>
                                                                                                                            <td width="100%" height="15" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
                                                                                                                                &nbsp;
                                                                                                                            </td>
                                                                                                                        </tr>
                                                                                                                    </tbody>
                                                                                                                </table>
                                                                                                                <!-- end of for mobile devices-->
                                                                                                                <!-- start of right column -->
                                                                                                                <table width="200" align="right" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                                                                                                    <tbody>
                                                                                                                        <tr>
                                                                                                                            <td>
                                                                                                                                <!-- button -->
                                                                                                                                <table width="150" height="48" bgcolor="#0099cc" align="center" valign="middle" border="0" cellpadding="0" cellspacing="0" style="border-radius:3px;" st-button="learnmore">
                                                                                                                                    <tbody>
                                                                                                                                        <tr>
                                                                                                                                            <td height="9" align="center" style="font-size:1px; line-height:1px;">&nbsp;</td>
                                                                                                                                        </tr>
                                                                                                                                        <tr>
                                                                                                                                            <td height="30" align="center" valign="middle" style="font-family: Helvetica, Arial, sans-serif; font-size: 1.1em; line-height: 20px; font-weight:bold;color: #ffffff; text-align:center; -webkit-text-size-adjust:none;" st-title="fulltext-btn">
                                                                                                                                                <a style="text-decoration: none;color: #ffffff; text-align:center;" href="{{url()->route('app.upload')}}">Start Upload</a>
                                                                                                                                            </td>
                                                                                                                                        </tr>
                                                                                                                                        <tr>
                                                                                                                                            <td height="9" align="center" style="font-size:1px; line-height:1px;">&nbsp;</td>
                                                                                                                                        </tr>
                                                                                                                                    </tbody>
                                                                                                                                </table>
                                                                                                                                <!-- /button -->
                                                                                                                            </td>
                                                                                                                        </tr>
                                                                                                                    </tbody>
                                                                                                                </table>
                                                                                                                <!-- end of right column -->
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
                                                                <!-- End of Left Image -->
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <!-- Spacing -->
                                        <tr>
                                            <td height="20" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
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
<!-- End of Full Text -->
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
<!-- start of Full text -->
<table width="100%" bgcolor="#fcfcfc" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="full-text">
    <tbody>
        <tr>
            <td>
                <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                    <tbody>
                        <tr>
                            <td width="100%">
                                <table width="560" align="center" cellpadding="0" cellspacing="0" border="0" class="devicewidthinner">
                                    <tbody>
                                        <!-- content -->
                                        <tr>
                                            <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #889098; text-align:center; line-height: 24px;">
                                                If you have questions, send us a mail at <a href="mailto:support@reedaa.com">support@reedaa.com</a>. We'd be glad to help!
                                            </td>
                                        </tr>
                                        <!-- End of content -->
                                        <!-- Spacing -->
                                        <tr>
                                            <td width="100%" height="15" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                                        </tr>
                                        <!-- /Spacing -->
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
<!-- End of Full Text -->
@endsection