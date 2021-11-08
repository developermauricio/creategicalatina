<template>
    <div>
        <input type="hidden" @click="getDataPurchase" id="inputGetDataPurchaseOrder"/>
        <vs-popup @update:active="closeModalShowPurchaseOrder" fullscreen class="showModalPurchaseOrder"
                  title="Historial de Seguimiento" :active.sync="popupActivoShowPurchase">
            <section class="invoice-preview-wrapper">
                <vs-tabs color="#F05E7D">
                    <vs-tab label="Información">
                        <div class="con-tab-ejemplo">
                            <div class="row invoice-preview pt-2 pl-2 pr-2" v-if="loadtData">
                    <div class="col-12 canvas_div_pdf">
                        <div class="card purchase-order-preview">
                            <div class="card-body invoice-padding pb-0 ">
                                <!-- Header starts -->
                                <div
                                    class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                    <div>
                                        <div class="logo-wrapper">
                                            <img :src="logo" width="300"
                                                 alt="">
                                        </div>
                                        <p class="card-text mb-25">Office 149, 450 South Brand Brooklyn</p>
                                        <p class="card-text mb-25">San Diego County, CA 91905, USA</p>
                                        <p class="card-text mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p>
                                    </div>
                                    <div class="mt-md-0 mt-2">
                                        <h4 class="invoice-title">
                                            Orden de Pago
                                            <span class="invoice-number">#{{ code }}</span>
                                        </h4>
                                        <div class="invoice-date-wrapper">
                                            <p class="invoice-date-title">Fecha de Emisión:</p>
                                            <p class="invoice-date"
                                               style="text-transform: capitalize;">{{ moment(dateRegister).locale(language).format("dddd, Do MMMM YYYY") }}</p>
                                        </div>
                                        <div class="invoice-date-wrapper">
                                            <p class="invoice-date-title">Fecha de Vencimiento:</p>
                                            <p class="invoice-date"
                                               style="text-transform: capitalize;">
                                                {{ moment(dateExpiration).locale(language).format("dddd, Do MMMM YYYY") }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Header ends -->
                            </div>

                            <hr class="invoice-spacing"/>

                            <!-- Address and Contact starts -->
                            <div class="card-body invoice-padding pt-0">
                                <div class="row invoice-spacing">
                                    <div class="col-xl-7 p-0">
                                        <h6 class="mb-2">Orden de Pago a:</h6>

                                        <table v-if="company.name === null && customer">
                                            <tbody>
                                            <tr>
                                                <td class="pr-1">Cliente:</td>
                                                <td><span
                                                    class="font-weight-bold">{{ customer.name }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pr-1">Ubicación:</td>
                                                <td>{{
                                                        customer.country
                                                    }}{{ customer.city ? ', ' + customer.city : '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pr-1">Dirección:</td>
                                                <td>{{ customer.address }}</td>
                                            </tr>
                                            <tr>
                                                <td class="pr-1">Teléfono:</td>
                                                <td>{{ customer.phone }}</td>
                                            </tr>
                                            <tr>
                                                <td class="pr-1">Correo electrónico:</td>
                                                <td>{{ customer.email }}</td>
                                            </tr>
                                            </tbody>
                                        </table>

                                        <table v-if="company.name">
                                            <tbody>
                                            <tr>
                                                <td class="pr-1">Cliente:</td>
                                                <td><span
                                                    class="font-weight-bold">{{ company.name }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pr-1">Ubicación:</td>
                                                <td>{{ company.country }}{{ company.city ? ', '+company.city : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="pr-1">Dirección:</td>
                                                <td>{{ company.address }}</td>
                                            </tr>
                                            <tr>
                                                <td class="pr-1">Teléfono:</td>
                                                <td>{{ company.phone }}</td>
                                            </tr>
                                            <tr>
                                                <td class="pr-1">Correo electrónico:</td>
                                                <td>{{ company.email }}</td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>

                                    <div class="col-xl-5 p-0 mt-xl-0 mt-2">
                                        <h6 class="mb-2">Proyecto:</h6>
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td class="pr-1">Nombre:</td>
                                                <td><span
                                                    class="font-weight-bold">{{ project.name }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pr-1">Área:</td>
                                                <td>{{ project.workArea }}</td>
                                            </tr>
                                            <tr>
                                                <td class="pr-1">Categoría:</td>
                                                <td class="mr-1">
                                                    {{ project.category.map((val)=>{
                                                    return val.name[language]
                                                }).join(', ') }}</td>

                                            </tr>
                                            <tr>
                                                <td class="pr-1">Fecha de Registro:</td>
                                                <td>{{ moment( project.dateRegister ).locale(language).format("dddd, Do MMMM YYYY") }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Address and Contact ends -->

                            <!-- Invoice Description starts -->

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="py-1">Item</th>
                                        <th class="py-1">Costo</th>
                                        <th class="py-1">Cantidad</th>
                                        <th class="py-1">Total</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr v-for="purchase in purchaseItems" :key="purchase.id">
                                        <td class="py-1">
                                            <p class="card-text font-weight-bold mb-25">{{ purchase.item }}</p>
                                        </td>
                                        <td class="py-1">
                                            <span class="font-weight-bold">
                                              {{ purchase.price | currency }}
                                              <br>
                                              <currency-display :value="purchase.price"></currency-display>
                                            </span>
                                        </td>
                                        <td class="py-1">
                                            <span class="font-weight-bold">{{ purchase.quantity }}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="font-weight-bold">
                                              {{ purchase.value_final | currency}}
                                              <br>
                                              <currency-display :value="purchase.value_final"></currency-display>
                                            </span>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>

                            <div class="card-body invoice-padding pb-0">
                                <div class="row invoice-sales-total-wrapper">
                                    <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                        <hr>
                                        <p class="card-text mb-0">
                                            <span class="font-weight-bold">Hecha por:</span> <span
                                            class="ml-75">{{ user.name }} {{ user.lastName }}</span>
                                        </p>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                                        <div class="invoice-total-wrapper">
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title pr-1">Subtotal:</p>
                                                <p class="invoice-total-amount font-weight-bold">
                                                  {{ subtotal | currency }}
                                                  <br>
                                                  <currency-display :value="subtotal"></currency-display>
                                                </p>
                                            </div>
<!--                                            <div class="invoice-total-item">-->
<!--                                                <p class="invoice-total-title">Discount:</p>-->
<!--                                                <p class="invoice-total-amount">$28</p>-->
<!--                                            </div>-->
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title">Iva:</p>
                                                <p class="invoice-total-amount font-weight-bold">19%</p>
                                            </div>
                                            <hr class="my-50"/>
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title">Total:</p>
                                                <p class="invoice-total-amount font-weight-bold">
                                                  {{ total | currency }}
                                                  <br>
                                                  <currency-display :value="total"></currency-display>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Invoice Description ends -->

                            <hr class="invoice-spacing"/>

                            <!-- Invoice Note starts -->
                            <div class="card-body invoice-padding pt-0">
                                <div class="row checkout-options">
                                    <div class="col-12 text-justify">
                                        <span class="font-weight-bold">Observaciones:</span>

                                        <span class="text-justify">{{ note ? note : 'No hay observaciones' }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Invoice Note ends -->
                        </div>
                    </div>
                </div>
                        </div>
                    </vs-tab>
                    <vs-tab label="Historial">
                        <div class="con-tab-ejemplo">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card purchase-order-preview card-user-timeline">
                                        <div class="card-header">
                                            <div class="d-flex align-items-center">
                                                <i data-feather="list" class="user-timeline-title-icon"></i>
                                                <h4 class="card-title">Historial Seguimiento Orden de Compra #{{code}}</h4>
                                            </div>
                                            <i data-feather="more-vertical" class="font-medium-3 cursor-pointer"></i>
                                        </div>
                                        <div class="card-body">
                                            <ul class="timeline ml-50">
                                                <li class="timeline-item" v-for="history in historial" :key="history.id">
                                                    <span :class="`timeline-point timeline-point-indicator timeline-point-${history.class_color}`"></span>
                                                    <div class="timeline-event">
                                                        <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                                            <h6>{{ history.title}}</h6>
                                                            <span class="timeline-event-time mr-1">{{ moment.duration(dateNow.diff(history.created_at)).locale(language).humanize(true) }}</span>
<!--                                                            <span class="timeline-event-time mr-1">{{ moment(history.created_at).locale(language).fromNow() }}</span>-->
<!--                                                            <span class="timeline-event-time mr-1">-->
<!--                                                                {{ moment(history.created_at).locale(language).add(moment.duration({-->
<!--                                                                seconds: -2,-->
<!--                                                                minutes: -2,-->
<!--                                                                hours: -2,-->
<!--                                                                days: -2,-->
<!--                                                                weeks: -2,-->
<!--                                                                months: '-2',-->
<!--                                                                years: '-2'-->
<!--                                                            }).humanize(true)) }}-->
<!--                                                            </span>-->
                                                        </div>
                                                        <p>{{ history.description }}</p>
                                                    </div>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </vs-tab>
                </vs-tabs>
            </section>
        </vs-popup>
    </div>
</template>

<script>
require("moment/min/locales.min");
import moment from 'moment';

export default {
    name: "ShowPurchaseOrder",
    data() {
        return {
            moment: moment,
            popupActivoShowPurchase: false,
            logo: null,
            theme: null,
            loadtData: false,
            idPurchase: null,
            language: window.lang,
            dateNow: moment(new Date()),

            customer: {
                name: null,
                email: null,
                country: null,
                city: null,
                address: null,
                phone: null,
            },
            company: {
                name: null,
                email: null,
                address: null,
                phone: null,
                country: null,
                city: null
            },

            project: {
              name: null,
              workArea: null,
              dateRegister: null,
              category:null,
            },

            user:{
                name: null,
                lastName: null
            },
            historial: [],
            dateRegister: null,
            dateExpiration: null,
            purchaseItems: [],
            code: null,
            note: null,
            subtotal:null,
            total: null,
        }
    },
    methods: {
        getDataPurchase(e) {
            e.preventDefault();
            localStorage.getItem('theme')
            this.theme = localStorage.getItem('theme')
            if (this.theme === '3' || this.theme === '1') {
                this.logo = window.logoGreen
            } else {
                this.logo = window.logo_ligth
            }

            this.idPurchase = e.target.value;

            this.$vs.loading({
                color: '#3f4f6e',
                text: 'Espere un momento por favor...'
            })

            setTimeout(() => {
                axios.get('/api/get-data-purchase-order/' + this.idPurchase).then(resp => {
                    console.log(resp.data.data)

                    this.popupActivoShowPurchase = true

                    this.dateRegister = resp.data.data.created_at
                    this.dateExpiration = resp.data.data.expiration
                    this.code = resp.data.data.code

                    this.customer.name = resp.data.data.customer.user.name
                    this.customer.address = resp.data.data.customer.user.address
                    this.customer.email = resp.data.data.customer.user.email
                    this.customer.phone = resp.data.data.customer.user.phone
                    this.customer.country = resp.data.data.customer.user.country.name
                    this.customer.city = resp.data.data.customer.user.city ? resp.data.data.customer.user.city.name : null
                    if (resp.data.data.company) {
                        this.company.name = resp.data.data.company.name
                        this.company.address = resp.data.data.company.address
                        this.company.email = resp.data.data.company.email
                        this.company.phone = resp.data.data.company.phone
                        this.company.country = resp.data.data.company.country.name

                        this.company.city = resp.data.data.company.city ? resp.data.data.company.city.name : null
                    }

                    this.project.name = resp.data.data.project.name
                    this.project.dateRegister = resp.data.data.project.created_at
                    this.project.category = resp.data.data.project.project_categories
                    this.project.workArea = resp.data.data.project.type_project.name[this.language]
                    this.purchaseItems = resp.data.data.purchase_items
                    this.note = resp.data.data.note
                    this.user.name = resp.data.data.user.name
                    this.user.lastName = resp.data.data.user.lastName
                    this.subtotal = resp.data.data.subtotal
                    this.total = resp.data.data.total
                    this.historial = resp.data.data.history

                    this.loadtData = true
                })
                this.$vs.loading.close()
            }, 500)
        },
        closeModalShowPurchaseOrder() {
            this.loadtData = false
            this.popupActivoShowPurchase = false

            this.company.name = null;
            this.company.address = null;
            this.company.phone = null;
            this.company.email = null;
            this.company.country = null;
            this.company.city = null;

            this.customer.name = null
            this.customer.address = null
            this.customer.email = null
            this.customer.phone = null
            this.customer.country = null
            this.customer.city = null

            this.dateRegister = null
            this.dateExpiration = null
            this.code = null

            this.project.name = null
            this.project.workArea = null
            this.project.dateRegister = null
            this.project.category = null

            this.purchaseItems = null
            this.note = null
            this.user.name = null
            this.user.lastName = null
        }
    },
    mounted() {
        this.theme = localStorage.getItem('theme')
        this.theme = localStorage.getItem('theme')
        if (this.theme === '3' || this.theme === '1') {
            this.logo = window.logoGreen
        } else {
            this.logo = window.logo_ligth
        }
        window.matchMedia('(prefers-color-scheme: dark)')
            .addEventListener('change', event => {

                if (event.matches === true && (this.theme === '3' || this.theme === '1')) {
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
.showModalPurchaseOrder >>> .vs-popup {
    max-width: 1040px !important;
    height: auto;
}
.invoice-preview .invoice-total-wrapper .invoice-total-item, .invoice-edit .invoice-total-wrapper .invoice-total-item, .invoice-add .invoice-total-wrapper .invoice-total-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.purchase-order-preview{
    box-shadow: 0 0px 0px 0 rgb(34 41 47 / 10%) !important;
}

</style>
