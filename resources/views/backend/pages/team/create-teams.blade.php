@extends('layouts.app')
@section('title', __('backend/team/teams.registrar_miembro'))
@push('css')
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/file-uploaders/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/form-file-uploader.css">
@endpush
@section('header-breadcrumbs')
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">{{ __('backend/team/teams.registrar_miembro') }}</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/{{ session('language') }}/members-team">{{ __('todos_los_miembros') }}</a>                        </li>
                        <li class="breadcrumb-item active">
                            <a href="/{{ session('language') }}/new-member">{{ __('backend/team/teams.registrar_miembro') }}</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
       <create-new-member></create-new-member>
@endsection
