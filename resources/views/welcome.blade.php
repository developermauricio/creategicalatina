<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
    <div id="app">
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    Laravel Echo
                </div>
                <div id="chat-notification"></div>
            </div>
        </div>
    </div>
    <script src="/app-assets/vendors/js/vendors.min.js"></script>
        <script>
            window.laravelEchoPort = '{{ env('LARAVEL_ECHO_PORT') }}'
            console.log(window.location.hostname);
        </script>
        <script src="//{{ request()->getHost() }}:{{ env('LARAVEL_ECHO_PORT') }}/socket.io/socket.io.js"></script>
        <script src="{{ asset('js/app-vue.js') }}"></script>
        <script>

            const userId = '{{ auth()->id() }}'
            window.Echo.channel('public-message-channel')
            .listen('.MessageEvent', (data) => {
                $("#chat-notification").append(`<div class="alert alert-warning">`+data.message+`</div>`);
            });
            window.Echo.private('message-channel.'+ userId)
                .listen('.MessageEvent', (data) => {
                    $("#chat-notification").append(`<div class="alert alert-danger">`+data.message+`</div>`);
                });
        </script>
    </body>
</html>
