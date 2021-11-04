<template>
    <div>
        <div class="row pt-2">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <!-- TODO: traduciones con parametros -->
                    <div class="card-header">{{ $t('payment.homePayment.title_card_header_payment', {'name': current_user.name}) }}</div>

                    <div class="body px-3">
                        <div class="row">
                            <div class="col-md-6">
                                <input-form
                                    id="txtValue"
                                    type="money"
                                    :label="$t('payment.homePayment.input_value_payment')"
                                    pattern="all"
                                    :required="true"
                                    :errorMsg="$t('payment.homePayment.input_value_error')"
                                    :requiredMsg="$t('payment.homePayment.input_value_required')"
                                    :modelo.sync="payment.value"
                                    :msgServer.sync="errors.value"
                                    :money="money"/>
                            </div>

                            <div class="col-md-6">
                                <input-form
                                    :label="$t('payment.homePayment.select_badge_payment')"
                                    id="txtDivisa"
                                    errorMsg
                                    :requiredMsg="$t('payment.homePayment.select_badge_required')"
                                    :required="true"
                                    :modelo.sync="payment.currency"
                                    :msgServer.sync="errors.currency"
                                    type="multiselect"
                                    :multiselect="{
                                        options: list_currencies,
                                        selectLabel:this.$t('payment.homePayment.select_label'),
                                        selectedLabel:this.$t('payment.homePayment.selected_label'),
                                        deselectLabel:this.$t('payment.homePayment.deselect_label'),
                                        placeholder:this.$t('payment.homePayment.select_badge_placeholder'),
                                        'track-by':'iso',
                                        label: 'name',
                                        'custom-label': list_currencies => list_currencies.iso
                                    }" />
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-md-12">
                                <label>{{ $t('payment.homePayment.title_platform_payment') }}:</label>

                                <div id="toggler" class="form-group">
                                    <div v-for="platform in list_payment_platforms"
                                        :key="platform.id"
                                        class="btn-group btn-group-toggle">
                                        <label @click="selectPaymentPlatform(platform)"
                                            :class="platform.id === (payment.platform ? payment.platform.id : 0) ? 'active' : ''"
                                            class="btn btn-outline-secondary rounded m-2 p-1">
                                            <img class="img-thumbnail" :src="'' + platform.image" :alt="platform.name">
                                        </label>
                                    </div>
                                </div>

                                <!-- Dynamic component of payment gateway -->
                                <div v-if="payment.platform">
                                    <keep-alive>
                                        <component :is="currentComponent"
                                            :payment="payment"
                                            :current_user="current_user"/>
                                    </keep-alive>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-1 mb-1">
                            <button @click="sendPayment()" id="payButton" class="btn btn-primary btn-lg">{{ $t('payment.homePayment.buttom_payment') }}</button>
                        </div>

                        <div class="row my-2">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <div v-if="showAlert" class="alert alert-payment" :class="{'alert-success':  okPayment, 'alert-danger': !okPayment}" role="alert">
                                    {{ msgAlert }}
                                    <button @click="closeAlert()" type="button" class="close style-bottom-close-alert">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import PayPalComponent from './componentsPayment/PayPalComponent';
    import StripeComponent from './componentsPayment/StripeComponent';
    import MercadoPagoComponent from './componentsPayment/MercadoPagoComponent';
    import PayUComponent from './componentsPayment/PayUComponent';
    import Multiselect from "vue-multiselect";


    export default {
        props: [
            'list_currencies',
            'list_payment_platforms',
            'current_user'
        ],
        components: {
            Multiselect,
            PayPalComponent,
            StripeComponent,
            MercadoPagoComponent,
            PayUComponent
        },
        data() {
            return {
                payment: {
                    value: '',
                    currency: '',
                    platform: '',
                },
                errors: {},
                money: {
                    decimal: ",",
                    thousands: ".",
                    prefix: "$ ",
                    suffix: "",
                    precision: 0
                },
                currentComponent: 'PayPalComponent',
                showAlert: false,
                msgAlert: '',
                okPayment: false,
            }
        },
        methods: {
            selectPaymentPlatform( platform ) {
                this.payment.platform = platform;
                this.currentComponent = platform.name + 'Component';
            },
            closeAlert() {
                this.showAlert = !this.showAlert;
            },

            async sendPayment() {
                // validar campos

                // create object FormData
                let data = new FormData();
                data.append('value', this.payment.value);
                data.append('currency', this.payment.currency.iso);
                data.append('payment_platform', this.payment.platform.id);

                // Metodo de pagos
                await this.getDataPlatform( data )

                // enviar datos
                setTimeout( () => {
                    axios.post('/es/payment/pay', data)
                    .then( response => {
                        console.log('response: ', response);
                        if (response.data.status === 'ok') {
                            this.okPayment = true
                        } else {
                            this.okPayment = false
                        }

                        this.showAlert = true
                        this.msgAlert = response.data.msg
                    })
                    .catch( error => {
                        console.log('error: ', error);
                        this.okPayment = false
                        this.showAlert = true
                        this.msgAlert = this.$t('payment.homePayment.error_serve_payment');
                    });
                }, 500);
            },
            async getDataPlatform( data ) {
                switch( this.payment.platform.name ) {
                    case 'Stripe':
                        let token = await this.getTokenStripe();
                        if ( !token ) return;
                        data.append('payment_method', this.payment.payment_method);
                        break

                    case 'MercadoPago':
                        await this.payment.mercadoPago.getPaymentMethod(
                            { "bin": this.payment.dataCard.numberCard.substring(0, 7) },
                            function( status, response ) {
                                data.append('card_network', response[0].id);
                            }
                        );

                        let dataMP = new FormData();
                        dataMP.append('cardNumber', this.payment.dataCard.numberCard);
                        dataMP.append('securityCode', this.payment.dataCard.cvc);
                        dataMP.append('cardExpirationMonth', this.payment.dataCard.mm);
                        dataMP.append('cardExpirationYear', this.payment.dataCard.yy);
                        dataMP.append('cardholderName', this.payment.dataUser.name);
                        dataMP.append('cardholderEmail', this.payment.dataUser.email);
                        dataMP.append('docType', $('select.custom-select').val());
                        dataMP.append('docNumber', this.payment.dataUser.identification);

                        await this.payment.mercadoPago.createToken( dataMP,
                            function( status, response ) {
                                if ( status != 200 && status != 201 ) {
                                    console.log('errors: ', response.cause)
                                } else {
                                    data.append('card_token', response.id);
                                }
                        });

                        data.append('email', this.payment.dataUser.email);
                        break

                    case 'PayU':
                        if ( !this.payment.payU ) return;
                        data.append('payu_card', this.payment.payU.numberCard);
                        data.append('payu_cvc', this.payment.payU.cvc);
                        data.append('payu_year', this.payment.payU.yy);
                        data.append('payu_month', this.payment.payU.mm);
                        data.append('payu_network', this.payment.payU.typeCard.name);
                        data.append('payu_name', this.payment.payU.name);
                        data.append('payu_email', this.payment.payU.email);
                        break
                }
            },
            async getTokenStripe() {
                const { paymentMethod, error} = await this.payment.stripe.createPaymentMethod(
                    'card', this.payment.card, {
                        billing_details: {
                            "name": this.current_user.name + ' ' + this.current_user.last_name,
                            "email": this.current_user.email
                        }
                    }
                );

                if ( error ) {
                    const displayError = document.getElementById('cardErrors');
                    displayError.textContent = error.message;
                    return false;
                } else {
                    this.payment.payment_method = paymentMethod.id;
                    return true;
                }
            }
        },
        created() { },
        mounted() { }
    }
</script>

<style scoped>
.active {
    background-color: #4dc76f59 !important
}
.alert-payment {
    padding: 1rem;
    margin-bottom: 0;
}
.style-bottom-close-alert {
    color: #f05e7d !important;
    line-height: 0;
    font-size: 3rem;
    padding: 1.5rem 0.8rem;
    margin-top: -0.8rem;
}
</style>
