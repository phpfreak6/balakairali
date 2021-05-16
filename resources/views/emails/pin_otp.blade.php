<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
    <div>
        <table bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" style="margin:5rem auto;width:100%;max-width:900px">
            <tbody>
                <tr>
                    <td style="color:#004282;font-weight:600;padding-top:.3125rem;background:#f1f1f1;padding-bottom:.3125rem;font-size:2rem;padding:20px 0;text-align:center;white-space:nowrap">
                        <a href="{{ url('/') }}" style="color:#004282;text-decoration:none;" target="_blank"> Bala Kairali</a>
                    </td>
                </tr>
                <tr>
                    <td style="height:10px"></td>
                </tr>
                <tr>
                    <td align="center" style="font-size:18px;line-height:25px;padding:0 20px 15px;word-spacing:1px">
                        <p style="margin:0; text-align: center;">Dear {{ $user->p1_first_name }} {{ $user->p1_last_name }},
                            <br><br>
                            Your one time password is:
                            <br><br>
                        <h3>{{ $otp }}</h3>
                        <br><br>
                        Thanks and regards,
                        <br>Bala Kairali Team

                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="height:10px;padding:0 20px 15px;">
                        <p style="margin:0;color: #b2b2b2;border-top: 1px solid #ddd;padding-top: 15px;">
                            Bala Kairali
                            <br>
                            Gate 9, Monash St., Wentworthville Public school | Telephone: 0405 343251, 0419 408584
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>