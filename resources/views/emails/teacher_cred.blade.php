<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <div>
            <table bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" style="margin:5rem auto;width:100%;max-width:900px;border:1px solid #ddd">
                <tbody>           
                    <tr>
                        <td style="color:#004282;font-weight:600;padding-top:.3125rem;background:#f1f1f1;padding-bottom:.3125rem;font-size:2rem;padding:20px 0;text-align:center;white-space:nowrap">
                            <a href="<?= url('/') ?>" style="color:#004282;text-decoration:none;" target="_blank"> Balakairali</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:10px"></td>
                    </tr>
                    <tr>
                        <td style="font-size:18px;line-height:25px;padding:0 20px 15px;word-spacing:1px">
                            <p style="margin:0">Dear {{ $user->first_name }},
                                <br>
                                <br>
                                You can now login to view the dashboard through the following link:
                                <br>
                                <br>
                                 {{ url('/admin') }}
                                <br>
                                <br>
                                Login Credentials
                                <br>
                                <br>
                                Email    : {{ $user->email }}
                                <br>
                                Password : {{ $password }}
                                <br>
                                <br>
                                You can use the above password or change your password at the first login.
                                <br>
                                In future, you will be receiving email notification of new applications received, and you can review them here.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:10px;padding:0 20px 15px;">
                            <p style="margin:0;color: #b2b2b2;border-top: 1px solid #ddd;padding-top: 15px;">
                                BalaKairali Inc., Sydney, Australia
                                <br>
                                Charity Reg No: Y 2595547 | Charity ABN: 22 412 657 291
                            </p>
                        </td>
                    </tr>           
                </tbody>
            </table>
        </div>
    </body>
</html>