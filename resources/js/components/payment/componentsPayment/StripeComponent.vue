<template>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <label class="mt-3">{{ $t('payment.homePayment.text_card_details') }}:</label>
            <div id="cardElement"></div>
            <small class="form-text" id="cardErrors" role="alert"></small>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'StripeComponent',
        props: ['payment', "current_user"],
        data() {
            return { }
        },
        mounted() {
            //console.log('env: ', process.env.VUE_APP_STRIPE_KEY)
            // TODO: pendiente consultar key del archivo .env
            const stripe = Stripe('pk_test_51IqIJgGyFFKSIaCEx96ErWEBnwr0cztvsZp6wuavYHAnw7TQWs5QOgsRgvnne6qQB45zbVVcvSLMFsig3YLxTu8t00FMfPOTRu');
            const elements = stripe.elements({locale: 'en'});
            const cardElement = elements.create('card');
            cardElement.mount('#cardElement');

            this.payment.stripe = stripe;
            this.payment.card = cardElement;
        }
    }
</script>

<style scoped>
/**
* The CSS shown here will not be introduced in the Quickstart guide, but shows
* how you can use CSS to style your Element's container.
*/
.StripeElement {
    box-sizing: border-box;

    height: 40px;

    padding: 10px 12px;

    border: 1px solid transparent;
    border-radius: 4px;
    background-color: white;

    box-shadow: 0 1px 3px 0 #e6ebf1;
    -webkit-transition: box-shadow 150ms ease;
    transition: box-shadow 150ms ease;
}

.StripeElement--focus {
    box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
    border-color: #fa755a;
}

.StripeElement--webkit-autofill {
    background-color: #fefde5 !important;
}

small#cardErrors {
    color: #ec6667;
}
</style>
