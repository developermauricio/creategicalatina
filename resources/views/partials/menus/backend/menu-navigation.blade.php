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
    {{--    @php($userAdministrator = auth()->user()->hasRole('Administrator'))--}}
    {{--    @if($userAdministrator == 'Administrator')--}}
    {{--        @include('partials.menus.backend.admin-menu')--}}
    {{--    @endif--}}
    @role('Customer')
    @include('partials.menus.backend.customer-menu')
    @endrole
    @role('Administrator')
    @include('partials.menus.backend.admin-menu')
    @endrole
</div>
