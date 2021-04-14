@extends('layouts.app')
@section('title', __('backend/customer/profile-customer.titilo_perfil_cliente'))
@php($language = session('language'))
@section('header-breadcrumbs')
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">{{ __('backend/customer/profile-customer.titilo_perfil_cliente') }}</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/{{ session('language') }}/customers">{{ __('todos_clientes') }}</a></li>
                        <li class="breadcrumb-item">
                            {{ __('backend/customer/profile-customer.titilo_perfil_cliente') }}
                        </li>
                        <li class="breadcrumb-item">
                            {{ $getCompany->name }}
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <!--=====================================
		SECCIÓN TABS Y CONTENIDO
    ======================================-->
    <profile-customer :company="{{ $getCompany }}"></profile-customer>
@endsection
