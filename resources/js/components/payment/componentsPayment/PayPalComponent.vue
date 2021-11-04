<template>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <span>{{ $t('payment.homePayment.text_paypal') }}</span>
        </div>
    </div>
</template>

<script>
    export default {
        name:'PayPalComponent',
        props: ['payment', "current_user"],
        mounted() { }
    }
</script>
