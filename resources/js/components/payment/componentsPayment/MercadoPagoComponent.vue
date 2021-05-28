<template>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <label class="">{{ $t('payment.homePayment.text_card_details') }}</label>
            <hr>

            <div class="form-group form-row">
                <div class="col-5">
                    <input-form
                        :label="$t('payment.homePayment.input_number_card_payment')"
                        id="txtCardNumber"
                        pattern="num"
                        data-checkout="cardNumber"
                        :errorMsg="$t('payment.homePayment.input_number_card_payment_error')"
                        :requiredMsg="$t('payment.homePayment.input_number_card_payment_required')"
                        :required="true"
                        :modelo.sync="dataCard.numberCard"
                        :msgServer.sync="errors.numberCard"/>
                </div>

                <div class="col-2">
                    <input-form
                        label="CVC"
                        id="txtCVC"
                        pattern="num"
                        data-checkout="securityCode"
                        :errorMsg="$t('payment.homePayment.input_cvc_payment_error')"
                        :requiredMsg="$t('payment.homePayment.input_cvc_payment_required')"
                        :required="true"
                        :modelo.sync="dataCard.cvc"
                        :msgServer.sync="errors.cvc"/>
                </div>

                <div class="col-2"></div>

                <div class="col-1">
                    <input-form
                        label="MM"
                        id="txtMM"
                        pattern="num"
                        data-checkout="cardExpirationMonth"
                        :errorMsg="$t('payment.homePayment.input_mm_payment_error')"
                        :requiredMsg="$t('payment.homePayment.input_mm_payment_required')"
                        :required="true"
                        :modelo.sync="dataCard.mm"
                        :msgServer.sync="errors.mm"/>
                </div>

                <div class="col-2">
                    <input-form
                        label="YYYY"
                        id="txtYY"
                        pattern="num"
                        :errorMsg="$t('payment.homePayment.input_yy_payment_error')"
                        :requiredMsg="$t('payment.homePayment.input_yy_payment_required')"
                        :required="true"
                        :modelo.sync="dataCard.yy"
                        :msgServer.sync="errors.yy"/>
                </div>
            </div>

            <label class="mt-2">{{ $t('payment.homePayment.text_data_user') }}</label>
            <hr>

            <div class="form-group form-row">
                <div class="col-6">
                    <input-form
                        :label="$t('payment.homePayment.input_name_payment')"
                        id="txtName"
                        pattern="all"
                        :errorMsg="$t('payment.homePayment.input_name_payment_error')"
                        :requiredMsg="$t('payment.homePayment.input_name_payment_required')"
                        :required="true"
                        :modelo.sync="dataUser.name"
                        :msgServer.sync="errors.name"/>
                </div>
                <div class="col-6">
                    <input-form
                        :label="$t('payment.homePayment.input_email_payment')"
                        id="txtEmail"
                        pattern="email"
                        :errorMsg="$t('payment.homePayment.input_email_payment_error')"
                        :requiredMsg="$t('payment.homePayment.input_email_payment_required')"
                        :required="true"
                        :modelo.sync="dataUser.email"
                        :msgServer.sync="errors.email"/>
                </div>
            </div>

            <div class="form-group form-row">
                <div class="col-3">
                    <label for="txtdocType" class="form-control-label">
                        <span>{{ $t('payment.homePayment.text_data_user_select') }}</span> <span class="text-danger">*</span>
                    </label>
                    <select class="custom-select" data-checkout="docType"></select>
                </div>
                <div class="col-3">
                    <input-form
                        :label="$t('payment.homePayment.input_identification_mercado_pago')"
                        id="txtIdentification"
                        pattern="all"
                        :errorMsg="$t('payment.homePayment.input_identification_mercado_pago')"
                        :requiredMsg="$t('payment.homePayment.input_identification_mercado_pago')"
                        :required="true"
                        :modelo.sync="dataUser.identification"
                        :msgServer.sync="errors.identification"/>
                </div>
            </div>

            <!-- <div class="form-group form-row">
                <div class="col">
                    <small class="form-text text-mute"  role="alert" >Su pago se convertirá a COP</small>
                    <! -- <small class="form-text text-mute"  role="alert" >Su pago se convertirá a {{ strtoupper(config('services.mercadopago.base_currency')) }}</small> -- >
                </div>
            </div> -->

            <div class="form-group form-row">
                <div class="col">
                    <small class="form-text text-danger" id="paymentErrors" role="alert"></small>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'MercadoPagoComponent',
        props: ['payment', "current_user"],
        data() {
            return {
                dataCard: {
                    numberCard: '',
                    cvc: '',
                    mm: '',
                    yy: ''
                },
                dataUser: {
                    name: '',
                    email: '',
                    typeIdentification: '',
                    identification: ''
                },
                errors: {},
            }
        },
        created() {
            this.dataUser.name = this.current_user.name + ' ' + this.current_user.last_name
            this.dataUser.email = this.current_user.email
            this.dataUser.identification = this.current_user.identification

            this.payment.dataCard = this.dataCard
            this.payment.dataUser = this.dataUser
        },
        mounted() {
            const mercadoPago = window.Mercadopago;
            mercadoPago.setPublishableKey('TEST-dbaa0586-4310-4f4a-afc7-b2e5670d2220');

            mercadoPago.getIdentificationTypes();
            this.payment.mercadoPago = mercadoPago;
        }
    }
</script>
