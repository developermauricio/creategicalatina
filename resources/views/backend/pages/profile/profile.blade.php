@extends('layouts.app')
@section('title', __('backend/profile/changed-password.titulo_perfil'))
@push('css')
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/file-uploaders/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/form-file-uploader.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/app-user.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/page-auth.css">
@endpush
@section('header-breadcrumbs')
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">{{ __('backend/profile/changed-password.titulo_perfil') }}</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">
                            <a href="/{{ session('language') }}/admin/profile/{{ $user->slug }}">{{ __('backend/profile/changed-password.titulo_perfil') }}</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <section class="app-user-view">
        <!-- User Card & Plan Starts -->
        <div class="row">
        <!-- User Card starts-->
            <div class="col-xl-9 col-lg-8 col-md-7">
                <div class="card user-card">
                    <div class="card-body">
                        <div class="row">
                            <div
                                class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                                <div class="user-avatar-section">
                                    <div class="d-flex justify-content-start">
                                        <img class="img-fluid rounded" src="{{ $user->picture }}" height="104"
                                             width="104" alt="User avatar"/>
                                        <div class="d-flex flex-column ml-1">
                                            <div class="user-info mb-1">
                                                <h4 class="mb-0">{{ $user->name }} {{ $user->last_name }}</h4>
                                                <span class="card-text">{{ $user->email }}</span>
                                            </div>
                                            <div class="d-flex flex-wrap">
                                                <a href="./app-user-edit.html" class="btn btn-primary"
                                                   style="font-size: 0.91rem">{{ __('backend/profile/changed-password.btn_titulo_editar') }}</a>
                                                <button class="btn btn-outline-danger ml-1 btn-change-password-profile"
                                                        valueBtnChangedPassword="1" style="font-size: 0.91rem">
                                                    {{ __('backend/profile/changed-password.btn_titulo_contrasena') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($user->biography)
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <h4>{{ __('backend/profile/changed-password.titulo_acerca_de') }} </h4>
                                        <p style="text-align: justify">
                                            {{ $user->biography }}
                                        </p>
                                    </div>
                                </div>
                                @endif
{{--                                <div class="d-flex align-items-center user-total-numbers">--}}
{{--                                    <div class="d-flex align-items-center mr-2">--}}
{{--                                        <div class="color-box bg-light-primary">--}}
{{--                                            <i data-feather="dollar-sign" class="text-primary"></i>--}}
{{--                                        </div>--}}
{{--                                        <div class="ml-1">--}}
{{--                                            <h5 class="mb-0">23.3k</h5>--}}
{{--                                            <small>Monthly Sales</small>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="d-flex align-items-center">--}}
{{--                                        <div class="color-box bg-light-success">--}}
{{--                                            <i data-feather="trending-up" class="text-success"></i>--}}
{{--                                        </div>--}}
{{--                                        <div class="ml-1">--}}
{{--                                            <h5 class="mb-0">$99.87K</h5>--}}
{{--                                            <small>Annual Profit</small>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                            <div class="col-xl-6 col-lg-12 mt-2 mt-xl-0">
                                <!--=====================================
		                            CAMBIAR CONTRASEÑA
                                ======================================-->
                                <changued-password  :dataStateChangedPassword="2"></changued-password>
                                <!--=====================================
		                            INFORMAIÓN DEL USUARIO
                                ======================================-->
                                <div class="user-info-wrapper info-profile-user">
                                    <div class="d-flex flex-wrap">
                                        <div class="user-info-title">
                                            <i data-feather='credit-card' class="mr-1"></i>
                                            <span
                                                class="card-text user-info-title font-weight-bold mb-0">{{ __('backend/profile/changed-password.titulo_numero_identificacion') }}</span>
                                        </div>
                                        <p class="card-text mb-0">{{ $user->identification }}</p>
                                    </div>
                                    <div class="d-flex flex-wrap my-50">
                                        <div class="user-info-title">
                                            <i data-feather='credit-card' class="mr-1"></i>
                                            <span class="card-text user-info-title font-weight-bold mb-0">{{ __('backend/profile/changed-password.titulo_tipo_identificacion') }}</span>
                                        </div>
                                        <p class="card-text mb-0">{{ $user->identificationType->name }}</p>
                                    </div>
                                    <div class="d-flex flex-wrap my-50">
                                        <div class="user-info-title">
                                            <i data-feather="star" class="mr-1"></i>
                                            <span class="card-text user-info-title font-weight-bold mb-0">{{ __('backend/profile/changed-password.titulo_rol') }}:</span>
                                        </div>
                                        <p class="card-text mb-0">{{ $user->roles->pluck('name')->implode(', ') }}</p>
                                    </div>
                                    <div class="d-flex flex-wrap my-50">
                                        <div class="user-info-title">
                                            <i data-feather='map-pin' class="mr-1"></i>
                                            <span class="card-text user-info-title font-weight-bold mb-0">{{ __('backend/profile/changed-password.titulo_pais') }}</span>
                                        </div>
                                        <p class="card-text mb-0"><img width="20" class="mr-1"
                                                                       src="{{ $user->city->country->flag }}"
                                                                       alt="">{{ $user->city->country->name }}</p>
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        <div class="user-info-title">
                                            <i data-feather='phone' class="mr-1"></i>
                                            <span
                                                class="card-text user-info-title font-weight-bold mb-0">{{ __('backend/profile/changed-password.titulo_telefono') }}</span>
                                        </div>
                                        <p class="card-text mb-0">{{ $user->phone }}</p>
                                    </div>
                                    <div class="d-flex flex-wrap my-50">
                                        <div class="user-info-title">
                                            <i data-feather='map' class="mr-1"></i>
                                            <span
                                                class="card-text user-info-title font-weight-bold mb-0">{{ __('backend/profile/changed-password.titulo_direccion') }}</span>
                                        </div>
                                        <p class="card-text mb-0" data-toggle="tooltip" data-placement="top"
                                           title="{{ $user->address }}"
                                           style="cursor: pointer">{{ \Illuminate\Support\Str::limit($user->address, 25) }}</p>
                                    </div>
                                    <div class="d-flex flex-wrap my-50">
                                        <div class="user-info-title">
                                            <i data-feather='gift' class="mr-1"></i>
                                            <span
                                                class="card-text user-info-title font-weight-bold mb-0">{{ __('backend/profile/changed-password.titulo_cumpleanos') }}</span>
                                        </div>
                                        <p class="card-text mb-0 birhday-format"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /User Card Ends-->

            <!-- Plan Card starts-->
            <div class="col-xl-3 col-lg-4 col-md-5">
                <div class="card plan-card {{ $user->state == 1 ? 'border-success' : 'border-danger' }}">
                    <div class="card-header d-flex justify-content-between align-items-center pt-75 pb-1">
                        <h5 class="mb-0">{{ __('backend/profile/changed-password.titulo_desde') }}</h5>
                        <span class="badge badge-light-secondary date-create-user" data-toggle="tooltip"
                              data-placement="top" title="{{ __('backend/profile/changed-password.titulo_tooltip_fecha_registro') }}"><span
                                class="nextYear"></span>
                                    </span>
                    </div>
                    <div class="card-body">
                        <div
                            class="badge {{ $user->state == 1 ? 'badge-light-success' : 'badge-light-danger' }}">{{ $user->state == 1 ?  __('backend/profile/changed-password.titulo_estado_activo') : __('backend/profile/changed-password.titulo_estado_inactivo') }}</div>
                        <ul class="list-unstyled my-1">
                            <li>
                                <span class="align-middle">Presidente</span>
                            </li>
                        </ul>
                        <img width="150" src="{{ env('IMG_LOGO') }}" alt="">
                    </div>
                </div>
            </div>
            <!-- /Plan CardEnds -->
        </div>
        <!-- User Card & Plan Ends -->

        <!-- User Timeline & Permissions Starts -->
{{--        <div class="row">--}}
{{--            <!-- information starts -->--}}
{{--            <div class="col-md-6">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        <h4 class="card-title mb-2">User Timeline</h4>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <ul class="timeline">--}}
{{--                            <li class="timeline-item">--}}
{{--                                <span class="timeline-point timeline-point-indicator"></span>--}}
{{--                                <div class="timeline-event">--}}
{{--                                    <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">--}}
{{--                                        <h6>12 Invoices have been paid</h6>--}}
{{--                                        <span class="timeline-event-time">12 min ago</span>--}}
{{--                                    </div>--}}
{{--                                    <p>Invoices have been paid to the company.</p>--}}
{{--                                    <div class="media align-items-center">--}}
{{--                                        <img class="mr-1" src="../../../app-assets/images/icons/file-icons/pdf.png"--}}
{{--                                             alt="invoice" height="23"/>--}}
{{--                                        <div class="media-body">invoice.pdf</div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li class="timeline-item">--}}
{{--                                <span class="timeline-point timeline-point-warning timeline-point-indicator"></span>--}}
{{--                                <div class="timeline-event">--}}
{{--                                    <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">--}}
{{--                                        <h6>Client Meeting</h6>--}}
{{--                                        <span class="timeline-event-time">45 min ago</span>--}}
{{--                                    </div>--}}
{{--                                    <p>Project meeting with john @10:15am.</p>--}}
{{--                                    <div class="media align-items-center">--}}
{{--                                        <div class="avatar">--}}
{{--                                            <img src="../../../app-assets/images/avatars/12-small.png" alt="avatar"--}}
{{--                                                 height="38" width="38"/>--}}
{{--                                        </div>--}}
{{--                                        <div class="media-body ml-50">--}}
{{--                                            <h6 class="mb-0">John Doe (Client)</h6>--}}
{{--                                            <span>CEO of Infibeam</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li class="timeline-item">--}}
{{--                                <span class="timeline-point timeline-point-info timeline-point-indicator"></span>--}}
{{--                                <div class="timeline-event">--}}
{{--                                    <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">--}}
{{--                                        <h6>Create a new project for client</h6>--}}
{{--                                        <span class="timeline-event-time">2 days ago</span>--}}
{{--                                    </div>--}}
{{--                                    <p class="mb-0">Add files to new design folder</p>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- information Ends -->--}}

{{--            <!-- User Permissions Starts -->--}}
{{--            <div class="col-md-6">--}}
{{--                <!-- User Permissions -->--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        <h4 class="card-title">Permissions</h4>--}}
{{--                    </div>--}}
{{--                    <p class="card-text ml-2">Permission according to roles</p>--}}
{{--                    <div class="table-responsive">--}}
{{--                        <table class="table table-striped table-borderless">--}}
{{--                            <thead class="thead-light">--}}
{{--                            <tr>--}}
{{--                                <th>Module</th>--}}
{{--                                <th>Read</th>--}}
{{--                                <th>Write</th>--}}
{{--                                <th>Create</th>--}}
{{--                                <th>Delete</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            <tr>--}}
{{--                                <td>Admin</td>--}}
{{--                                <td>--}}
{{--                                    <div class="custom-control custom-checkbox">--}}
{{--                                        <input type="checkbox" class="custom-control-input" id="admin-read" checked--}}
{{--                                               disabled/>--}}
{{--                                        <label class="custom-control-label" for="admin-read"></label>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <div class="custom-control custom-checkbox">--}}
{{--                                        <input type="checkbox" class="custom-control-input" id="admin-write" disabled/>--}}
{{--                                        <label class="custom-control-label" for="admin-write"></label>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <div class="custom-control custom-checkbox">--}}
{{--                                        <input type="checkbox" class="custom-control-input" id="admin-create" disabled/>--}}
{{--                                        <label class="custom-control-label" for="admin-create"></label>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <div class="custom-control custom-checkbox">--}}
{{--                                        <input type="checkbox" class="custom-control-input" id="admin-delete" disabled/>--}}
{{--                                        <label class="custom-control-label" for="admin-delete"></label>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td>Staff</td>--}}
{{--                                <td>--}}
{{--                                    <div class="custom-control custom-checkbox">--}}
{{--                                        <input type="checkbox" class="custom-control-input" id="staff-read" disabled/>--}}
{{--                                        <label class="custom-control-label" for="staff-read"></label>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <div class="custom-control custom-checkbox">--}}
{{--                                        <input type="checkbox" class="custom-control-input" id="staff-write" checked--}}
{{--                                               disabled/>--}}
{{--                                        <label class="custom-control-label" for="staff-write"></label>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <div class="custom-control custom-checkbox">--}}
{{--                                        <input type="checkbox" class="custom-control-input" id="staff-create" disabled/>--}}
{{--                                        <label class="custom-control-label" for="staff-create"></label>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <div class="custom-control custom-checkbox">--}}
{{--                                        <input type="checkbox" class="custom-control-input" id="staff-delete" disabled/>--}}
{{--                                        <label class="custom-control-label" for="staff-delete"></label>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td>Author</td>--}}
{{--                                <td>--}}
{{--                                    <div class="custom-control custom-checkbox">--}}
{{--                                        <input type="checkbox" class="custom-control-input" id="author-read" checked--}}
{{--                                               disabled/>--}}
{{--                                        <label class="custom-control-label" for="author-read"></label>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <div class="custom-control custom-checkbox">--}}
{{--                                        <input type="checkbox" class="custom-control-input" id="author-write" disabled/>--}}
{{--                                        <label class="custom-control-label" for="author-write"></label>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <div class="custom-control custom-checkbox">--}}
{{--                                        <input type="checkbox" class="custom-control-input" id="author-create" checked--}}
{{--                                               disabled/>--}}
{{--                                        <label class="custom-control-label" for="author-create"></label>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <div class="custom-control custom-checkbox">--}}
{{--                                        <input type="checkbox" class="custom-control-input" id="author-delete"--}}
{{--                                               disabled/>--}}
{{--                                        <label class="custom-control-label" for="author-delete"></label>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td>Contributor</td>--}}
{{--                                <td>--}}
{{--                                    <div class="custom-control custom-checkbox">--}}
{{--                                        <input type="checkbox" class="custom-control-input" id="contributor-read"--}}
{{--                                               disabled/>--}}
{{--                                        <label class="custom-control-label" for="contributor-read"></label>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <div class="custom-control custom-checkbox">--}}
{{--                                        <input type="checkbox" class="custom-control-input" id="contributor-write"--}}
{{--                                               disabled/>--}}
{{--                                        <label class="custom-control-label" for="contributor-write"></label>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <div class="custom-control custom-checkbox">--}}
{{--                                        <input type="checkbox" class="custom-control-input" id="contributor-create"--}}
{{--                                               disabled/>--}}
{{--                                        <label class="custom-control-label" for="contributor-create"></label>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <div class="custom-control custom-checkbox">--}}
{{--                                        <input type="checkbox" class="custom-control-input" id="contributor-delete"--}}
{{--                                               disabled/>--}}
{{--                                        <label class="custom-control-label" for="contributor-delete"></label>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td>User</td>--}}
{{--                                <td>--}}
{{--                                    <div class="custom-control custom-checkbox">--}}
{{--                                        <input type="checkbox" class="custom-control-input" id="user-read" disabled/>--}}
{{--                                        <label class="custom-control-label" for="user-read"></label>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <div class="custom-control custom-checkbox">--}}
{{--                                        <input type="checkbox" class="custom-control-input" id="user-create" disabled/>--}}
{{--                                        <label class="custom-control-label" for="user-create"></label>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <div class="custom-control custom-checkbox">--}}
{{--                                        <input type="checkbox" class="custom-control-input" id="user-write" disabled/>--}}
{{--                                        <label class="custom-control-label" for="user-write"></label>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <div class="custom-control custom-checkbox">--}}
{{--                                        <input type="checkbox" class="custom-control-input" id="user-delete" checked--}}
{{--                                               disabled/>--}}
{{--                                        <label class="custom-control-label" for="user-delete"></label>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- /User Permissions -->--}}
{{--            </div>--}}
{{--            <!-- User Permissions Ends -->--}}
{{--        </div>--}}
    </section>
@endsection
@push('js')
    <script src="/app-assets/js/scripts/pages/app-user-view.js"></script>
    <script src="/js/moment.js"></script>
    <script src="/js/moment-locale.js"></script>
    <script src="/app-assets/js/scripts/pages/page-auth-reset-password.js"></script>
    <script>
        $(function () {
            /*=============================================
                FORMATEAR FECHAS
            =============================================*/
            brithdayUser = '{{ $user->birthday }}' //Fecha de nacimiento del usuario
            brithdayCreateUser = '{{ $user->created_at }}' //Fecha de registro
            dateUser = moment(brithdayUser).locale(window.lang).format("MMMM Do, YYYY")
            dateCreateUser = moment(brithdayCreateUser).locale(window.lang).format("dddd, MMMM Do YYYY")
            $('.birhday-format').html(dateUser);
            $('.date-create-user').html(dateCreateUser);

            /*=============================================
                CAMBIAR CONTRASEÑA
            =============================================*/
            $(".btn-change-password-profile").click(function () {
                valuetBtn = $(this).attr('valueBtnChangedPassword');
                if (valuetBtn == '1') {
                    $('.info-profile-user').hide();
                    $('.form-changed-password').show();
                    $(this).attr('valueBtnChangedPassword', '2');
                    $('.btn-change-password-profile').html('{{ __('backend/profile/changed-password.btn_titulo_cancelar') }}');
                    // $('.component-changed-password').attr('dataStateChangedPassword', 1)
                    window.stateShowPassword = 1
                } else {
                    $('.info-profile-user').show();
                    $('.form-changed-password').hide();
                    $(this).attr('valueBtnChangedPassword', '1');
                    $('.btn-change-password-profile').html('{{ __('backend/profile/changed-password.btn_titulo_contrasena') }}');
                    // $('.component-changed-password').attr('dataStateChangedPassword', 2)
                    window.stateShowPassword = 2
                }

            });
        })
    </script>
@endpush
