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
                                                                <p>
                                                                    {{$greeting}}
                                                                </p>
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
                                                                <!-- Intro -->
                                                                @foreach ($introLines as $line)
                                                                <p>
                                                                    {{ $line }}
                                                                </p>
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                        <!-- End of content -->
                                                        <!-- Spacing -->
                                                        <tr>
                                                            <td width="100%" height="15" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                                                        </tr>
                                                        <!-- /Spacing -->
                                                        <!-- Button -->
                                                        <tr>
                                                            <td>
                                                                <table width="200" height="48" bgcolor="#0099cc" align="center" valign="middle" border="0" cellpadding="0" cellspacing="0" style="border-radius:3px;" st-button="learnmore">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td height="9" align="center" style="font-size:1px; line-height:1px;">&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td height="30" align="center" valign="middle" style="font-family: Helvetica, Arial, sans-serif; font-size: 1.1em; line-height: 20px; font-weight:bold;color: #ffffff; text-align:center; -webkit-text-size-adjust:none;" st-title="fulltext-btn">
                                                                                <a style="text-decoration: none;color: #ffffff; text-align:center;" href="{{ $actionUrl }}">{{ $actionText }}</a>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td height="9" align="center" style="font-size:1px; line-height:1px;">&nbsp;</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <!-- end of button -->
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
                                                <!-- Outro -->
                                                @foreach ($outroLines as $line)
                                                <p>
                                                    {{ $line }}
                                                </p>
                                                @endforeach
                                                <!-- Sub Copy -->
                                                <p>
                                                    If you’re having trouble clicking the "{{ $actionText }}" button,
                                                    copy and paste the URL below into your web browser:
                                                </p>
                                                <p>
                                                    <a href="{{ $actionUrl }}" target="_blank">
                                                        {{ $actionUrl }}
                                                    </a>
                                                </p>
                                                <!-- end of sub copy -->
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