<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600" rel="stylesheet" type="text/css">


    <style>
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            font-family: 'Poppins', sans-serif !important;
            font-size: 14px;
            margin-bottom: 10px;
            line-height: 22px;
            color: #526283;
            font-weight: 400;
        }

        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            margin: 0;
            padding: 0;
        }

        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        table table table {
            table-layout: auto;
        }

        a {
            text-decoration: none;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }
    </style>

</head>

<body width="100%"
    style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #eaf3fc;">
    <center style="width: 100%; background-color: #eaf3fc;">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#eaf3fc">
            <tr>
                <td style="padding: 40px 0;">
                    <table
                        style="width:100%;max-width:620px;margin:0 auto;background-color:#ffffff;border:1px solid #e3edf8;border-bottom:4px solid #16a2fd;">
                        <tbody>
                            <tr>
                                <td style="padding: 30px 30px 15px 30px;">
                                    <h2 style="font-size: 18px; color: #16a1fd; font-weight: 600; margin: 0;">Reset
                                        Password</h2>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0 30px 20px">
                                    <p style="margin-bottom: 10px;">Hi {{ $mailData['name'] }},</p>
                                    <p style="margin-bottom: 10px;">You are receiving this email because
                                        you requested for reset password.</p>
                                    <p style="margin-bottom: 10px;">Click the link below to reset your password.</p>
                                    <a href="{{ url('') }}/reset-password?verification_code={{ $mailData['code'] }}"
                                        style="background-color:#16a1fd;border-radius:4px;color:#ffffff;display:inline-block;font-size:13px;font-weight:600;line-height:44px;text-align:center;text-decoration:none;text-transform: uppercase; padding: 0 30px">Verify
                                        Email</a>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0 30px">
                                    <h4
                                        style="font-size: 15px; color: #000000; font-weight: 600; margin: 0; text-transform: uppercase; margin-bottom: 10px">
                                        or</h4>
                                    <p style="margin-bottom: 10px;">If the button above does not work, paste this link
                                        into your web browser:</p>
                                    <a href="#"
                                        style="color: #16a1fd; text-decoration:none;word-break: break-all;">{{ url('') }}/reset-password?verification_code={{ $mailData['code'] }}</a>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 20px 30px 40px">
                                    <p>If you did not make this request, please contact us or ignore this message.</p>
                                    <p style="margin: 0; font-size: 13px; line-height: 22px; color:#9ea8bb;">This is an
                                        automatically generated email please do not reply to this email.</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width:100%;max-width:620px;margin:0 auto;">
                        <tbody>
                            <tr>
                                <td style="text-align: center; padding:25px 20px 0;">
                                    <p style="font-size: 13px;">Copyright © {{ date('Y') }} . <br></p>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </center>
</body>

</html>
