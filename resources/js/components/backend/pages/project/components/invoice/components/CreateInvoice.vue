<template>
    <div>
        <section class="invoice-edit-wrapper">
            <form id="validateCreateInvoice">
                <div class="row invoice-edit">
                    <!-- Invoice Edit Left starts -->
                    <div class="col-xl-9 col-md-8 col-12">
                        <div
                            :class="`card dark-layout-create-invoice ${themeDark === 3 ? `dark-layout-create-invoice`: ''} pop-create-invoice invoice-preview-card`">
                            <!-- Header starts -->
                            <div class="card-body invoice-padding pb-0">
                                <div
                                    class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                    <div>
                                        <div class="logo-wrapper">
                                            <img width="250" :src="logo" alt="">
                                        </div>
                                        <p class="card-text mb-25">Office 149, 450 South Brand Brooklyn</p>
                                        <p class="card-text mb-25">San Diego County, CA 91905, USA</p>
                                        <p class="card-text mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p>
                                    </div>
                                    <div class="invoice-number-date invoice-page-project mt-md-0 mt-2">
                                        <div class="justify-content-md-end mb-1">
                                            <input-form
                                                id="txtInvoiceNumber"
                                                :label="$t('backend.project.billing.titulo_numero_factura')"
                                                pattern="all"
                                                :errorMsg="$t('backend.project.billing.titulo_ingrese_numero_factura_valido')"
                                                :requiredMsg="$t('backend.project.billing.titulo_numero_factura_obligatorio')"
                                                :modelo.sync="invoice_number"
                                                :required="true"
                                                :msgServer.sync="errors.invoice_number"
                                            ></input-form>
                                        </div>
                                        <div class="mb-1">
                                            <input-form
                                                :label="$t('backend.project.billing.titulo_fecha_emision')"
                                                id="txtFechaInicial"
                                                pattern="all"
                                                :errorMsg="$t('backend.project.billing.titulo_ingresa_fecha_valida')"
                                                :requiredMsg="$t('backend.project.billing.titulo_fecha_requerida')"
                                                :required="true"
                                                :modelo.sync="dateInvoiceInitial"
                                                :msgServer.sync="errors.dateInvoiceInitial"
                                                type="date"
                                                :datepicker="{
                                                           'clear-button': false,
                                                          'bootstrap-styling':true,

                                                        }"
                                            ></input-form>
                                        </div>
                                        <div class="">
                                            <!--                                        <span class="title">Fecha de vencimiento:<span class="text-danger">*</span></span>-->
                                            <input-form
                                                :label="$t('backend.project.billing.titulo_fecha_vencimiento')"
                                                id="txtFechaFinal"
                                                pattern="all"
                                                :errorMsg="$t('backend.project.billing.titulo_ingresa_fecha_valida')"
                                                :requiredMsg="$t('backend.project.billing.titulo_fecha_requerida')"
                                                :required="true"
                                                :modelo.sync="dateInvoiceExpiration"
                                                :msgServer.sync="errors.dateInvoiceExpiration"
                                                type="date"
                                                :datepicker="{
                                                           'clear-button': false,
                                                          'bootstrap-styling':true,

                                                        }"
                                            ></input-form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Header ends -->

                            <hr class="invoice-spacing"/>

                            <!-- Address and Contact starts -->
                            <div class="card-body invoice-padding pt-0">
                                <div class="row invoice-spacing">
                                    <div class="col-xl-8 p-0">
                                        <h6 class="mb-2">{{ $t('backend.project.billing.titulo_factura_a') }}</h6>
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td class="pr-1">{{ $t('backend.project.billing.titulo_cliente') }}</td>
                                                <td><strong>{{ customer.user.name }} {{
                                                        customer.user.last_name
                                                    }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="pr-1">{{ $t('backend.project.billing.titulo_ubicacion') }}</td>
                                                <td>{{ customer.user.country.name }}, {{ customer.user.city ? customer.user.city.name : '' }}

                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pr-1">{{ $t('backend.project.billing.titulo_direccion') }}</td>
                                                <td>{{ customer.user.address }}</td>
                                            </tr>
                                            <tr>
                                                <td class="pr-1">{{ $t('backend.project.billing.titulo_telefono') }}</td>
                                                <td>{{ customer.user.phone }}</td>
                                            </tr>
                                            <tr>
                                                <td class="pr-1">{{ $t('backend.project.billing.titulo_correo') }}</td>
                                                <td>{{ customer.user.email }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
<!--                                    <div class="col-xl-4 p-0 mt-xl-0 mt-2">-->
<!--                                        <h6 class="mb-2">Payment Details:</h6>-->
<!--                                        <table>-->
<!--                                            <tbody>-->
<!--                                            <tr>-->
<!--                                                <td class="pr-1">Total Due:</td>-->
<!--                                                <td><strong>$12,110.55</strong></td>-->
<!--                                            </tr>-->
<!--                                            <tr>-->
<!--                                                <td class="pr-1">Bank name:</td>-->
<!--                                                <td>American Bank</td>-->
<!--                                            </tr>-->
<!--                                            <tr>-->
<!--                                                <td class="pr-1">Country:</td>-->
<!--                                                <td>United States</td>-->
<!--                                            </tr>-->
<!--                                            <tr>-->
<!--                                                <td class="pr-1">IBAN:</td>-->
<!--                                                <td>ETD95476213874685</td>-->
<!--                                            </tr>-->
<!--                                            <tr>-->
<!--                                                <td class="pr-1">SWIFT code:</td>-->
<!--                                                <td>BR91905</td>-->
<!--                                            </tr>-->
<!--                                            </tbody>-->
<!--                                        </table>-->
<!--                                    </div>-->
                                </div>
                            </div>
                            <!-- Address and Contact ends -->

                            <!--=====================================
                                SECCIÓN ITEMS
                            ======================================-->
                            <div class="card-body invoice-padding invoice-product-details">
                                <div data-repeater-list="group-a">
                                    <div class="repeater-wrapper" data-repeater-item>
                                        <div class="row">
                                            <div class="col-12 product-details-border position-relative pr-0">
                                                <vue-repeater v-model="fields"></vue-repeater>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!--=====================================
                                SECCIÓN PREFOOTER FACTURA
                            ======================================-->
                            <div class="card-body invoice-padding">
                                <div class="row invoice-sales-total-wrapper">
                                    <div class="col-md-5 order-md-1 order-2 mt-md-0 mt-3">
                                        <div class="d-flex align-items-center mb-1">
                                            <label for="salesperson" class="form-label">{{ $t('backend.project.billing.titulo_factura_hecha_por') }}</label>
                                            <input type="text" v-model="userMadeBy" disabled class="form-control ml-50"
                                                   id="salesperson"
                                                   :placeholder="userMadeBy"/>
                                        </div>
                                    </div>
                                    <div class="col-md-7 d-flex justify-content-end order-md-2 order-1">
                                        <div class="invoice-total-wrapper">
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title">{{ $t('backend.project.billing.titulo_subtotal') }}</p>
                                                <p class="invoice-total-amount">{{ subTotal | currency }}</p>
                                            </div>
                                            <!--                                    <div class="invoice-total-item">-->
                                            <!--                                        <p class="invoice-total-title">Discount:</p>-->
                                            <!--                                        <p class="invoice-total-amount">$28</p>-->
                                            <!--                                    </div>-->
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title">{{ $t('backend.project.billing.titulo_iva') }}</p>
                                                <p class="invoice-total-amount">19%</p>
                                            </div>
                                            <hr class="my-50"/>
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title">{{ $t('backend.project.billing.titulo_total') }}</p>
                                                <p class="invoice-total-amount">{{ totalPriceInvoice | currency }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <hr class="invoice-spacing mt-0"/>

                            <!--=====================================
                               IMPUT DE OBSERVACIONES
                            ======================================-->
                            <div class="card-body invoice-padding py-0">
                                <div class="row">
                                    <div class="col-12">
                                        <input-form
                                            type="textarea"
                                            :label="$t('backend.project.billing.titulo_observaciones')"
                                            id="txtCommentsInvoice"
                                            pattern="all"
                                            :errorMsg="$t('backend.project.billing.titulo_ingrese_texto_valido')"
                                            :requiredMsg="$t('backend.project.billing.titulo_comentarios_requeridos')"
                                            :required="false"
                                            :modelo.sync="observations"
                                            :msgServer.sync="errors.observations"
                                            :options="{
                                                rows: 5
                                                }"
                                        >
                                        </input-form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--=====================================
                        SECCIÓN BOTONES CANCELAR Y GUARDAR
                    ======================================-->
                    <div class="col-xl-3 col-md-4 col-12 d-sm-none d-md-block d-lg-block d-xl-block">
                        <div class="card position-fixed" style="width: 40vh;">
                            <div class="card-body">
                                <vs-tooltip
                                    :text="$t('backend.project.billing.texto_tooltip_cancelar')">
                                    <button @click="closeModal()" class="btn btn-primary btn-block mb-75" type="button">
                                        {{ $t('backend.project.billing.titulo_ingrese_cancelar') }}
                                    </button>
                                </vs-tooltip>
                                <vs-tooltip :text="$t('backend.project.billing.texto_tooltip_guardar')">
                                    <button @click="createInvoice()" type="button"
                                            class="btn btn-success btn-block mb-75">
                                        {{ $t('backend.project.billing.titulo_guardar') }}
                                    </button>
                                </vs-tooltip>
                                <vs-tooltip :text="$t('backend.project.billing.texto_tooltip_guardar_enviar_correo')">
                                    <button @click="createInvoice(1)" type="button"
                                            class="btn btn-success btn-block mb-75">
                                        {{ $t('backend.project.billing.titulo_guardar_enviar_cliente') }}
                                    </button>
                                </vs-tooltip>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-sm-block d-lg-none d-md-none d-xl-none">
                        <div class="card">
                            <div class="card-body">
                                <vs-tooltip
                                    :text="$t('backend.project.billing.texto_tooltip_cancelar')">
                                    <button @click="closeModal()" class="btn btn-primary btn-block mb-75" type="button">
                                        {{ $t('backend.project.billing.titulo_ingrese_cancelar') }}
                                    </button>
                                </vs-tooltip>
                                <vs-tooltip :text="$t('backend.project.billing.texto_tooltip_guardar')">
                                    <button @click="createInvoice()" type="button"
                                            class="btn btn-success btn-block mb-75">
                                        {{ $t('backend.project.billing.titulo_guardar') }}
                                    </button>
                                </vs-tooltip>
                                <vs-tooltip :text="$t('backend.project.billing.texto_tooltip_guardar_enviar_correo')">
                                    <button @click="createInvoice()" type="button"
                                            class="btn btn-success btn-block mb-75">
                                        {{ $t('backend.project.billing.titulo_guardar_enviar_cliente') }}
                                    </button>
                                </vs-tooltip>
                            </div>
                        </div>
                    </div>
                    <!-- Invoice Edit Right ends -->
                </div>
            </form>
        </section>
    </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import {en, es} from 'vuejs-datepicker/dist/locale'
import moment from 'moment';
import VueRepeater from 'vue-repeater'
import 'vue-repeater/dist/lib/vue-repeater.css'
import Swal from "sweetalert2";

export default {
    name: "CreateInvoice",
    components: {
        Datepicker,
        VueRepeater,
        moment
    },
    data() {
        return {
            fields: [
                {
                    name: 'items-invoice',
                    value: {}
                }
            ],
            themeDark: null,
            invoice_number: null,
            observations: '',
            subTotal: 0,
            dateInvoiceInitial: null,
            dateInvoiceExpiration: null,
            userMadeBy: window.userAuth,
            errors: {},
            customer: this.projectInfo.customer[0],
            en: en,
            es: es,
        }
    },
    methods: {
        closeModal() {

            Swal.fire({
                title: this.$t('backend.project.billing.swal_alert_confirmar'),
                text: this.$t('backend.project.billing.swal_alert_seguro_cancelar'),
                confirmButtonColor: "#F05E7D",
                cancelButtonColor: "#79ebdf",
                confirmButtonText: this.$t('backend.project.billing.swal_alert_aceptar'),
                cancelButtonText: this.$t('backend.project.billing.swal_alert_cancelar'),
                customClass: "swal-confirmation",
                showCancelButton: true,
                reverseButtons: true,
                allowOutsideClick: false,
            }).then((result) => {
                if (result.value) {
                    this.dateInvoiceInitial = null;
                    this.dateInvoiceExpiration = null;
                    this.fields = []
                    this.invoice_number = null
                    this.observations = ''
                    this.$emit("closeModalCreateInvoice")
                }
            })
        },
        createInvoice(email) {
            let sendEmail;
            if (email){
                sendEmail = email
            }else{
                sendEmail = 2
            }

            eventBus.$emit("validarFormulario");
            setTimeout(() => {
                let resp = this;
                /***  VALIDANDO LOS ERRORES Y MOSTRANDO UNA ALERTA  ***/
                if (document.querySelectorAll("#validateCreateInvoice .is-invalid").length > 0) {
                    this.$toast.error({
                        title: 'Error',
                        message: this.$t('backend.project.billing.toast_alert_todos_campos_llenos'),
                        showDuration: 2000,
                        hideDuration: 9000,
                        position: 'top right',
                    })
                    return;
                }
                const data = new FormData()
                data.append('code', this.invoice_number);
                data.append('subtotal', this.subTotal);
                data.append('total', this.totalPriceInvoice);
                data.append('date_issue', moment(this.dateInvoiceInitial).format("YYYY-MM-DD HH:mm:ss"));
                data.append('date_expiration', moment(this.dateInvoiceExpiration).format("YYYY-MM-DD HH:mm:ss"));
                data.append('items', JSON.stringify(this.fields));
                data.append('observation', this.observations);
                data.append('sendEmail', sendEmail);
                data.append('project', JSON.stringify(this.projectInfo));
                data.append('customer', JSON.stringify(this.projectInfo.customer[0]));
                data.append('company', JSON.stringify(this.projectInfo.company[0]));

                Swal.fire({
                    title: this.$t('backend.project.billing.swal_alert_confirmar'),
                    text: this.$t('backend.project.billing.swal_alert_seguro_realizar_registro'),
                    confirmButtonColor: "#F05E7D",
                    cancelButtonColor: "#79ebdf",
                    confirmButtonText: this.$t('backend.project.billing.swal_alert_aceptar'),
                    cancelButtonText: this.$t('backend.project.billing.swal_alert_cancelar'),
                    customClass: "swal-confirmation",
                    showCancelButton: true,
                    reverseButtons: true,
                    allowOutsideClick: false,
                }).then((result) => {
                    if (result.value) {
                        this.$vs.loading({
                            color: '#3f4f6e',
                            text: this.$t('backend.project.billing.modal_registrando_factura')
                        })

                        axios.post('/api/register/store-invoice', data).then(res => {
                            this.$toast.success({
                                title:  this.$t('backend.project.billing.toast_alert_muy_bien'),
                                message: this.$t('backend.project.billing.toast_alert_factura_creada_correctamente'),
                                showDuration: 1000,
                                hideDuration: 8000,
                                position: 'top right',
                            })
                            this.dateInvoiceInitial = null;
                            this.dateInvoiceExpiration = null;
                            resp.fields = []
                            this.invoice_number = null
                            this.observations = ''
                            this.$emit("createInvoice")
                            // window.location = "/facturas";
                        }).catch(err => {
                            console.log('mostrando el error', err)
                            this.$toast.error({
                                title: this.$t('backend.project.billing.toast_alert_algo_salio_mal'),
                                message: this.$t('backend.project.billing.toast_alert_comunicate_administrador'),
                                showDuration: 1000,
                                hideDuration: 8000,
                            })
                        });
                        setTimeout(() => {
                            this.$vs.loading.close()
                        }, 2000)
                    }
                })

            }, 200);
        }
    },
    computed: {
        totalPriceInvoice: {
            get() {
                let price = 0
                let quantity = 1
                this.fields.forEach(value => {
                    if (value.value.quantity > 1) {
                        quantity = value.value.quantity
                    }
                    price += value.value.price * quantity
                });
                this.subTotal = price
                if (price !== 0) {
                    let iva = price * 0.19
                    price += iva
                }
                return price
            }
        }
    },
    props: ['projectInfo', 'logo'],

    created() {
        if (this.themeDark === '3' || this.themeDark === '1') {
            $('.vs-popup').addClass('dark-layout');
            // $('.row-item-invoice').addClass('dark-layout-create-invoice');
        } else {
            $('.pop-create-invoice').removeClass('dark-layout-create-invoice');
            // $('.row-item-invoice').removeClass('dark-layout-create-invoice');
        }
    },

    mounted() {
        let themeDarkLocal = localStorage.getItem('theme')
        this.themeDark = window.themeSession
        console.log(this.themeDark)
        if (this.themeDark === '3' || this.themeDark === '1' || themeDarkLocal === '3' || themeDarkLocal === '1') {
            $('.vs-popup').addClass('dark-layout');
            $('.row-item-invoice').addClass('dark-layout-create-invoice');
            // this.logo = window.logoGreen
            // window.matchMedia('(prefers-color-scheme: dark)')
            //     .addEventListener('change', event => {
            //         console.log('dark', window.logoGreen)
            //         if (event.matches === true) {
            //             this.logo = window.logoGreen // LOGO VERDE FOSFORECENTE
            //         }
            //     })
        } else {
            $('.pop-create-invoice').removeClass('dark-layout-create-invoice');
            $('.row-item-invoice').removeClass('dark-layout-create-invoice');
            // this.logo = window.logo_ligth
            // window.matchMedia('(prefers-color-scheme: dark)')
            //     .addEventListener('change', event => {
            //         console.log('light', window.logo_ligth)
            //         if (event.matches === false) {
            //             this.logo = window.logo_ligth // LOGO AZUL TURQUI
            //         }
            //     })
        }

        window.matchMedia('(prefers-color-scheme: dark)')
            .addEventListener('change', event => {
                let themeDarkLocalChange = localStorage.getItem('theme')
                if (event.matches === true && (themeDarkLocalChange === '3' || themeDarkLocalChange === '1')) {
                    $('.pop-create-invoice').addClass('dark-layout-create-invoice');
                    $('.row-item-invoice').addClass('dark-layout-create-invoice');
                    this.logo = window.logoGreen // LOGO VERDE FOSFORECENTE
                } else {
                    this.logo = window.logo_ligth // LOGO AZUL TURQUI
                    $('.pop-create-invoice').removeClass('dark-layout-create-invoice');
                    $('.row-item-invoice').removeClass('dark-layout-create-invoice');

                }
            })

    }
}
</script>

<style scoped>

</style>
