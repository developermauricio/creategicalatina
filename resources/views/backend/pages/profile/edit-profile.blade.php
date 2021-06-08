@extends('layouts.app')

@section('content')

    <edit-profile :current_user='{{ $currentUser }}' />

@endsection

@push( 'css')
<style>
    .swal-confirnt-data-profile {
        width: 70em !important;
    }
</style>
@endpush

@push('js')

@endpush
