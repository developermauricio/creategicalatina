@extends('layouts.app')

@section('title', 'Configuración Equipo de Trabajo')
@section('header-breadcrumbs')
    <div class="content-header-left col-md-9 col-9 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Configuración Equipo de Trabajo</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a
                                href="/{{ session('language') }}/members-team">{{ __('todos_los_miembros') }}</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')

@endsection
