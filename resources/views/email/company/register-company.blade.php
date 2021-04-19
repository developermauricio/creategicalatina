
<!DOCTYPE html>
<html lang="en" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no, date=no, address=no, email=no">
    <!--[if mso]>
    <xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml>
    <style>
    td,th,div,p,a,h1,h2,h3,h4,h5,h6 {font-family: "Segoe UI", sans-serif; mso-line-height-rule: exactly;}
    </style>
    <![endif]-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700" rel="stylesheet" media="screen">
    <style>
        .hover-underline:hover {
            text-decoration: underline !important;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes ping {

            75%,
            100% {
                transform: scale(2);
                opacity: 0;
            }
        }

        @keyframes pulse {
            50% {
                opacity: .5;
            }
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(-25%);
                animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
            }

            50% {
                transform: none;
                animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
            }
        }

        @media (max-width: 600px) {
            .sm-px-24 {
                padding-left: 24px !important;
                padding-right: 24px !important;
            }

            .sm-py-32 {
                padding-top: 32px !important;
                padding-bottom: 32px !important;
            }

            .sm-w-full {
                width: 100% !important;
            }
        }
    </style>
</head>

<body style="margin: 0; padding: 0; width: 100%; word-break: break-word; -webkit-font-smoothing: antialiased;">
<div style="display: none;">Credenciales de acceso</div>
<div role="article" aria-roledescription="email" aria-label="" lang="en">
    <table style="font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif; width: 100%; justify-content: center !important;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center" style="--bg-opacity: 1; background-color: #eceff1; background-color: rgba(236, 239, 241, var(--bg-opacity)); font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif;" bgcolor="rgba(236, 239, 241, var(--bg-opacity))">
                <table class="sm-w-full" style="font-family: 'Montserrat',Arial,sans-serif; width: 600px;" width="600" cellpadding="0" cellspacing="0" role="presentation">
                    <tr>
                        <td class="sm-py-32 sm-px-24" style="font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif; padding: 48px; text-align: center;" align="center">
                            <a target="_blank" href="{{ env('APP_URL') }}">
                                <img src="{{ env('APP_URL') }}/{{ env('IMG_LOGO_LIGTH') }}" width="250" alt="Logo" style="border: 0; max-width: 100%; line-height: 100%; vertical-align: middle;">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" class="sm-px-24" style="font-family: 'Montserrat',Arial,sans-serif;">
                            <table style="font-family: 'Montserrat',Arial,sans-serif; width: 100%;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                <tr>
                                    <td class="sm-px-24" style="--bg-opacity: 1; background-color: #ffffff; background-color: rgba(255, 255, 255, var(--bg-opacity)); border-radius: 4px; font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif; font-size: 14px; line-height: 24px; padding: 48px; text-align: left; --text-opacity: 1; color: #626262; color: rgba(98, 98, 98, var(--text-opacity));" bgcolor="rgba(255, 255, 255, var(--bg-opacity))" align="left">
                                        <p style="font-weight: 600; font-size: 18px; margin-bottom: 0;">{{ __('backend/email/register-company.hola') }}</p>
                                        <p style="font-weight: 700; font-size: 20px; margin-top: 0; --text-opacity: 1; color: #F05E7D;">
                                            {{ $user }}</p>
                                        <p style="margin: 0 0 24px;">
                                            {{ __('backend/email/register-company.gracias_por_ser') }} {{ config('app.name') }}. {{ __('backend/email/register-company.la_empresa') }} <span style="color: #F05E7D; font-weight: bold">{{ $company  }}</span> {{ __('backend/email/register-company.ha_sido_registrada_credenciales') }}
                                        </p>
                                        <table style="font-family: 'Montserrat',Arial,sans-serif; width: 100%;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                            <tr>
                                                <td colspan="2" style="font-family: 'Montserrat',Arial,sans-serif;">
                                                    <table style="font-family: 'Montserrat',Arial,sans-serif; width: 100%;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                                        <tr>
                                                            <th align="left" style="padding-bottom: 1px;">
                                                                <p>{{ __('backend/email/register-company.usuario') }}</p>
                                                            </th>
                                                            <th align="right" style="padding-bottom: 1px;">
                                                                <p>{{ __('backend/email/register-company.contraseña') }}</p>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <td style="font-family: 'Montserrat',Arial,sans-serif; font-size: 14px; padding-top: 0px; padding-bottom: 00px; width: 50%;" width="20%">
                                                                {{ $email }}
                                                            </td>
                                                            <td align="right" style="font-family: 'Montserrat',Arial,sans-serif; font-size: 14px; text-align: left; width: 50%;" width="50%">
                                                                {{ $password }}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <table align="center" style="font-family: 'Montserrat',Arial,sans-serif; margin-left: auto; margin-right: auto; text-align: center; width: 100%;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                            <tr>
                                                <td align="right" style="font-family: 'Montserrat',Arial,sans-serif;">
                                                    <table style="font-family: 'Montserrat',Arial,sans-serif; margin-top: 24px; margin-bottom: 24px;" cellpadding="0" cellspacing="0" role="presentation">
                                                        <tr>
                                                            <td align="right" style="mso-padding-alt: 16px 24px; --bg-opacity: 1; background-color: #283046; border-radius: 4px; font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif;" bgcolor="rgba(115, 103, 240, var(--bg-opacity))">
                                                                <a target="_blank" href="{{ env('APP_URL') }}/login" style="display: block; font-weight: 600; font-size: 14px; line-height: 100%; padding: 16px 24px; --text-opacity: 1; color: #ffffff !important; text-decoration: none;">{{ __('backend/email/register-company.btn_iniciar_sesion') }} &rarr;</a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <p style="font-size: 14px; line-height: 24px; margin-top: 6px; margin-bottom: 20px;">
                                            {{ __('backend/email/register-company.si_tiene_duda_escribenos') }}
                                            <a target="_blank" href="#" style="color: #F05E7D">{{ __('backend/email/register-company.text_soporte') }}
                                                {{ config('app.name') }}</a> {{ __('backend/email/register-company.con_gusto_caso') }}
                                        </p>
                                        <p style="font-size: 14px; line-height: 24px; margin-top: 6px; margin-bottom: 20px;">
                                            {{ __('backend/email/register-company.saludos') }},
                                            <br>{{ __('backend/email/register-company.team') }} {{ config('app.name') }}.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-family: 'Montserrat',Arial,sans-serif; height: 20px;" height="20"></td>
                    </tr>
                    <tr>
                        <td style="font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif; font-size: 12px; padding-left: 48px; padding-right: 48px; --text-opacity: 1; color: #eceff1; color: rgba(236, 239, 241, var(--text-opacity));">
                            <p align="center" style="cursor: default; margin-bottom: 16px; text-align: center !important;">
                                <a target="_blank" href="{{ env('URL_FACEBOOK') }}" style="--text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity)); text-decoration: none;"><img src="{{ env('APP_URL') }}/images/icons/facebook.png" width="17" alt="Facebook" style="border: 0; max-width: 100%; line-height: 100%; vertical-align: middle; margin-right: 12px;"></a>
                                &bull;
                                <a target="_blank" href="{{ env('URL_TWITTER') }}" style="--text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity)); text-decoration: none;"><img src="{{ env('APP_URL') }}/images/icons/twitter.png" width="17" alt="Twitter" style="border: 0; max-width: 100%; line-height: 100%; vertical-align: middle; margin-right: 12px;"></a>
                                &bull;
                                <a target="_blank" href="{{ env('URL_INSTAGRAM') }}" style="--text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity)); text-decoration: none;"><img src="{{ env('APP_URL') }}/images/icons/instagram.png" width="17" alt="Instagram" style="border: 0; max-width: 100%; line-height: 100%; vertical-align: middle; margin-right: 12px;"></a>
                            </p>
                            <p style="--text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity)); text-align: center; font-size: 0.83rem">
                                {{ __('backend/email/register-company.el_uso_de_nuestro_servicio') }}
                                <a href="#" class="hover-underline" style="--text-opacity: 1; color: #F05E7D; text-decoration: none;">{{ __('backend/email/register-company.terminos_condiciones') }}</a> {{ __('backend/email/register-company.y') }}
                                <a href="#" class="hover-underline" style="--text-opacity: 1; color: #F05E7D; text-decoration: none;">{{ __('backend/email/register-company.politica_de_privacidad') }}</a>.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-family: 'Montserrat',Arial,sans-serif; height: 16px;" height="16"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
</body>

</html>
