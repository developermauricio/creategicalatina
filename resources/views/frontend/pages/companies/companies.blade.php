@extends('layouts.app-frontend')

@section('title', __('todas_las_empresas'))
@section('header-breadcrumbs')
    <div class="content-header-left col-md-9 col-9 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">{{ __('empresas') }}</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a
                                href="/{{ session('language') }}/customer-companies">{{ __('todas_las_empresas') }}</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-3">
        <div class="d-flex align-items-center float-right ml-5">
            <div class="btn-group btn-group-toggle view-toggle ml-50" data-toggle="buttons">
                <label class="btn btn-outline-primary border-btn-list-team grid-team p-50 btn-sm active">
                    <input type="radio" name="view-btn-radio" data-view="grid" checked/>
                    <i data-feather="grid"></i>
                </label>
                <label class="btn btn-outline-primary border-btn-list-team list-team p-50 btn-sm">
                    <input type="radio" name="view-btn-radio" data-view="list"/>
                    <i data-feather="list"></i>
                </label>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <grid-lists-companies></grid-lists-companies>
@endsection
