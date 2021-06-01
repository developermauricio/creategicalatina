
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">{{ __('navegacion') }}</span><i
                    data-feather="more-horizontal"></i>
            </li>
            @if(\App\Model\Customer::hasCompany())
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="/{{ session('language') }}/customer-companies">
                    <i data-feather='list'></i><span class="menu-title text-truncate" data-i18n="Kanban">{{ __('empresas') }}</span>
                </a>
            </li>
            @endif
            <li class=" nav-item"><a class="d-flex align-items-center" href="/{{ session('language') }}/projects"><i data-feather='package'></i><span class="menu-title text-truncate"
                                                                                                                    data-i18n="Chat">{{ __('proyectos') }}</span></a>
                <ul class="menu-content">
                    <li class="{{request()->is(session('language').'/projects') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="/{{ session('language') }}/projects"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Second Level">{{ __('menu_todos_los_proyectos') }}</span></a>
                    </li>
                    <li class="{{request()->is(session('language').'/new-project') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="/{{ session('language') }}/new-project"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Second Level">{{ __('menu_nuevo_proyecto') }}</span></a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

