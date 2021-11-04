@extends('layouts.app')

@section('title', $project->name)
@push('css')
    <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/page-profile.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/app-invoice.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
@endpush
@section('header-breadcrumbs')
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">{{ __('frontend/projects/all-projects.titulo_pestana_projects_company') }}</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a
                                href="/{{ session('language') }}/admin-projects">{{ __('todos_los_proyectos') }}</a>
                        </li>
                        <li class="breadcrumb-item active">
                            {{  $project->name }}
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <project-detail-admin :project="{{ $project }}"></project-detail-admin>
@endsection
