<nav class="header-navbar navbar navbar-expand-lg align-items-center fixed-top navbar-light navbar-shadow">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon"
                                                                                                   data-feather="menu"></i></a>
                </li>
            </ul>
            <ul class="nav navbar-nav bookmark-icons">
                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-email.html"
                                                          data-toggle="tooltip" data-placement="top"
                                                          title="Email"><i class="ficon"
                                                                           data-feather="mail"></i></a></li>
                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-chat.html"
                                                          data-toggle="tooltip" data-placement="top" title="Chat"><i
                            class="ficon" data-feather="message-square"></i></a></li>
                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-calendar.html"
                                                          data-toggle="tooltip" data-placement="top"
                                                          title="Calendar"><i class="ficon"
                                                                              data-feather="calendar"></i></a></li>
                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-todo.html"
                                                          data-toggle="tooltip" data-placement="top" title="Todo"><i
                            class="ficon" data-feather="check-square"></i></a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="nav-item d-none d-lg-block"><a class="nav-link bookmark-star"><i
                            class="ficon text-warning" data-feather="star"></i></a>
                    <div class="bookmark-input search-input">
                        <div class="bookmark-input-icon"><i data-feather="search"></i></div>
                        <input class="form-control input" type="text" placeholder="Bookmark" tabindex="0"
                               data-search="search">
                        <ul class="search-list search-list-bookmark"></ul>
                    </div>
                </li>
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ml-auto">
            <currency-list></currency-list>
            <li class="nav-item dropdown dropdown-language">
                <a class="nav-link dropdown-toggle" id="dropdown-flag"
                   href="javascript:void(0);" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                   <p style="margin: 0">Idioma</p>
                   <i
                        class="flag-icon {{ session('language') == 'es' ? 'flag-icon-es' : 'flag-icon-us'  }} "></i><span
                        class="selected-language">{{ session('language') == 'es' ?  __('Español')  :  __('Inglés')  }}</span></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-flag">
                    @foreach(config('lenguages') as $key => $value)
                        <a class="dropdown-item" href="{{ route('set_lenguage', [$key]) }}" data-language="">
                            <i class="flag-icon {{ $value['flag'] }}"></i> {{__($value['language'])}}</a>
                    @endforeach
                    {{--                    <a class="dropdown-item" href="javascript:void(0);" data-language="en">--}}
                    {{--                        <i class="flag-icon flag-icon-es"></i> Español</a>--}}
                    {{--                    <a class="dropdown-item" href="javascript:void(0);" data-language="fr">--}}
                    {{--                        <i class="flag-icon flag-icon-us"></i> Inglés</a>--}}
                </div>
            </li>
            <li class="nav-item d-lg-block">
                <a class="nav-link nav-link-style" data-toggle="modal" data-target="#modal-change-theme-backend">
                    <i class="ficon" data-feather="moon"></i>
                </a>
            </li>
            <!--=====================================
		            BUSCADOR
            ======================================-->
{{--            <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon" data-feather="search"></i></a>--}}
{{--                <div class="search-input">--}}
{{--                    <div class="search-input-icon"><i data-feather="search"></i></div>--}}
{{--                    <input class="form-control input" type="text" placeholder="Explore Vuexy..." tabindex="-1"--}}
{{--                           data-search="search">--}}
{{--                    <div class="search-input-close"><i data-feather="x"></i></div>--}}
{{--                    <ul class="search-list search-list-main"></ul>--}}
{{--                </div>--}}
{{--            </li>--}}
            <!--=====================================
		          CARRITO
            ======================================-->
{{--            <li class="nav-item dropdown dropdown-cart mr-25"><a class="nav-link" href="javascript:void(0);"--}}
{{--                                                                 data-toggle="dropdown"><i class="ficon"--}}
{{--                                                                                           data-feather="shopping-cart"></i><span--}}
{{--                        class="badge badge-pill badge-primary badge-up cart-item-count">6</span></a>--}}
{{--                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">--}}
{{--                    <li class="dropdown-menu-header">--}}
{{--                        <div class="dropdown-header d-flex">--}}
{{--                            <h4 class="notification-title mb-0 mr-auto">My Cart</h4>--}}
{{--                            <div class="badge badge-pill badge-light-primary">4 Items</div>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                    <li class="scrollable-container media-list">--}}
{{--                        <div class="media align-items-center"><img class="d-block rounded mr-1"--}}
{{--                                                                   src="/app-assets/images/pages/eCommerce/1.png"--}}
{{--                                                                   alt="donuts" width="62">--}}
{{--                            <div class="media-body"><i class="ficon cart-item-remove" data-feather="x"></i>--}}
{{--                                <div class="media-heading">--}}
{{--                                    <h6 class="cart-item-title"><a class="text-body"--}}
{{--                                                                   href="app-ecommerce-details.html"> Apple watch--}}
{{--                                            5</a></h6><small class="cart-item-by">By Apple</small>--}}
{{--                                </div>--}}
{{--                                <div class="cart-item-qty">--}}
{{--                                    <div class="input-group">--}}
{{--                                        <input class="touchspin-cart" type="number" value="1">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <h5 class="cart-item-price">$374.90</h5>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="media align-items-center"><img class="d-block rounded mr-1"--}}
{{--                                                                   src="/app-assets/images/pages/eCommerce/7.png"--}}
{{--                                                                   alt="donuts" width="62">--}}
{{--                            <div class="media-body"><i class="ficon cart-item-remove" data-feather="x"></i>--}}
{{--                                <div class="media-heading">--}}
{{--                                    <h6 class="cart-item-title"><a class="text-body"--}}
{{--                                                                   href="app-ecommerce-details.html"> Google Home--}}
{{--                                            Mini</a></h6><small class="cart-item-by">By Google</small>--}}
{{--                                </div>--}}
{{--                                <div class="cart-item-qty">--}}
{{--                                    <div class="input-group">--}}
{{--                                        <input class="touchspin-cart" type="number" value="3">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <h5 class="cart-item-price">$129.40</h5>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="media align-items-center"><img class="d-block rounded mr-1"--}}
{{--                                                                   src="/app-assets/images/pages/eCommerce/2.png"--}}
{{--                                                                   alt="donuts" width="62">--}}
{{--                            <div class="media-body"><i class="ficon cart-item-remove" data-feather="x"></i>--}}
{{--                                <div class="media-heading">--}}
{{--                                    <h6 class="cart-item-title"><a class="text-body"--}}
{{--                                                                   href="app-ecommerce-details.html"> iPhone 11--}}
{{--                                            Pro</a></h6><small class="cart-item-by">By Apple</small>--}}
{{--                                </div>--}}
{{--                                <div class="cart-item-qty">--}}
{{--                                    <div class="input-group">--}}
{{--                                        <input class="touchspin-cart" type="number" value="2">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <h5 class="cart-item-price">$699.00</h5>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="media align-items-center"><img class="d-block rounded mr-1"--}}
{{--                                                                   src="/app-assets/images/pages/eCommerce/3.png"--}}
{{--                                                                   alt="donuts" width="62">--}}
{{--                            <div class="media-body"><i class="ficon cart-item-remove" data-feather="x"></i>--}}
{{--                                <div class="media-heading">--}}
{{--                                    <h6 class="cart-item-title"><a class="text-body"--}}
{{--                                                                   href="app-ecommerce-details.html"> iMac Pro</a>--}}
{{--                                    </h6><small class="cart-item-by">By Apple</small>--}}
{{--                                </div>--}}
{{--                                <div class="cart-item-qty">--}}
{{--                                    <div class="input-group">--}}
{{--                                        <input class="touchspin-cart" type="number" value="1">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <h5 class="cart-item-price">$4,999.00</h5>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="media align-items-center"><img class="d-block rounded mr-1"--}}
{{--                                                                   src="/app-assets/images/pages/eCommerce/5.png"--}}
{{--                                                                   alt="donuts" width="62">--}}
{{--                            <div class="media-body"><i class="ficon cart-item-remove" data-feather="x"></i>--}}
{{--                                <div class="media-heading">--}}
{{--                                    <h6 class="cart-item-title"><a class="text-body"--}}
{{--                                                                   href="app-ecommerce-details.html"> MacBook--}}
{{--                                            Pro</a></h6><small class="cart-item-by">By Apple</small>--}}
{{--                                </div>--}}
{{--                                <div class="cart-item-qty">--}}
{{--                                    <div class="input-group">--}}
{{--                                        <input class="touchspin-cart" type="number" value="1">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <h5 class="cart-item-price">$2,999.00</h5>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                    <li class="dropdown-menu-footer">--}}
{{--                        <div class="d-flex justify-content-between mb-1">--}}
{{--                            <h6 class="font-weight-bolder mb-0">Total:</h6>--}}
{{--                            <h6 class="text-primary font-weight-bolder mb-0">$10,999.00</h6>--}}
{{--                        </div>--}}
{{--                        <a class="btn btn-primary btn-block" href="app-ecommerce-checkout.html">Checkout</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}
            <!--=====================================
		            NOTIFICACIONES
            ======================================-->
            <notifications-backend :user_id="{{ auth()->user()->id }}"></notifications-backend>
            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name font-weight-bolder">{{ auth()->user()->name }}</span>
                        @php($rol = json_decode(auth()->user()->roles->pluck('language')->implode(', ')))
                        <span class="user-status">{{ $rol->{session('language')} }}</span>
                    </div>
                    <span class="avatar">
                        <img id="photoProfile" class="round" src="{{ auth()->user()->picture }}" alt="avatar" height="40" width="40">
                        <span class="avatar-status-online"></span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user"><a
                        class="dropdown-item"
                        href="/{{ session('language') }}/admin/profile/{{ auth()->user()->slug }}"><i class="mr-50"
                                                                                                      data-feather="user"></i>
                        {{ __('Perfil') }}</a><a class="dropdown-item" href="app-email.html"><i class="mr-50"
                                                                                                data-feather="mail"></i>
                        {{ __('Inbox') }}</a><a
                        class="dropdown-item" href="app-todo.html"><i class="mr-50" data-feather="check-square"></i>
                        {{ __('Tareas') }}</a><a class="dropdown-item" href="app-chat.html"><i class="mr-50"
                                                                                               data-feather="message-square"></i>
                        {{ __('Chats') }}</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="page-account-settings.html"><i class="mr-50"
                                                                                  data-feather="settings"></i>
                        {{ __('Configuración') }}</a>
                    <a class="dropdown-item" href="page-faq.html">
                        <i class="mr-50" data-feather="help-circle"></i>
                        {{ __('Ayuda') }}</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item" href="page-auth-login-v2.html">
                            <i class="mr-50" data-feather="power"></i>
                            {{ __('Cerrar Sessión') }}
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
