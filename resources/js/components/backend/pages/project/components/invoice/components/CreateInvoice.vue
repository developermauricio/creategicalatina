<template>
    <div>
        <section class="invoice-edit-wrapper">
            <div class="row invoice-edit">
                <!-- Invoice Edit Left starts -->
                <div class="col-xl-9 col-md-8 col-12">
                    <div class="card invoice-preview-card">
                        <!-- Header starts -->
                        <div class="card-body invoice-padding pb-0">
                            <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                <div>
                                    <div class="logo-wrapper">
                                        <img width="250" :src="logo" alt="">
                                    </div>
                                    <p class="card-text mb-25">Office 149, 450 South Brand Brooklyn</p>
                                    <p class="card-text mb-25">San Diego County, CA 91905, USA</p>
                                    <p class="card-text mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p>
                                </div>
                                <div class="invoice-number-date invoice-page-project mt-md-0 mt-2">
                                    <div class="d-flex align-items-center justify-content-md-end mb-1">
                                        <h4 class="invoice-title">Invoice</h4>
                                        <div class="input-group input-group-merge invoice-edit-input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i data-feather="hash"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control invoice-edit-input"
                                                   placeholder="53634"/>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-1">
                                        <span class="title">Fecha:<span class="text-danger">*</span></span>
                                        <input-form
                                            label=""
                                            id="txtFechaInicial"
                                            pattern="all"
                                            errorMsg="Ingresar una fecha válida"
                                            requiredMsg="La fecha es requerida"
                                            :required="false"
                                            :modelo.sync="dateInvoiceInitial"
                                            :msgServer.sync="errors.dateInvoiceInitial"
                                            type="date"
                                            :datepicker="{
                                                           'clear-button': false,
                                                          'bootstrap-styling':true,

                                                        }"
                                        ></input-form>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="title">Vence:<span class="text-danger">*</span></span>
                                        <input-form
                                            label=""
                                            id="txtFechaFinal"
                                            pattern="all"
                                            errorMsg="Ingresar una fecha válida"
                                            requiredMsg="La fecha es requerida"
                                            :required="false"
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
                                    <h6 class="mb-2">Factura a:</h6>
                                    <h6 class="mb-25">{{ customer.user.name }} {{ customer.user.last_name }}</h6>
                                    <!--                                <p class="card-text mb-25">Aqui va la empresa</p>-->
                                    <p class="card-text mb-25">
                                        {{ customer.user.city ? customer.user.city.name + ',' : '' }}
                                        {{ customer.user.country.name }}</p>
                                    <p class="card-text mb-25">{{ customer.user.phone }}</p>
                                    <p class="card-text mb-0">{{ customer.user.email }}</p>
                                </div>
                                <!--                            <div class="col-xl-4 p-0 mt-xl-0 mt-2">-->
                                <!--                                <h6 class="mb-2">Payment Details:</h6>-->
                                <!--                                <table>-->
                                <!--                                    <tbody>-->
                                <!--                                    <tr>-->
                                <!--                                        <td class="pr-1">Total Due:</td>-->
                                <!--                                        <td><strong>$12,110.55</strong></td>-->
                                <!--                                    </tr>-->
                                <!--                                    <tr>-->
                                <!--                                        <td class="pr-1">Bank name:</td>-->
                                <!--                                        <td>American Bank</td>-->
                                <!--                                    </tr>-->
                                <!--                                    <tr>-->
                                <!--                                        <td class="pr-1">Country:</td>-->
                                <!--                                        <td>United States</td>-->
                                <!--                                    </tr>-->
                                <!--                                    <tr>-->
                                <!--                                        <td class="pr-1">IBAN:</td>-->
                                <!--                                        <td>ETD95476213874685</td>-->
                                <!--                                    </tr>-->
                                <!--                                    <tr>-->
                                <!--                                        <td class="pr-1">SWIFT code:</td>-->
                                <!--                                        <td>BR91905</td>-->
                                <!--                                    </tr>-->
                                <!--                                    </tbody>-->
                                <!--                                </table>-->
                                <!--                            </div>-->
                            </div>
                        </div>
                        <!-- Address and Contact ends -->

                        <!-- Product Details starts -->
                        <div class="card-body invoice-padding invoice-product-details">
                            <!--                        <form class="source-item">-->
                            <div data-repeater-list="group-a">
                                <div class="repeater-wrapper" data-repeater-item>
                                    <div class="row">
                                        <div class="col-12 product-details-border position-relative pr-0">
                                            <vue-repeater v-model="fields"></vue-repeater>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--                        </form>-->
                        </div>
                        <!-- Product Details ends -->

                        <!-- Invoice Total starts -->
                        <div class="card-body invoice-padding">
                            <div class="row invoice-sales-total-wrapper">
                                <div class="col-md-5 order-md-1 order-2 mt-md-0 mt-3">
                                    <div class="d-flex align-items-center mb-1">
                                        <label for="salesperson" class="form-label">Factura hecha por:</label>
                                        <input type="text" v-model="userMadeBy" disabled class="form-control ml-50"
                                               id="salesperson"
                                               :placeholder="userMadeBy"/>
                                    </div>
                                </div>
                                <div class="col-md-7 d-flex justify-content-end order-md-2 order-1">
                                    <div class="invoice-total-wrapper">
                                        <div class="invoice-total-item">
                                            <p class="invoice-total-title">Subtotal:</p>
                                            <p class="invoice-total-amount">{{ subTotal | currency }}</p>
                                        </div>
                                        <!--                                    <div class="invoice-total-item">-->
                                        <!--                                        <p class="invoice-total-title">Discount:</p>-->
                                        <!--                                        <p class="invoice-total-amount">$28</p>-->
                                        <!--                                    </div>-->
                                        <div class="invoice-total-item">
                                            <p class="invoice-total-title">Iva:</p>
                                            <p class="invoice-total-amount">19%</p>
                                        </div>
                                        <hr class="my-50"/>
                                        <div class="invoice-total-item">
                                            <p class="invoice-total-title">Total:</p>
                                            <p class="invoice-total-amount">{{ totalPriceInvoice | currency }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Invoice Total ends -->

                        <hr class="invoice-spacing mt-0"/>

                        <div class="card-body invoice-padding py-0">
                            <!-- Invoice Note starts -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-2">
                                        <label for="note" class="form-label font-weight-bold">Note:</label>
                                        <textarea class="form-control" rows="2" id="note">
        It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance projects. Thank You!</textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- Invoice Note ends -->
                        </div>
                    </div>
                </div>
                <!-- Invoice Edit Left ends -->

                <!-- Invoice Edit Right starts -->
                <div class="col-xl-3 col-md-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <button class="btn btn-primary btn-block mb-75" data-toggle="modal"
                                    data-target="#send-invoice-sidebar">
                                Send Invoice
                            </button>
                            <a href="./app-invoice-preview.html"
                               class="btn btn-outline-primary btn-block mb-75">Preview</a>
                            <button type="button" class="btn btn-outline-primary btn-block mb-75">Save</button>
                            <button class="btn btn-success btn-block mb-75" data-toggle="modal"
                                    data-target="#add-payment-sidebar">
                                Add Payment
                            </button>
                        </div>
                    </div>
                    <div class="mt-2">
                        <p class="mb-50">Accept payments via</p>
                        <select class="form-control">
                            <option value="Bank Account">Bank Account</option>
                            <option value="Paypal">Paypal</option>
                            <option value="UPI Transfer">UPI Transfer</option>
                        </select>
                        <div class="invoice-terms mt-1">
                            <div class="d-flex justify-content-between">
                                <label class="invoice-terms-title mb-0" for="paymentTerms">Payment Terms</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" checked id="paymentTerms"/>
                                    <label class="custom-control-label" for="paymentTerms"></label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between py-1">
                                <label class="invoice-terms-title mb-0" for="clientNotes">Client Notes</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" checked id="clientNotes"/>
                                    <label class="custom-control-label" for="clientNotes"></label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <label class="invoice-terms-title mb-0" for="paymentStub">Payment Stub</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="paymentStub"/>
                                    <label class="custom-control-label" for="paymentStub"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Invoice Edit Right ends -->
            </div>
        </section>
    </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import {en, es} from 'vuejs-datepicker/dist/locale'
import VueRepeater from 'vue-repeater'
import 'vue-repeater/dist/lib/vue-repeater.css'

export default {
    name: "CreateInvoice",
    components: {
        Datepicker,
        VueRepeater,
        // address
    },
    data() {
        return {
            fields: [
                {
                    name: 'items-invoice',
                    value: {}
                }
            ],
            subTotal: 0,
            logo: window.logoGreen,
            dateInvoiceInitial: null,
            dateInvoiceExpiration: null,
            userMadeBy: window.userAuth,
            errors: {},
            customer: this.projectInfo.customer[0],
            en: en,
            es: es,
        }
    },
    computed: {
        totalPriceInvoice: {
            get() {
                let price = 0

                this.fields.forEach(value => {
                    price += value.value.price
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
    props: ['projectInfo'],
}
</script>

<style scoped>

</style>
