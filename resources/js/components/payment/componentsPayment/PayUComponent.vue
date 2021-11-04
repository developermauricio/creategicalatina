<template>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <label class="">{{ $t('payment.homePayment.text_card_details') }}</label>
            <hr>

            <div class="form-group form-row">
                <div class="col-4">
                    <input-form
                        :label="$t('payment.homePayment.input_number_card_payment')"
                        id="txtNumberCard"
                        pattern="num"
                        :errorMsg="$t('payment.homePayment.input_number_card_payment_error')"
                        :requiredMsg="$t('payment.homePayment.input_number_card_payment_required')"
                        :required="true"
                        :modelo.sync="dataPayU.numberCard"
                        :msgServer.sync="errors.numberCard"/>
                </div>

                <div class="col-2">
                    <input-form
                        label="CVC"
                        id="txtCVC"
                        pattern="num"
                        :errorMsg="$t('payment.homePayment.input_cvc_payment_error')"
                        :requiredMsg="$t('payment.homePayment.input_cvc_payment_required')"
                        :required="true"
                        :modelo.sync="dataPayU.cvc"
                        :msgServer.sync="errors.cvc"/>
                </div>

                <div class="col-1">
                    <input-form
                        label="MM"
                        id="txtMM"
                        pattern="num"
                        :errorMsg="$t('payment.homePayment.input_mm_payment_error')"
                        :requiredMsg="$t('payment.homePayment.input_mm_payment_required')"
                        :required="true"
                        :modelo.sync="dataPayU.mm"
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
                        :modelo.sync="dataPayU.yy"
                        :msgServer.sync="errors.yy"/>
                </div>

                <div class="col-3">
                    <input-form
                        :label="$t('payment.homePayment.select_card_type_payment')"
                        id="txtTypeCard"
                        errorMsg
                        :requiredMsg="$t('payment.homePayment.select_card_type_required')"
                        :required="true"
                        :modelo.sync="dataPayU.typeCard"
                        :msgServer.sync="errors.typeCard"
                        type="multiselect"
                        :multiselect="{
                            options: listTypeCard,
                            selectLabel: this.$t('payment.homePayment.select_label'),
                            selectedLabel: this.$t('payment.homePayment.selected_label'),
                            deselectLabel: this.$t('payment.homePayment.deselect_label'),
                            placeholder: this.$t('payment.homePayment.select_card_type_placeholder'),
                            'track-by':'id',
                            label: 'name',
                            'custom-label': listTypeCard => listTypeCard.name
                        }" />
                </div>
            </div>

            <label class="mt-1">{{ $t('payment.homePayment.text_data_user') }}</label>
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
                        :modelo.sync="dataPayU.name"
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
                        :modelo.sync="dataPayU.email"
                        :msgServer.sync="errors.email"/>
                </div>
            </div>

            <!-- <div class="form-group form-row">
                <div class="col">
                    <small class="form-text text-mute"  role="alert">Su pago se convertirá a COP</small>
                    <! -- <small class="form-text text-mute"  role="alert">Su pago se convertirá a {{ strtoupper(config('services.payu.base_currency')) }}</small> -- >
                </div>
            </div> -->
        </div>
    </div>
</template>

<script>
    import Multiselect from "vue-multiselect";

    export default {
        name: 'PayUComponent',
        components: {
            Multiselect,
        },
        props: ['payment', "current_user"],
        data() {
            return {
                dataPayU: {
                    numberCard: '',
                    cvc: '',
                    mm: '',
                    yy: '',
                    typeCard: '',
                    name: '',
                    email: ''
                },
                errors: {},
                listTypeCard: [
                    { id: 1, name: 'VISA' },
                    { id: 2, name: 'AMEX' },
                    { id: 3, name: 'DINERS' },
                    { id: 4, name: 'MASTERCARD' }
                ],
            }
        },
        created() {
            this.dataPayU.name = this.current_user.name + ' ' + this.current_user.last_name;
            this.dataPayU.email = this.current_user.email;

            this.payment.payU = this.dataPayU;
        },
        mounted() { }
    }
</script>
