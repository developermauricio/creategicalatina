@extends('layouts.app')
@section('title', __('backend/customer/create-customers.titilo_nuevo_cliente'))
@push('css')
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/file-uploaders/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/form-file-uploader.css">
@endpush
@section('header-breadcrumbs')
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">{{ __('backend/provider/create-provider.titilo_nuevo_proveedor') }}</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/{{ session('language') }}/providers">{{ __('backend/provider/provider.todos_los_proveedores') }}</a>                        </li>
                        <li class="breadcrumb-item active">
                            <a href="/{{ session('language') }}/new-providers">{{  __('backend/provider/create-provider.titilo_nuevo_proveedor') }}</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <create-new-provider></create-new-provider>
@endsection
