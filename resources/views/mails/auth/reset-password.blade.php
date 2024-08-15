<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
         @if($lang->value =='ar')
          html * {
             direction: rtl;
                text-align: right;
         }
         @endif


    </style>
</head>
<body>
<div>


    <div >

        <div width="100%" style="margin:0;padding:0!important;">


            <center style="width:100%;background:rgba(23,198,83,0.06)">
                <div style="max-width:680px;margin:0 auto; padding-top: 5rem">
                    <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                           style="max-width:680px;width:100%">
                        <tbody>
                        <tr>
                            <td style="padding:10px 0px;">
                                <a target="_blank">
                                    <img
                                        alt="Logo" title="Logo"

                                        src="{{ asset('app.png') }}"
                                        style="display:block;font-family:arial,sans-serif;line-height:15px;color:#3c3f44;margin:0"
                                    >
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:0 30px;background-color:#ffffff"
                            >
                                <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                                       style="width:100%;font-family:arial,sans-serif;font-size:15px;line-height:21px;color:#3c3f44;text-align:left">
                                    <tbody>


                                    <tr>
                                        <td style="padding:30px 0 0;border-top:1px solid #d6d8db">
                                            <p align="left"
                                               style="padding:0;margin:0;color:#000000;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI','Roboto','Oxygen','Ubuntu','Cantarell','Fira Sans','Droid Sans','Helvetica Neue',sans-serif;line-height:20px;font-size:14px;margin-bottom:10px">
                                                {{ trans('app.hello') }} {{ $user->owner->dto()->fullname() }},
                                            </p>
                                            <p align="left"
                                               style="padding:0;margin:0;color:#000000;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI','Roboto','Oxygen','Ubuntu','Cantarell','Fira Sans','Droid Sans','Helvetica Neue',sans-serif;line-height:20px;font-size:14px;margin-bottom:10px">
                                                {{ trans('mail.reset_password.title') }}
                                            </p>
                                            <p align="left"
                                               style="padding:0;margin:0;color:#000000;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI','Roboto','Oxygen','Ubuntu','Cantarell','Fira Sans','Droid Sans','Helvetica Neue',sans-serif;line-height:20px;font-size:14px;margin-bottom:10px">
                                                {{ trans('mail.reset_password.instruction') }}
                                                {{ trans('mail.reset_password.delay', ['time' => config('auth.passwords.users.expire') ]) }}
                                            </p>
                                            <p align="left">
                                                <a href="{{ $url  }}"
                                                   style="background:#17C653;color:#fff;padding:12px 14px;display:inline-block;text-decoration:none;margin-bottom:20px;border-radius:6px"
                                                   target="_blank">
                                                    {{ trans('mail.reset_password.btn_text') }}
                                                </a>
                                            </p>


                                        </td>
                                    </tr>


                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:30px">
                                <table align="left" border="0" cellpadding="0" cellspacing="0" role="presentation"
                                       width="100%">
                                    <tbody>
                                    <tr>
                                        <td style="text-align:center !important;padding-bottom:10px;font-size:12px;line-height:15px;font-family:arial,sans-serif;color:#9199a1;">
                                            <p>
                                                {{ trans('mail.reset_password.help_text') }}
                                                <a
                                                    href="{{ config('app.url') }}">
                                                    {{ trans('mail.reset_password.contact_us') }}
                                                </a>,
                                                {{ trans('app.thank_you') }}
                                                    .
                                            </p>


                                            <p>
                                                {{ trans('mail.reset_password.expires_at') }}
                                                <span style="color: black">{{ $expires_at }} </span>
                                            </p>
                                        </td>


                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </center>
            <div></div>
            <div></div>
        </div>
        <div></div>
    </div>
</div>












</body>
</html>
