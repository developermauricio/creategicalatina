<div class="horizontal-menu-wrapper" style="display: none">
    <div class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-light navbar-shadow menu-border"
         role="navigation" data-menu="menu-wrapper" data-menu-type="floating-nav">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item"><a class="navbar-brand" href="/html/ltr/horizontal-menu-template/index.html">
                            <span class="brand-logo">
                                <img width="200" src="{{ env('IMG_LOGO') }}" alt="">
                            </span>
                    </a>
                </li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                            class="d-block d-xl-none text-primary toggle-icon font-medium-4"
                            data-feather="x"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <!-- Horizontal menu content-->
        <div class="navbar-container main-menu-content pt-5" data-menu="menu-container">
            <!-- include /includes/mixins-->
            <ul class="nav navbar-nav " id="main-menu-navigation" data-menu="menu-navigation">
                <li class="nav-item"><a
                        class="nav-link d-flex align-items-center" href="/"
                        data-toggle="dropdown"><span
                            data-i18n="Dashboards"> @lang('frontend/landing.inicio')</span></a>
                </li>
                <li class="nav-item"><a
                        class="nav-link d-flex align-items-center" href="#"
                       ><span data-i18n="Apps">@lang('frontend/landing.Quienes Somos')</span></a>
                </li>
                <li class="nav-item"><a
                        class="nav-link d-flex align-items-center" href="#"
                    ><span data-i18n="Apps">@lang('frontend/landing.Proyectos')</span></a>
                </li>
                <li class="nav-item">
                    @if(session('language') == 'es')
                    <a class="nav-link d-flex align-items-center" href="/{{session('language')}}/request-project"
                        ><span data-i18n="User Interface">@lang('frontend/landing.Solicitar Proyecto')</span>
                    </a>
                    @else
                        <a class="nav-link d-flex align-items-center" href="/{{session('language')}}/request-project"
                           ><span data-i18n="User Interface">@lang('frontend/landing.Solicitar Proyecto')</span>
                        </a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</div>

