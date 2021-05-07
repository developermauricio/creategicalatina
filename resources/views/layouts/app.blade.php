<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" value="1" class="loading {{ session('theme') == '1' || session('theme') == '3'? 'dark-layout' : 'semi-dark'  }}"
      data-layout="semi-dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description"
          content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
          content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} | @yield('title')</title>
    <link rel="apple-touch-icon" href="{{ env('favicon_img_logo') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ env('favicon_img_logo') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
          rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/animate/animate.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/extensions/sweetalert2.min.css">
    @stack('css')
<!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/semi-dark-layout.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/charts/chart-apex.css">
{{--    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/extensions/ext-component-toastr.css">--}}
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <!-- END: Custom CSS-->
    <script>
        window.token = '{{ csrf_token() }}'
        window.lang = '{{ session('language') }}'
        window.logo_base_64 = '{{ env('IMG_BASE64_LOGO_LIGTH') }}'
        window.logo_ligth = '{{ env('IMG_LOGO_LIGTH') }}'
        window.url = '{{ env('APP_URL') }}'
        window.sideBarMenu = '{{ session('sidebarMenuBackend') }}'
        window.stateShowPassword = 2
        console.log(lang);
    </script>

    <!--End of Tawk.to Script-->
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern {{ session('sidebarMenuBackend') == '1' ? 'menu-collapsed' : 'menu-expanded'  }}  navbar-sticky footer-fixed" data-open="click"
      data-menu="vertical-menu-modern" data-col="">

<!-- BEGIN: Header-->
<div id="app">
    @include('partials.navigations.navbar-backend')
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    @include('partials.menus.backend.menu-navigation')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                @yield('header-breadcrumbs')
            </div>
            <div class="content-body">
                @yield('content')
                <div id="chat-notification"></div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    @include('partials.footer')
    @include('partials.theme.modal-changed-theme-backend')
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->
</div>

<!-- BEGIN: Vendor JS-->
<script src="/app-assets/vendors/js/vendors.min.js"></script>

<!-- BEGIN Vendor JS-->
<script src="/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
<script src="/app-assets/vendors/js/extensions/polyfill.min.js"></script>
<!-- BEGIN: Page Vendor JS-->
<script src="/app-assets/vendors/js/charts/apexcharts.min.js"></script>
{{--<script src="/app-assets/vendors/js/extensions/toastr.min.js"></script>--}}
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="/app-assets/js/core/app-menu.js"></script>
<script src="/app-assets/js/core/app.js"></script>
<script src="/app-assets/js/scripts/extensions/ext-component-sweet-alerts.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
{{--<script src="/app-assets/js/scripts/pages/dashboard-ecommerce.js"></script>--}}

<!-- END: Page JS-->

@stack('js')
<script src="/js/change-template.js"></script>
{{--<script type="text/javascript">--}}
{{--    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();--}}
{{--    (function(){--}}
{{--        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];--}}
{{--        s1.async=true;--}}
{{--        s1.src='https://embed.tawk.to/60834e9c62662a09efc197d1/1f40em8e1';--}}
{{--        s1.charset='UTF-8';--}}
{{--        s1.setAttribute('crossorigin','*');--}}
{{--        s0.parentNode.insertBefore(s1,s0);--}}
{{--    })();--}}
{{--</script>--}}
<!--Start of Tawk.to Script-->
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
            console.log('hola beebe')
            $("#chat-notification").append(`<div class="alert alert-warning">`+data.message+`</div>`);
        });
    window.Echo.private('message-channel.'+ userId)
        .listen('.MessageEvent', (data) => {
            $("#chat-notification").append(`<div class="alert alert-danger">`+data.message+`</div>`);
        });
</script>
<script>
    $(window).on('load', function () {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    });
</script>

</body>
<!-- END: Body-->
</html>
