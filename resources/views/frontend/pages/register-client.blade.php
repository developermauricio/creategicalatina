@extends('layouts.app-frontend')

@php($title = \Illuminate\Support\Facades\Lang::get('frontend/landing.Solicitar Proyecto'))
@section('title', $title)
@section('content')
    <register-client></register-client>
@endsection

