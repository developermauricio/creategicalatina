@extends('layouts.app')

@section('title', __('Configurar Proyecto'))
@push('css')
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/file-uploaders/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/form-file-uploader.css">
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
                            Configurar Proyectos
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-12">
        <div class="d-flex align-items-center float-right">
            <a type="button" class="float-right btn btn-primary waves-effect waves-float waves-light" id="btnShowNewTypeProject"><i data-feather='plus' class="mr-1"></i>Nuevo tipo proyecto</a>
        </div>
    </div>
@endsection

@section('content')
    {{--    @dd($project)--}}
    <project-configuration></project-configuration>
    <add-type-project></add-type-project>
@endsection
@push('js')
    <script>
        $(function () {
            $("#btnShowNewTypeProject").click(function () {
                console.log('click button')
                $('#openModalAddTypeProject').val(1).click()
                // $('#componet-project-setup').attr("showProjectSetup", true)
            })
        });
    </script>
@endpush
