<nav
    class="header-navbar  navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center navbar-dark"
    data-nav="brand-center">
    <div class="navbar-header d-xl-block d-none">
        <ul class="nav navbar-nav">
            <li class="nav-item"><a class="navbar-brand" href="/html/ltr/horizontal-menu-template/index.html">
                            <span class="brand-logo">
                                <img width="200" src="{{ env('IMG_LOGO') }}" alt="">
                            </span>
                </a>
            </li>
        </ul>

        {{--        <ul class="nav navbar-nav">--}}
        {{--            <li class="nav-item"><a class="navbar-brand" href="/html/ltr/horizontal-menu-template/index.html"><span class="brand-logo">--}}
        {{--                            <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">--}}
        {{--                                <defs>--}}
        {{--                                    <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">--}}
        {{--                                        <stop stop-color="#000000" offset="0%"></stop>--}}
        {{--                                        <stop stop-color="#FFFFFF" offset="100%"></stop>--}}
        {{--                                    </lineargradient>--}}
        {{--                                    <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">--}}
        {{--                                        <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>--}}
        {{--                                        <stop stop-color="#FFFFFF" offset="100%"></stop>--}}
        {{--                                    </lineargradient>--}}
        {{--                                </defs>--}}
        {{--                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
        {{--                                    <g id="Artboard" transform="translate(-400.000000, -178.000000)">--}}
        {{--                                        <g id="Group" transform="translate(400.000000, 178.000000)">--}}
        {{--                                            <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill:currentColor"></path>--}}
        {{--                                            <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>--}}
        {{--                                            <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>--}}
        {{--                                            <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>--}}
        {{--                                            <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>--}}
        {{--                                        </g>--}}
        {{--                                    </g>--}}
        {{--                                </g>--}}
        {{--                            </svg></span>--}}
        {{--                    <h2 class="brand-text mb-0">Vuexy</h2>--}}
        {{--                </a></li>--}}
        {{--        </ul>--}}
    </div>
    <div class="navbar-container d-flex content row-menu-horizontal header-navbar navbar-horizontal "
         data-menu="menu-container">
        <div class="bookmark-wrapper d-flex align-items-center main-menu-content">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon"
                                                                                                   data-feather="menu"></i></a>
                </li>
            </ul>


            <ul class="nav navbar-nav horizontal-menu menu-horizontal-frontend" id="main-menu-navigation"
                data-menu="menu-navigation">
                <li class="dropdown nav-item frontend-menu  {{request()->is('es/') ? 'sidebar-group-active active open' : '' }}" data-menu="dropdown"><a
                        class="dropdown-toggle nav-link d-flex align-items-center " href="/{{ session('language') }}/"
                        data-toggle=""><span
                            data-i18n="Dashboards"> @lang('frontend/landing.inicio') </span></a>
                    {{--                    <ul class="dropdown-menu">--}}
                    {{--                        <li data-menu=""><a class="dropdown-item d-flex align-items-center"--}}
                    {{--                                            href="dashboard-analytics.html" data-toggle="dropdown"--}}
                    {{--                                            data-i18n="Analytics"><i data-feather="activity"></i><span--}}
                    {{--                                    data-i18n="Analytics">Analytics</span></a>--}}
                    {{--                        </li>--}}
                    {{--                        <li class="active" data-menu=""><a class="dropdown-item d-flex align-items-center"--}}
                    {{--                                                           href="dashboard-ecommerce.html" data-toggle="dropdown"--}}
                    {{--                                                           data-i18n="eCommerce"><i--}}
                    {{--                                    data-feather="shopping-cart"></i><span--}}
                    {{--                                    data-i18n="eCommerce">eCommerce</span></a>--}}
                    {{--                        </li>--}}
                    {{--                    </ul>--}}
                </li>
                <li class="dropdown nav-item frontend-menu" data-menu="dropdown"><a
                        class="dropdown-toggle nav-link d-flex align-items-center" href="#"
                        data-toggle="dropdown"><span data-i18n="Apps">@lang('frontend/landing.Quienes Somos')</span></a>
                    {{--                    <ul class="dropdown-menu">--}}
                    {{--                        <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="app-email.html"--}}
                    {{--                                            data-toggle="dropdown" data-i18n="Email"><i--}}
                    {{--                                    data-feather="mail"></i><span data-i18n="Email">Email</span></a>--}}
                    {{--                        </li>--}}
                    {{--                        <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="app-chat.html"--}}
                    {{--                                            data-toggle="dropdown" data-i18n="Chat"><i--}}
                    {{--                                    data-feather="message-square"></i><span data-i18n="Chat">Chat</span></a>--}}
                    {{--                        </li>--}}
                    {{--                        <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="app-todo.html"--}}
                    {{--                                            data-toggle="dropdown" data-i18n="Todo"><i--}}
                    {{--                                    data-feather="check-square"></i><span data-i18n="Todo">Todo</span></a>--}}
                    {{--                        </li>--}}
                    {{--                        <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="app-calendar.html"--}}
                    {{--                                            data-toggle="dropdown" data-i18n="Calendar"><i--}}
                    {{--                                    data-feather="calendar"></i><span data-i18n="Calendar">Calendar</span></a>--}}
                    {{--                        </li>--}}
                    {{--                        <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="app-kanban.html"--}}
                    {{--                                            data-toggle="dropdown" data-i18n="Kanban"><i--}}
                    {{--                                    data-feather="grid"></i><span data-i18n="Kanban">Kanban</span></a>--}}
                    {{--                        </li>--}}
                    {{--                        <li data-menu=""><a class="dropdown-item d-flex align-items-center"--}}
                    {{--                                            href="app-file-manager.html" data-toggle="dropdown"--}}
                    {{--                                            data-i18n="File Manager"><i data-feather="save"></i><span--}}
                    {{--                                    data-i18n="File Manager">File Manager</span></a>--}}
                    {{--                        </li>--}}
                    {{--                    </ul>--}}
                </li>
                <li class="dropdown nav-item frontend-menu" data-menu="dropdown"><a
                        class="dropdown-toggle nav-link d-flex align-items-center" href="#"
                        data-toggle="dropdown"><span data-i18n="Apps">@lang('frontend/landing.Proyectos')</span></a>
                </li>
                <li class="dropdown nav-item frontend-menu" data-menu="dropdown">
                    @if(session('language') == 'es')
                    <a class="dropdown-toggle nav-link d-flex align-items-center {{request()->is('es/request-project') ? 'sidebar-group-active active open' : '' }}"
                       href="/{{session('language')}}/request-project">
                        <span data-i18n="Apps">@lang('frontend/landing.Solicitar Proyecto')</span>
                    </a>
                    @else
                        <a class="dropdown-toggle nav-link d-flex align-items-center {{request()->is('en/request-project') ? 'sidebar-group-active active open' : '' }}"
                           href="/{{session('language')}}/request-project">
                            <span data-i18n="Apps">@lang('frontend/landing.Solicitar Proyecto')</span>
                        </a>
                    @endif
                </li>
            </ul>

            {{--            <ul class="nav navbar-nav bookmark-icons">--}}
            {{--                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-email.html" data-toggle="tooltip" data-placement="top" title="Email"><i class="ficon" data-feather="mail"></i></a></li>--}}
            {{--                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-chat.html" data-toggle="tooltip" data-placement="top" title="Chat"><i class="ficon" data-feather="message-square"></i></a></li>--}}
            {{--                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-calendar.html" data-toggle="tooltip" data-placement="top" title="Calendar"><i class="ficon" data-feather="calendar"></i></a></li>--}}
            {{--                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-todo.html" data-toggle="tooltip" data-placement="top" title="Todo"><i class="ficon" data-feather="check-square"></i></a></li>--}}
            {{--            </ul>--}}
            {{--            <ul class="nav navbar-nav">--}}
            {{--                <li class="nav-item d-none d-lg-block"><a class="nav-link bookmark-star"><i class="ficon text-warning" data-feather="star"></i></a>--}}
            {{--                    <div class="bookmark-input search-input">--}}
            {{--                        <div class="bookmark-input-icon"><i data-feather="search"></i></div>--}}
            {{--                        <input class="form-control input" type="text" placeholder="Bookmark" tabindex="0" data-search="search">--}}
            {{--                        <ul class="search-list search-list-bookmark"></ul>--}}
            {{--                    </div>--}}
            {{--                </li>--}}
            {{--            </ul>--}}
        </div>
        <ul class="nav navbar-nav align-items-center ml-auto">
            <div class="logo-mobile" style="display: none">
                <li class="nav-item ml-auto"><a class="navbar-brand ml-auto" href="/">
                    <span class="brand-logo">
                        <img width="116" src="{{ env('IMG_LOGO') }}" alt="">
                    </span>
                    </a>
                </li>
            </div>
            <li class="nav-item dropdown dropdown-language">
                <a class="nav-link dropdown-toggle" id="dropdown-flag"
                   href="javascript:void(0);" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false"><i
                        class="flag-icon {{ session('language') == 'es' ? 'flag-icon-es' : 'flag-icon-us'  }} "></i><span
                        class="selected-language"
                        style="color: #d0d2d6">{{ session('language') == 'es' ?  __('Español')  :  __('Inglés')  }}</span></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-flag">
                    @foreach(config('lenguages') as $key => $value)
                        <a class="dropdown-item" href="{{ route('set_lenguage', [$key]) }}" data-language=""
                           style="color: #d0d2d6">
                            <i class="flag-icon {{ $value['flag'] }}"></i> {{__($value['language'])}}</a>
                    @endforeach
                </div>
            </li>
            <li  class="nav-item  {{\Illuminate\Support\Facades\Auth::check() ? 'd-none' : '' }} d-lg-block"
                id="change-template-theme" style="color: #d0d2d6; padding-bottom: 0.4rem"><a
                    class="nav-link nav-link-style icon-moon" data-toggle="modal" data-target="#modal-change-theme-frontend"><i
                        class="ficon" data-feather="moon"></i></a></li>
            <li class="nav-item {{\Illuminate\Support\Facades\Auth::check() ? '' : 'display-none-main' }}  d-lg-block dropdown dropdown-notification mr-25">
                <a class="nav-link" href="javascript:void(0);"
                   data-toggle="dropdown"><i class="ficon"
                                             data-feather="bell"></i><span
                        class="badge badge-pill badge-danger badge-up">5</span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                    <li class="dropdown-menu-header">
                        <div class="dropdown-header d-flex">
                            <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                            <div class="badge badge-pill badge-light-primary">6 New</div>
                        </div>
                    </li>
                    <li class="scrollable-container media-list"><a class="d-flex" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <div class="avatar"><img src="/app-assets/images/portrait/small/avatar-s-15.jpg"
                                                             alt="avatar" width="32" height="32"></div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading"><span
                                            class="font-weight-bolder">Congratulation Sam 🎉</span>winner!</p><small
                                        class="notification-text"> Won the monthly best seller badge.</small>
                                </div>
                            </div>
                        </a><a class="d-flex" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <div class="avatar"><img src="/app-assets/images/portrait/small/avatar-s-3.jpg"
                                                             alt="avatar" width="32" height="32"></div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading"><span class="font-weight-bolder">New message</span>&nbsp;received
                                    </p><small class="notification-text"> You have 10 unread messages</small>
                                </div>
                            </div>
                        </a><a class="d-flex" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <div class="avatar bg-light-danger">
                                        <div class="avatar-content">MD</div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading"><span class="font-weight-bolder">Revised Order 👋</span>&nbsp;checkout
                                    </p><small class="notification-text"> MD Inc. order updated</small>
                                </div>
                            </div>
                        </a>
                        <div class="media d-flex align-items-center">
                            <h6 class="font-weight-bolder mr-auto mb-0">System Notifications</h6>
                            <div class="custom-control custom-control-primary custom-switch">
                                <input class="custom-control-input" id="systemNotification" type="checkbox" checked="">
                                <label class="custom-control-label" for="systemNotification"></label>
                            </div>
                        </div>
                        <a class="d-flex" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <div class="avatar bg-light-danger">
                                        <div class="avatar-content"><i class="avatar-icon" data-feather="x"></i></div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading"><span class="font-weight-bolder">Server down</span>&nbsp;registered
                                    </p><small class="notification-text"> USA Server is down due to hight CPU
                                        usage</small>
                                </div>
                            </div>
                        </a><a class="d-flex" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <div class="avatar bg-light-success">
                                        <div class="avatar-content"><i class="avatar-icon" data-feather="check"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading"><span class="font-weight-bolder">Sales report</span>&nbsp;generated
                                    </p><small class="notification-text"> Last month sales report generated</small>
                                </div>
                            </div>
                        </a><a class="d-flex" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <div class="avatar bg-light-warning">
                                        <div class="avatar-content"><i class="avatar-icon"
                                                                       data-feather="alert-triangle"></i></div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading"><span class="font-weight-bolder">High memory</span>&nbsp;usage
                                    </p><small class="notification-text"> BLR Server using high memory</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-menu-footer"><a class="btn btn-primary btn-block" href="javascript:void(0)">Read
                            all notifications</a></li>
                </ul>
            </li>
            @auth()
                <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link"
                                                               id="dropdown-user" href="javascript:void(0);"
                                                               data-toggle="dropdown" aria-haspopup="true"
                                                               aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none"><span
                                class="user-name font-weight-bolder" style="color: #d0d2d6">John Doe</span><span
                                class="user-status" style="color: #d0d2d6">Admin</span></div>
                        <span class="avatar"><img class="round" src="/app-assets//images/portrait/small/avatar-s-11.jpg"
                                                  alt="avatar" height="40" width="40"><span
                                class="avatar-status-online"></span></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="page-profile.html">
                            <i class="mr-50" data-feather="user"></i> {{ __('Perfil') }}</a>
                        <a class="dropdown-item" href="app-email.html">
                            <i class="mr-50" data-feather="mail"></i> {{ __('Bandeja de Entrada') }}</a>
                        <a class="dropdown-item" href="app-todo.html">
                            <i class="mr-50" data-feather="check-square"></i> {{ __('Tareas') }}</a>
                        <a class="dropdown-item" href="app-chat.html">
                            <i class="mr-50" data-feather="message-square"></i> {{ __('Chats') }}</a>
                        <a class="dropdown-item icon-theme icon-logo-dark nav-link-style">
                            <i class="mr-50 ficon" data-feather="moon"></i><span class="span-text-dark-mode"
                                                                                 style="margin-left: 0.53rem">Dark mode</span></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="page-account-settings.html">
                            <i class="mr-50" data-feather="settings"></i> {{ __('Configuración') }}</a><a
                            class="dropdown-item"
                            href="page-pricing.html">
                            <i class="mr-50" data-feather="help-circle"></i> {{ __('Ayuda') }}</a><a
                            class="dropdown-item"
                            href="page-auth-login-v2.html">
                            <i class="mr-50" data-feather="power"></i> {{ __('Cerrar Sessión') }}</a>
                    </div>
                </li>
            @endauth
        </ul>
    </div>
</nav>