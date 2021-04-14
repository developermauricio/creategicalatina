<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" id="menu-backend" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="/">
                    <span class="brand-logo logo-backend-horizontal">
                        <img width="200" src="{{ env('IMG_LOGO') }}" alt="">
                    </span>
                    <span class="brand-logo logo-backend-vertical mb-2" style="display: none">
                        <img width="30" src="{{ env('ICON_IMG_LOGO') }}" alt="">
                    </span>
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0 event-menu-sidebar"
                                               data-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary"
                        data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i
                        data-feather="home"></i><span
                        class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span></a>
            </li>
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">{{ __('navegacion') }}</span><i
                    data-feather="more-horizontal"></i>
            </li>
            <li class="nav-item  "><a class="d-flex align-items-center" href="/{{ session('language') }}/customers"><i data-feather='users'></i><span class="menu-title text-truncate"
                                                      data-i18n="Email">{{ __('clientes') }}</span></a>
                <ul class="menu-content">
                    <li class="{{request()->is(session('language').'/customers') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="/{{ session('language') }}/customers"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Second Level">{{ __('todos_clientes') }}</span></a>
                    </li>
                    <li class="{{request()->is(session('language').'/new-customers') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="/{{ session('language') }}/new-customers"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Second Level">{{ __('menu_backend_nuevo_cliente') }}</span></a>
                    </li>
                </ul>
            </li>



            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='package'></i><span class="menu-title text-truncate"
                                                                data-i18n="Chat">{{ __('proyectos') }}</span></a>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='shopping-bag'></i><span class="menu-title text-truncate"
                                                              data-i18n="Todo">{{ __('proveedores') }}</span></a>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='edit'></i><span class="menu-title text-truncate"
                                                          data-i18n="Calendar">{{ __('ordenes_compra') }}</span></a>
            </li>

            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">{{ __('empresa_titulo_navegacion') }}</span><i
                    data-feather="more-horizontal"></i>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='trello'></i><span class="menu-title text-truncate"
                                                      data-i18n="Kanban">{{ __('trafico_operativo') }}</span></a>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='briefcase'></i><span class="menu-title text-truncate"
                                                      data-i18n="Kanban">{{ __('administrativo') }}</span></a>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='edit-3'></i><span class="menu-title text-truncate"
                                                      data-i18n="Kanban">{{ __('brief_campañanas') }}</span></a>
            </li>
        </ul>
    </div>
</div>
