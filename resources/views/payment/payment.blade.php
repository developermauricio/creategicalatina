@extends('layouts.app')

@section('content')

    <home-payment :list_currencies='{{ $listCurrencies }}'
        :list_payment_platforms='{{ $listPaymentPlatforms }}'
        :current_user='{{ $currentUser }}'/>

@endsection

@push('js')
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
@endpush
