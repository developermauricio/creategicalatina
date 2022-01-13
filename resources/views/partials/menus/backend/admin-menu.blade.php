<div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i
                    data-feather="home"></i><span
                    class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span></a>
        </li>
        <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">{{ __('navegacion') }}</span><i
                data-feather="more-horizontal"></i>
        </li>
        <li class="nav-item  "><a class="d-flex align-items-center" href="/{{ session('language') }}/customers"><i
                    data-feather='users'></i><span class="menu-title text-truncate"
                                                   data-i18n="Email">{{ __('clientes') }}</span></a>
            <ul class="menu-content">
                <li class="{{request()->is(session('language').'/customers') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="/{{ session('language') }}/customers"><i
                            data-feather="circle"></i><span class="menu-item text-truncate"
                                                            data-i18n="Second Level">{{ __('todos_clientes') }}</span></a>
                </li>
                <li class="{{request()->is(session('language').'/new-customers') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="/{{ session('language') }}/new-customers"><i
                            data-feather="circle"></i><span class="menu-item text-truncate"
                                                            data-i18n="Second Level">{{ __('menu_backend_nuevo_cliente') }}</span></a>
                </li>
            </ul>
        </li>


        <li class=" nav-item"><a class="d-flex align-items-center" href="/{{ session('language') }}/admin-projects"><i
                    data-feather='package'></i><span class="menu-title text-truncate"
                                                     data-i18n="Chat">{{ __('proyectos') }}</span></a>
            <ul class="menu-content">
                <li class="{{request()->is(session('language').'/admin-projects*') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="/{{ session('language') }}/admin-projects"><i
                            data-feather="circle"></i><span class="menu-item text-truncate"
                                                            data-i18n="Second Level">{{ __('menu_todos_los_proyectos') }}</span></a>
                </li>
                <li class="{{request()->is(session('language').'/new-project') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="/{{ session('language') }}/new-project"><i
                            data-feather="circle"></i><span class="menu-item text-truncate"
                                                            data-i18n="Second Level">{{ __('menu_nuevo_proyecto') }}</span></a>
                </li>
                <li class="{{request()->is(session('language').'/project-setup') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="/{{ session('language') }}/project-setup"><i
                            data-feather="circle"></i><span class="menu-item text-truncate"
                                                            data-i18n="Second Level">{{ __('Configuración') }}</span></a>
                </li>
            </ul>
        </li>
        <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='shopping-bag'></i><span
                    class="menu-title text-truncate"
                    data-i18n="Todo">{{ __('proveedores') }}</span></a>
            <ul class="menu-content">
                <li class="{{request()->is(session('language').'/providers') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="/{{ session('language') }}/providers"><i
                            data-feather="circle"></i><span class="menu-item text-truncate"
                                                            data-i18n="Second Level">{{ __('backend/provider/provider.todos_los_proveedores') }}</span></a>
                </li>
                <li class="{{request()->is(session('language').'/new-providers') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="/{{ session('language') }}/new-providers"><i
                            data-feather="circle"></i><span class="menu-item text-truncate"
                                                            data-i18n="Second Level">{{ __('backend/provider/provider.registrar_proveedor') }}</span></a>
                </li>
            </ul>
        </li>

        <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='shopping-cart'></i><span
                    class="menu-title text-truncate"
                    data-i18n="Todo">Ordenes de Pago</span></a>
            <ul class="menu-content">
                <li class="{{request()->is(session('language').'/purchase-orders') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="/{{ session('language') }}/purchase-orders">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="Second Level">Ordenes de Pago</span>
                    </a>
                </li>
                <li class="{{request()->is(session('language').'/new-purchase-order') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="/{{ session('language') }}/new-purchase-order"><i
                            data-feather="circle"></i><span class="menu-item text-truncate"
                                                            data-i18n="Second Level">Nueva Orden de Pago</span></a>
                </li>
            </ul>
        </li>


        <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='edit'></i><span
                    class="menu-title text-truncate"
                    data-i18n="Calendar">{{ __('ordenes_compra') }}</span></a>
        </li>

        <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">{{ __('empresa_titulo_navegacion') }}</span><i
                data-feather="more-horizontal"></i>
        </li>
        <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='trello'></i><span
                    class="menu-title text-truncate"
                    data-i18n="Kanban">{{ __('trafico_operativo') }}</span></a>
        </li>
        <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='briefcase'></i><span
                    class="menu-title text-truncate"
                    data-i18n="Kanban">{{ __('administrativo') }}</span></a>
        </li>
        <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='edit-3'></i><span
                    class="menu-title text-truncate"
                    data-i18n="Kanban">{{ __('brief_campañanas') }}</span></a>
        </li>
        <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='users'></i><span
                    class="menu-title text-truncate" data-i18n="Kanban">{{ __('team_equipo_trabajo') }}</span></a>
            <ul class="menu-content">
                <li class="{{request()->is(session('language').'/members-team') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="/{{ session('language') }}/members-team"><i
                            data-feather="circle"></i><span class="menu-item text-truncate"
                                                            data-i18n="Second Level">{{ __('team_equipo_trabajo') }}</span></a>
                </li>
                <li class="{{request()->is(session('language').'/new-member') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="/{{ session('language') }}/new-member"><i
                            data-feather="circle"></i><span class="menu-item text-truncate"
                                                            data-i18n="Second Level">{{ __('backend/team/teams.registrar_miembro') }}</span></a>
                </li>
            </ul>
        </li>
        <li class=" navigation-header">
            <span data-i18n="Apps &amp; Pages">
                {{ __('configuracion_sistema_titulo_navegacion') }}
            </span>
            <i data-feather="more-horizontal"></i>
        </li>
        <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='settings'></i><span
                    class="menu-title text-truncate" data-i18n="Kanban">Configuración</span></a>
            <ul class="menu-content">
                <li class="{{request()->is(session('language').'/setup-team') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="/{{ session('language') }}/configuration-team"><i
                            data-feather="circle"></i><span class="menu-item text-truncate"
                                                            data-i18n="Second Level">Equipo de Trabajo</span></a>
                </li>
            </ul>
        </li>
    </ul>
</div>

