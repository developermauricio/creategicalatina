<template>
        <div class="col-xl-3 col-md-4 col-lg-4 col-12 invoice-actions d-sm-none d-md-block d-lg-block d-xl-block">
            <div class="checkout-options">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-outline-secondary btn-block mb-3 mp-3" :href="'/'+language+'/admin/invoice-print/'+dataInvoice.slug" target="_blank">
                            Descargar o Imprimir
                        </a>
                        <label class="section-label mb-1">Checkout</label>
                        <div class="coupons input-group input-group-merge">
                            <input type="text" class="form-control" placeholder="Codigo de descuento"
                                   aria-label="Ingresa cupón" aria-describedby="input-coupons"/>
                            <div class="input-group-append">
                                <span class="input-group-text text-primary" id="input-coupons">Aplicar</span>
                            </div>
                        </div>
                        <hr/>
                        <div class="price-details">
                            <h6 class="price-title">Detalle</h6>
                            <ul class="list-unstyled">
                                <li class="price-detail">
                                    <div class="detail-title">Subtotal</div>
                                    <div class="detail-amt">${{ dataInvoice.subtotal }}</div>
                                </li>
                                <li class="price-detail">
                                    <div class="detail-title">Iva</div>
                                    <div class="detail-amt">${{ dataInvoice.iva }}</div>
                                </li>
                                <li class="price-detail">
                                    <div class="detail-title">Descuento</div>
                                    <div class="detail-amt discount-amt text-success">-$0</div>
                                </li>
<!--                                <li class="price-detail">-->
<!--                                    <div class="detail-title">Estimated Tax</div>-->
<!--                                    <div class="detail-amt">$1.3</div>-->
<!--                                </li>-->
<!--                                <li class="price-detail">-->
<!--                                    <div class="detail-title">EMI Eligibility</div>-->
<!--                                    <a href="javascript:void(0)" class="detail-amt text-primary">Details</a>-->
<!--                                </li>-->
<!--                                <li class="price-detail">-->
<!--                                    <div class="detail-title">Delivery Charges</div>-->
<!--                                    <div class="detail-amt discount-amt text-success">Free</div>-->
<!--                                </li>-->
                            </ul>
                            <hr/>
                            <ul class="list-unstyled mb-3">
                                <li class="price-detail">
                                    <div class="detail-title detail-total">Total</div>
                                    <div class="detail-amt font-weight-bolder">${{ dataInvoice.total }}</div>
                                </li>
                            </ul>
                            <hr>
                            <div  class="text-center">
                                <strong>Paga con el medio de pago que prefieras</strong>
                            </div>


                            <div id="toggler" class="form-group">
                                <div class="row">
                                    <div class="col-6" v-for="platform in methodsPayments" :key="platform.id">
                                        <div class="btn-group btn-group-toggle">
                                            <label @click="selectPaymentPlatform(platform)"
                                                   :class="platform.id === (payment.platform ? payment.platform.id : 0) ? 'active' : ''"
                                                   class="btn btn-outline-secondary rounded m-1 p-1">
                                                <img class="img-thumbnail" :src="'' + platform.image" :alt="platform.name">
                                            </label>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <!--=====================================
		                        PAGOS ATRAVES DE PAYU
                            ======================================-->
                            <payu-payment-component :dataPayu="dataPayu" v-if="payment.platform.id === 4"></payu-payment-component>

                            <!--=====================================
		                        PAGOS ATRAVES DE MERCADO PAGO
                            ======================================-->
                            <div class="p-1 text-center" v-if="payment.platform.id === 3">
                                <img class="text-center" src="/images/payment-platforms/mercado_pago-footer.png" width="250" alt="">
                                <a :href="dataMercadoPago" class="btn btn-primary btn-block btn-next place-order">Paga con Mercado Pago</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Checkout Place Order Right ends -->
            </div>
        </div>

</template>

<script>
export default {
    name: "CardPyamentPurchaseOrder",
    data(){
        return{
            methodsPayments: [],
            paymentSelected: {
                id:null
            },
            payment: {
                value: '',
                currency: '',
                platform: '',
            },
            language: window.lang, //Idioma actual de la aplicación
        }
    },
    props:['dataPayu', 'dataInvoice', 'dataMercadoPago'],
    methods:{
        getTypePayments(){
            axios.get('/api/get-type-payments').then(resp =>{
                this.methodsPayments = resp.data.data
            })
        },
        selectPaymentPlatform( platform ) {
            this.payment.platform = platform;
            this.currentComponent = platform.name + 'Component';
        },
    },
    mounted() {
        this.getTypePayments()
    }
}
</script>

<style scoped>
.active {
    background-color: #4dc76f59 !important
}
</style>
