<template>
    <form method="post" action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu">
        <input v-for="(value, key) in dataPayu" type="hidden" :name="key" :value="value">
        <div class="p-1 text-center">
            <img src="/images/payment-platforms/payu-footer.png" width="250" alt="">
        </div>
        <button class="btn btn-primary btn-block btn-next place-order" type="submit">
            Paga con Payu
        </button>
    </form>
</template>

<script>
export default {
    name: "PayuComponent",

    props: ['dataPayu']
}
</script>

<style scoped>

</style>
