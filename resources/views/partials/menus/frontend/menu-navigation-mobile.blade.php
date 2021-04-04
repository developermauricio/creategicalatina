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
                <li class="dropdown nav-item" data-menu="dropdown"><a
                        class="dropdown-toggle nav-link d-flex align-items-center" href="index.html"
                        data-toggle="dropdown"><i data-feather="home"></i><span
                            data-i18n="Dashboards">Dashboards</span></a>
                    <ul class="dropdown-menu">
                        <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                            href="dashboard-analytics.html" data-toggle="dropdown"
                                            data-i18n="Analytics"><i data-feather="activity"></i><span
                                    data-i18n="Analytics">Analytics</span></a>
                        </li>
                        <li class="active" data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                           href="dashboard-ecommerce.html" data-toggle="dropdown"
                                                           data-i18n="eCommerce"><i
                                    data-feather="shopping-cart"></i><span
                                    data-i18n="eCommerce">eCommerce</span></a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown nav-item" data-menu="dropdown"><a
                        class="dropdown-toggle nav-link d-flex align-items-center" href="#"
                        data-toggle="dropdown"><i data-feather="package"></i><span data-i18n="Apps">Apps</span></a>
                    <ul class="dropdown-menu">
                        <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="app-email.html"
                                            data-toggle="dropdown" data-i18n="Email"><i
                                    data-feather="mail"></i><span data-i18n="Email">Email</span></a>
                        </li>
                        <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="app-chat.html"
                                            data-toggle="dropdown" data-i18n="Chat"><i
                                    data-feather="message-square"></i><span data-i18n="Chat">Chat</span></a>
                        </li>
                        <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="app-todo.html"
                                            data-toggle="dropdown" data-i18n="Todo"><i
                                    data-feather="check-square"></i><span data-i18n="Todo">Todo</span></a>
                        </li>
                        <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="app-calendar.html"
                                            data-toggle="dropdown" data-i18n="Calendar"><i
                                    data-feather="calendar"></i><span data-i18n="Calendar">Calendar</span></a>
                        </li>
                        <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="app-kanban.html"
                                            data-toggle="dropdown" data-i18n="Kanban"><i
                                    data-feather="grid"></i><span data-i18n="Kanban">Kanban</span></a>
                        </li>
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                class="dropdown-item d-flex align-items-center dropdown-toggle" href="#"
                                data-toggle="dropdown" data-i18n="Invoice"><i data-feather="file-text"></i><span
                                    data-i18n="Invoice">Invoice</span></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="app-invoice-list.html" data-toggle="dropdown"
                                                    data-i18n="List"><i data-feather="circle"></i><span
                                            data-i18n="List">List</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="app-invoice-preview.html" data-toggle="dropdown"
                                                    data-i18n="Preview"><i data-feather="circle"></i><span
                                            data-i18n="Preview">Preview</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="app-invoice-edit.html" data-toggle="dropdown"
                                                    data-i18n="Edit"><i data-feather="circle"></i><span
                                            data-i18n="Edit">Edit</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="app-invoice-add.html" data-toggle="dropdown"
                                                    data-i18n="Add"><i data-feather="circle"></i><span
                                            data-i18n="Add">Add</span></a>
                                </li>
                            </ul>
                        </li>
                        <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                            href="app-file-manager.html" data-toggle="dropdown"
                                            data-i18n="File Manager"><i data-feather="save"></i><span
                                    data-i18n="File Manager">File Manager</span></a>
                        </li>
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                class="dropdown-item d-flex align-items-center dropdown-toggle" href="#"
                                data-toggle="dropdown" data-i18n="eCommerce"><i
                                    data-feather="shopping-cart"></i><span
                                    data-i18n="eCommerce">eCommerce</span></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="app-ecommerce-shop.html" data-toggle="dropdown"
                                                    data-i18n="Shop"><i data-feather="circle"></i><span
                                            data-i18n="Shop">Shop</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="app-ecommerce-details.html" data-toggle="dropdown"
                                                    data-i18n="Details"><i data-feather="circle"></i><span
                                            data-i18n="Details">Details</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="app-ecommerce-wishlist.html" data-toggle="dropdown"
                                                    data-i18n="Wishlist"><i data-feather="circle"></i><span
                                            data-i18n="Wishlist">Wishlist</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="app-ecommerce-checkout.html" data-toggle="dropdown"
                                                    data-i18n="Checkout"><i data-feather="circle"></i><span
                                            data-i18n="Checkout">Checkout</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                class="dropdown-item d-flex align-items-center dropdown-toggle" href="#"
                                data-toggle="dropdown" data-i18n="User"><i data-feather="user"></i><span
                                    data-i18n="User">User</span></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="app-user-list.html" data-toggle="dropdown"
                                                    data-i18n="List"><i data-feather="circle"></i><span
                                            data-i18n="List">List</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="app-user-view.html" data-toggle="dropdown"
                                                    data-i18n="View"><i data-feather="circle"></i><span
                                            data-i18n="View">View</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="app-user-edit.html" data-toggle="dropdown"
                                                    data-i18n="Edit"><i data-feather="circle"></i><span
                                            data-i18n="Edit">Edit</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="dropdown nav-item" data-menu="dropdown"><a
                        class="dropdown-toggle nav-link d-flex align-items-center" href="#"
                        data-toggle="dropdown"><i data-feather="layers"></i><span data-i18n="User Interface">User Interface</span></a>
                    <ul class="dropdown-menu">
                        <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                            href="ui-typography.html" data-toggle="dropdown" data-i18n="Typography"><i
                                    data-feather="type"></i><span data-i18n="Typography">Typography</span></a>
                        </li>
                        <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="ui-colors.html"
                                            data-toggle="dropdown" data-i18n="Colors"><i data-feather="droplet"></i><span
                                    data-i18n="Colors">Colors</span></a>
                        </li>
                        <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="ui-feather.html"
                                            data-toggle="dropdown" data-i18n="Feather"><i
                                    data-feather="eye"></i><span data-i18n="Feather">Feather</span></a>
                        </li>
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                class="dropdown-item d-flex align-items-center dropdown-toggle" href="#"
                                data-toggle="dropdown" data-i18n="Cards"><i data-feather="credit-card"></i><span
                                    data-i18n="Cards">Cards</span></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="card-basic.html" data-toggle="dropdown" data-i18n="Basic"><i
                                            data-feather="circle"></i><span data-i18n="Basic">Basic</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="card-advance.html" data-toggle="dropdown"
                                                    data-i18n="Advance"><i data-feather="circle"></i><span
                                            data-i18n="Advance">Advance</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="card-statistics.html" data-toggle="dropdown"
                                                    data-i18n="Statistics"><i data-feather="circle"></i><span
                                            data-i18n="Statistics">Statistics</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="card-analytics.html" data-toggle="dropdown"
                                                    data-i18n="Analytics"><i data-feather="circle"></i><span
                                            data-i18n="Analytics">Analytics</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="card-actions.html" data-toggle="dropdown"
                                                    data-i18n="Card Actions"><i data-feather="circle"></i><span
                                            data-i18n="Card Actions">Card Actions</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                class="dropdown-item d-flex align-items-center dropdown-toggle" href="#"
                                data-toggle="dropdown" data-i18n="Components"><i data-feather="briefcase"></i><span
                                    data-i18n="Components">Components</span></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="component-alerts.html" data-toggle="dropdown"
                                                    data-i18n="Alerts"><i data-feather="circle"></i><span
                                            data-i18n="Alerts">Alerts</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="component-avatar.html" data-toggle="dropdown"
                                                    data-i18n="Avatar"><i data-feather="circle"></i><span
                                            data-i18n="Avatar">Avatar</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="component-badges.html" data-toggle="dropdown"
                                                    data-i18n="Badges"><i data-feather="circle"></i><span
                                            data-i18n="Badges">Badges</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="component-breadcrumbs.html" data-toggle="dropdown"
                                                    data-i18n="Breadcrumbs"><i data-feather="circle"></i><span
                                            data-i18n="Breadcrumbs">Breadcrumbs</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="component-buttons.html" data-toggle="dropdown"
                                                    data-i18n="Buttons"><i data-feather="circle"></i><span
                                            data-i18n="Buttons">Buttons</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="component-carousel.html" data-toggle="dropdown"
                                                    data-i18n="Carousel"><i data-feather="circle"></i><span
                                            data-i18n="Carousel">Carousel</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="component-collapse.html" data-toggle="dropdown"
                                                    data-i18n="Collapse"><i data-feather="circle"></i><span
                                            data-i18n="Collapse">Collapse</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="component-divider.html" data-toggle="dropdown"
                                                    data-i18n="Divider"><i data-feather="circle"></i><span
                                            data-i18n="Divider">Divider</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="component-dropdowns.html" data-toggle="dropdown"
                                                    data-i18n="Dropdowns"><i data-feather="circle"></i><span
                                            data-i18n="Dropdowns">Dropdowns</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="component-list-group.html" data-toggle="dropdown"
                                                    data-i18n="List Group"><i data-feather="circle"></i><span
                                            data-i18n="List Group">List Group</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="component-media-objects.html" data-toggle="dropdown"
                                                    data-i18n=""><i data-feather="circle"></i><span data-i18n="">Media Objects</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="component-modals.html" data-toggle="dropdown"
                                                    data-i18n="Modals"><i data-feather="circle"></i><span
                                            data-i18n="Modals">Modals</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="component-navs-component.html" data-toggle="dropdown"
                                                    data-i18n="Navs Component"><i data-feather="circle"></i><span
                                            data-i18n="Navs Component">Navs Component</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="component-pagination.html" data-toggle="dropdown"
                                                    data-i18n="Pagination"><i data-feather="circle"></i><span
                                            data-i18n="Pagination">Pagination</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="component-pill-badges.html" data-toggle="dropdown"
                                                    data-i18n="Pill Badges"><i data-feather="circle"></i><span
                                            data-i18n="Pill Badges">Pill Badges</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="component-pills-component.html" data-toggle="dropdown"
                                                    data-i18n="Pills Component"><i data-feather="circle"></i><span
                                            data-i18n="Pills Component">Pills Component</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="component-popovers.html" data-toggle="dropdown"
                                                    data-i18n="Popovers"><i data-feather="circle"></i><span
                                            data-i18n="Popovers">Popovers</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="component-progress.html" data-toggle="dropdown"
                                                    data-i18n="Progress"><i data-feather="circle"></i><span
                                            data-i18n="Progress">Progress</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="component-spinner.html" data-toggle="dropdown"
                                                    data-i18n="Spinner"><i data-feather="circle"></i><span
                                            data-i18n="Spinner">Spinner</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="component-tabs-component.html" data-toggle="dropdown"
                                                    data-i18n="Tabs Component"><i data-feather="circle"></i><span
                                            data-i18n="Tabs Component">Tabs Component</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="component-timeline.html" data-toggle="dropdown"
                                                    data-i18n="Timeline"><i data-feather="circle"></i><span
                                            data-i18n="Timeline">Timeline</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="component-bs-toast.html" data-toggle="dropdown"
                                                    data-i18n="Toasts"><i data-feather="circle"></i><span
                                            data-i18n="Toasts">Toasts</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="component-tooltips.html" data-toggle="dropdown"
                                                    data-i18n="Tooltips"><i data-feather="circle"></i><span
                                            data-i18n="Tooltips">Tooltips</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                class="dropdown-item d-flex align-items-center dropdown-toggle" href="#"
                                data-toggle="dropdown" data-i18n="Extensions"><i data-feather="box"></i><span
                                    data-i18n="Extensions">Extensions</span></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="ext-component-sweet-alerts.html" data-toggle="dropdown"
                                                    data-i18n="Sweet Alert"><i data-feather="circle"></i><span
                                            data-i18n="Sweet Alert">Sweet Alert</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="ext-component-blockui.html" data-toggle="dropdown"
                                                    data-i18n="Block UI"><i data-feather="circle"></i><span
                                            data-i18n="Block UI">BlockUI</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="ext-component-toastr.html" data-toggle="dropdown"
                                                    data-i18n="Toastr"><i data-feather="circle"></i><span
                                            data-i18n="Toastr">Toastr</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="ext-component-sliders.html" data-toggle="dropdown"
                                                    data-i18n="Sliders"><i data-feather="circle"></i><span
                                            data-i18n="Sliders">Sliders</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="ext-component-drag-drop.html" data-toggle="dropdown"
                                                    data-i18n="Drag &amp; Drop"><i data-feather="circle"></i><span
                                            data-i18n="Drag &amp; Drop">Drag &amp; Drop</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="ext-component-tour.html" data-toggle="dropdown"
                                                    data-i18n="Tour"><i data-feather="circle"></i><span
                                            data-i18n="Tour">Tour</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="ext-component-clipboard.html" data-toggle="dropdown"
                                                    data-i18n="Clipboard"><i data-feather="circle"></i><span
                                            data-i18n="Clipboard">Clipboard</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="ext-component-media-player.html" data-toggle="dropdown"
                                                    data-i18n="Media player"><i data-feather="circle"></i><span
                                            data-i18n="Media player">Media Player</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="ext-component-context-menu.html" data-toggle="dropdown"
                                                    data-i18n="Context Menu"><i data-feather="circle"></i><span
                                            data-i18n="Context Menu">Context Menu</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="ext-component-swiper.html" data-toggle="dropdown"
                                                    data-i18n="swiper"><i data-feather="circle"></i><span
                                            data-i18n="swiper">Swiper</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="ext-component-tree.html" data-toggle="dropdown"
                                                    data-i18n="Tree"><i data-feather="circle"></i><span
                                            data-i18n="Tree">Tree</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="ext-component-ratings.html" data-toggle="dropdown"
                                                    data-i18n="Ratings"><i data-feather="circle"></i><span
                                            data-i18n="Ratings">Ratings</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="ext-component-i18n.html" data-toggle="dropdown"
                                                    data-i18n="l18n"><i data-feather="circle"></i><span
                                            data-i18n="l18n">l18n</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                class="dropdown-item d-flex align-items-center dropdown-toggle" href="#"
                                data-toggle="dropdown" data-i18n="Page Layouts"><i data-feather="layout"></i><span
                                    data-i18n="Page Layouts">Page Layouts</span></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="layout-boxed.html" data-toggle="dropdown"
                                                    data-i18n="Layout Boxed"><i data-feather="circle"></i><span
                                            data-i18n="Layout Boxed">Layout Boxed</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="layout-without-menu.html" data-toggle="dropdown"
                                                    data-i18n="Without Menu"><i data-feather="circle"></i><span
                                            data-i18n="Without Menu">Without Menu</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="layout-empty.html" data-toggle="dropdown"
                                                    data-i18n="Layout Empty"><i data-feather="circle"></i><span
                                            data-i18n="Layout Empty">Layout Empty</span></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                                    href="layout-blank.html" data-toggle="dropdown"
                                                    data-i18n="Layout Blank"><i data-feather="circle"></i><span
                                            data-i18n="Layout Blank">Layout Blank</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

