<template>
    <div>
        <section class="invoice-edit-wrapper">
            <form @submit.prevent="" id="validateCreateInvoice">
                <div class="row">
                    <!-- Invoice Edit Left starts -->
                    <div class="col-xl-12 col-md-12 col-12">
                        <div class="card pop-create-invoice invoice-preview-card">
                            <!-- Header starts -->
                            <div class="card-body invoice-padding pr-5 pl-5 pt-4 pb-2">
                                <div
                                    class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                    <div>
                                        <div class="logo-wrapper">
                                            <img class="img-logo-purchase-order" width="250" :src="logo" alt="">
                                        </div>
                                        <p class="card-text mb-25">Office 149, 450 South Brand Brooklyn</p>
                                        <p class="card-text mb-25">San Diego County, CA 91905, USA</p>
                                        <p class="card-text mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p>
                                        <div class="pt-1 select-project-purcharse">
                                            <input-form
                                                label="Selecciona el proyecto"
                                                id="txtTypeInvoice"
                                                errorMsg
                                                requiredMsg=""
                                                :modelo.sync="project"
                                                :required="false"
                                                type="multiselect"
                                                selectLabel="Selecciona el proyecto"
                                                @updatedValue="changeProject"
                                                :multiselect="{
                                           options: optionsProjects,
                                           selectLabel:'Seleccionar',
                                           selectedLabel:'Seleccionado',
                                           deselectLabel: 'Desmarcar',
                                           placeholder: 'Selecciona el proyecto',
                                           taggable : true,
                                          'track-by':'id',
                                           label: 'name',
                                          'custom-label': project=>project.name
                                        }"
                                            ></input-form>
                                        </div>

                                    </div>
                                    <div class="invoice-number-date invoice-page-project mt-md-0 mt-2">
                                        <div class="justify-content-md-end mb-1">
                                            <input-form
                                                id="txtCodePurchaseOrderNumber"
                                                label="Número de Orden"
                                                pattern="all"
                                                :errorMsg="$t('backend.project.billing.titulo_ingrese_numero_factura_valido')"
                                                :requiredMsg="$t('backend.project.billing.titulo_numero_factura_obligatorio')"
                                                :modelo.sync="codePurchase"
                                                :required="true"
                                                :msgServer.sync="errors.codePurchase"
                                            ></input-form>
                                        </div>
                                        <div class="mr-3">
                                            <input-form
                                                label="Fecha de Vencimiento"
                                                id="txtFechaFinal"
                                                pattern="all"
                                                errorMsg="Ingrese una fecha de vencimiento válida"
                                                requiredMsg="La fecha de vencimiento es requerida"
                                                :required="true"
                                                :modelo.sync="dateExpirationPurchaseOrder"
                                                :msgServer.sync="errors.dateExpirationPurchaseOrder"
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
                            <hr class="invoice-spacing"/>

                            <!-- Address and Contact starts -->
                            <div class="card-body invoice-padding pr-5 pl-5 pt-1">
                                <div class="row invoice-spacing" v-if="customer.category || company.category">
                                    <div class="col-xl-6 p-0">
                                        <h6 class="mb-2">Proyecto:</h6>
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td class="pr-1">Nombre:</td>
                                                <td><strong>{{ project.name }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td style="margin-top: 0.5rem" class="pr-1">Área de Trabajo:</td>
                                                <td style="margin-top: 0.5rem">{{ project.workArea }}</td>
                                            </tr>
                                            <tr style="margin-top: 0.5rem">
                                                <td class="pr-1">Categoría:</td>
                                                <td>{{
                                                        project.category.map((value) => {
                                                            return value.name[language]
                                                        }).join(' - ')
                                                    }}
                                                </td>
                                            </tr>
                                            <tr style="margin-top: 0.5rem">
                                                <td class="pr-1">Fecha de Registro:</td>
                                                <td>{{
                                                        moment(project.dateRegister).locale(language).format("dddd, Do MMMM YYYY")
                                                    }}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-xl-6 p-0 mt-xl-0 mt-2">
                                        <h6 class="mb-2">Cliente:</h6>
                                        <table v-if="company">
                                            <tbody>
                                            <tr>
                                                <td class="pr-1">Nombre:</td>
                                                <td class="none-white-space"><strong>{{ company.name }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="pr-1">Categoría:</td>
                                                <td class="none-white-space">{{ company.category }}</td>
                                            </tr>
                                            <tr>
                                                <td class="pr-1">Correo Electrónico:</td>
                                                <td class="none-white-space">{{ company.email }}</td>
                                            </tr>
                                            <tr>
                                                <td class="pr-1">Teléfono:</td>
                                                <td class="none-white-space">{{ company.phone }}</td>
                                            </tr>
                                            <tr>
                                                <td class="pr-1">Dirección:</td>
                                                <td class="none-white-space">{{ company.address }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table v-else>
                                            <tbody>
                                            <tr>
                                                <td class="pr-1">Nombre:</td>
                                                <td class="none-white-space"><strong>{{ customer.user.name }} {{
                                                        customer.user.last_name
                                                    }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="pr-1">Categoría:</td>
                                                <td class="none-white-space">{{ customer.category }}</td>
                                            </tr>
                                            <tr>
                                                <td class="pr-1">Correo Electrónico:</td>
                                                <td class="none-white-space">{{ customer.user.email }}</td>
                                            </tr>
                                            <tr>
                                                <td class="pr-1">Teléfono:</td>
                                                <td class="none-white-space">{{ customer.user.phone }}</td>
                                            </tr>
                                            <tr>
                                                <td class="pr-1">Dirección:</td>
                                                <td class="none-white-space">{{ customer.user.address }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row" v-else>
                                    <div class="col-12 text-center">
                                        <p>Seleccione un Proyecto</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Address and Contact ends -->
                            <!--=====================================
                                SECCIÓN ITEMS
                            ======================================-->
                            <div class="card-body invoice-padding invoice-product-details"
                                 v-if="customer.category || company.category">
                                <div data-repeater-list="group-a">
                                    <div class="repeater-wrapper" data-repeater-item>
                                        <div class="row">
                                            <div class="col-12 product-details-border position-relative pr-0">
                                                <custom-repetear v-model="fields"></custom-repetear>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="invoice-spacing mt-0" v-if="customer.category || company.category"/>
                            <!--=====================================
                                SECCIÓN PREFOOTER FACTURA
                            ======================================-->
                            <div class="card-body invoice-padding mr-2 ml-2"
                                 v-if="customer.category || company.category">
                                <div class="row invoice-sales-total-wrapper">
                                    <div class="col-md-5 order-md-1 order-2 mt-md-0 mt-3">
                                        <div class="d-flex align-items-center mb-1">
                                            <label for="salesperson" class="form-label">Order de pago creada
                                                por:</label>
                                            <input type="text" v-model="userMadeBy" disabled class="form-control ml-50"
                                                   id="salesperson"
                                                   :placeholder="userMadeBy"/>
                                        </div>
                                    </div>
                                    <div class="col-md-7 d-flex justify-content-end order-md-2 order-1">
                                        <div class="invoice-total-wrapper wrapprer-purchase">
                                            <div class="invoice-total-item item-purchase-order">
                                                <p class="invoice-total-title"
                                                   style="padding-right: 0.2rem !important;">
                                                    {{ $t('backend.project.billing.titulo_subtotal') }}</p>
                                                <p class="invoice-total-amount"><strong>{{
                                                        subTotal | currency
                                                    }}</strong></p>
                                            </div>

                                            <div class="invoice-total-item item-purchase-order">
                                                <p class="invoice-total-title">
                                                    {{ $t('backend.project.billing.titulo_iva') }}</p>
                                                <p class="invoice-total-amount"><strong>19%</strong></p>
                                            </div>
                                            <hr class="my-50"/>
                                            <div class="invoice-total-item item-purchase-order">
                                                <p class="invoice-total-title">
                                                    {{ $t('backend.project.billing.titulo_total') }}</p>
                                                <p class="invoice-total-amount"><strong>{{
                                                        totalPricePurchaseOrder | currency
                                                    }}</strong></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="invoice-spacing mt-0"/>
                            <!--=====================================
                               IMPUT DE OBSERVACIONES
                            ======================================-->
                            <div class="card-body invoice-padding py-0 pb-2"
                                 v-if="customer.category || company.category">

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
                                <div class="row">
                                    <div class="col-12 demo-inline-spacing align-right-button-create-purchase">
                                        <vs-tooltip
                                            text="La creación de la orden de pago será cancelada y todos los datos que ingreso se borrarán">
                                            <button class="btn btn-primary btn-md mb-75 float-right" type="button">
                                                {{ $t('backend.project.billing.titulo_ingrese_cancelar') }}
                                            </button>
                                        </vs-tooltip>
                                        <vs-tooltip text="La orden de pago será guarda en estado borrador">
                                            <button @click="createPurchaseOrder()" type="button"
                                                    class="btn btn-success btn-md mb-75 float-right">
                                                {{ $t('backend.project.billing.titulo_guardar') }}
                                            </button>
                                        </vs-tooltip>
                                        <vs-tooltip
                                            text="La orden de pago se guardará y se enviará al cliente via correo electrónico">
                                            <button @click="modalConfirmLanguage()" type="button"
                                                    class="btn btn-success btn-md mb-75 float-right">
                                                {{ $t('backend.project.billing.titulo_guardar_enviar_cliente') }}
                                            </button>
                                        </vs-tooltip>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <vs-popup class="holamundo"  title="" :active.sync="popupSelectLanguage"  @update:active="closeModalSelectLanguage">
                    <div class="row pb-4">
                        <div class="col-12 col-md-12 col-lg-12">
                            <input-form
                                :label="$t('backend.customer.create-customers.titulo_seleccionar_idioma_email')"
                                id="txtLaguangeEmail"
                                errorMsg
                                :requiredMsg="$t('backend.customer.create-customers.titulo_obligario_idioma_email')"
                                :required="true"
                                :modelo.sync="languageEmail"
                                :msgServer.sync="errors.languageEmail"
                                type="multiselect"
                                selectLabel="Tipo de documento"
                                :multiselect="{ options: optionsLanguage,
                                                       selectLabel:this.$t('backend.customer.create-customers.multiselect_seleccionar'),
                                                       selectedLabel:this.$t('backend.customer.create-customers.multiselect_seleccionado'),
                                                       deselectLabel:this.$t('backend.customer.create-customers.multiselect_desmarcar'),
                                                      placeholder:this.$t('backend.customer.create-customers.titulo_seleccionar_idioma_email'),
                                                      taggable : true,
                                                      'track-by':'id',
                                                      label: 'name',
                                                      'custom-label': language=>language.name
                                                    }"
                            ></input-form>
                        </div>
                        <div class="col-12" v-if="company">
                            <div class="demo-inline-spacing">
                                <vs-checkbox icon="done" color="#F05E7D" class="align-items-center"  v-model="sendEmailManager">Enviar correo al representante</vs-checkbox>
                                <vs-tooltip text="Al marcar la casilla, se enviará tambien un correo de electrónico al representante de la empresa"><vs-icon size="small" icon="info"></vs-icon></vs-tooltip>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <button @click="createPurchaseOrder()" type="button"
                                    class="btn btn-success btn-md mb-75 float-right">
                                {{ $t('backend.project.billing.titulo_guardar_enviar_cliente') }}
                            </button>
                        </div>
                    </div>
                </vs-popup>
            </form>
        </section>
    </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import {en, es} from 'vuejs-datepicker/dist/locale';
import Swal from "sweetalert2";
// import VueRepeater from "vue-repeater";
import 'vue-repeater/dist/lib/vue-repeater.css'
import moment from "moment";

export default {
    name: "CreatePurchaseOrder",
    components: {
        Datepicker,
        moment,

    },
    data() {
        return {
            popupSelectLanguage:false,
            popupActiveShowNewPurchaseOrder: false,
            logo: null,

            dateExpirationPurchaseOrder: null,
            moment: moment,
            userMadeBy: window.userAuth,
            subTotal: 0,
            optionsProjects: [],
            observations: '',
            languageEmail:null,
            sendEmailManager: false,
            customer: {
                category: null,
            },
            company: {
                category: null
            },
            fields: [
                {
                    name: 'items-purchase-order',
                    value: {},
                }
            ],
            project: {
                name: null,
                workArea: null,
                category: null,
                dateRegister: null,
            },
            codePurchase: '2312-123',

            optionsLanguage: [
                {id: 1, name: this.$t('Español'), code: 'es'},
                {id: 2, name: this.$t('Inglés'), code: 'en'},
            ],
            sendEmail: 2,
            language: window.lang,
            errors: {},
            en: en,
            es: es,
        }
    },

    methods: {
        changeProject(project) {
            if (project) {
                this.project.category = null
                this.$vs.loading({
                    color: '#3f4f6e',
                    text: 'Espere un momento por favor...'
                })
                setTimeout(() => {
                    axios.get('/api/get-project-create-purchase/' + project.id).then(resp => {
                        console.log('data project', resp.data.data)
                        this.company = resp.data.data.company[0];
                        if (this.company) {
                            this.company.category = resp.data.data.company[0].category.name[this.language];
                        } else {
                            this.company = null
                        }
                        this.customer = resp.data.data.customer[0];
                        this.customer.category = resp.data.data.customer[0].company_category.name[this.language];

                        this.project.name = resp.data.data.name
                        this.project.workArea = resp.data.data.type_project.name[this.language]
                        this.project.category = resp.data.data.project_categories;
                        this.project.dateRegister = resp.data.data.created_at
                    })
                    this.$vs.loading.close()
                }, 500);
            } else {
                this.company = null;
                this.customer = null
            }
        },
        getProjects() {
            axios.get('/api/get-projects').then(resp => {
                this.optionsProjects = resp.data.data;
            });
        },

        modalConfirmLanguage(){
            eventBus.$emit("validarFormulario");
            setTimeout(() => {
                let resp = this;
                /***  VALIDANDO LOS ERRORES Y MOSTRANDO UNA ALERTA  ***/
                if (document.querySelectorAll("#validateCreateInvoice .is-invalid").length > 0 ) {
                    this.$toast.error({
                        title: 'Error',
                        message: this.$t('backend.project.billing.toast_alert_todos_campos_llenos'),
                        showDuration: 2000,
                        hideDuration: 9000,
                        position: 'top right',
                    })
                    return;
                }
                this.popupSelectLanguage = true
                this.sendEmail = 1
            },200)


        },

        createPurchaseOrder() {
            eventBus.$emit("validarFormulario");
            setTimeout(() => {
                let resp = this;
                if (!this.languageEmail && this.sendEmail === 1){
                    this.$toast.error({
                        title: 'Error',
                        message: this.$t('backend.project.billing.toast_alert_todos_campos_llenos'),
                        showDuration: 2000,
                        hideDuration: 9000,
                        position: 'top right',
                    })
                    return;
                }
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
                console.log('manage', this.sendEmailManager)
                const data = new FormData()
                data.append('code', this.codePurchase);
                data.append('subtotal', this.subTotal);
                data.append('total', this.totalPricePurchaseOrder);
                data.append('date_expiration', moment(this.dateExpirationPurchaseOrder).format("YYYY-MM-DD HH:mm:ss"));
                data.append('items', JSON.stringify(this.fields))
                data.append('observation', this.observations);
                data.append('sendEmail', this.sendEmail);
                data.append('sendEmailManager', this.sendEmailManager);
                data.append('project', JSON.stringify(this.project));
                data.append('customer', JSON.stringify(this.customer));
                data.append('languageEmail', JSON.stringify(this.languageEmail));
                data.append('company', JSON.stringify(this.company));

                Swal.fire({
                    title: '<strong>HTML <u>example</u></strong>',
                    icon: 'info',
                    html:
                        'You can use <b>bold text</b>, ' +
                        '<a href="//sweetalert2.github.io">links</a> ' +
                        'and other HTML tags',
                    showCloseButton: true,
                    showCancelButton: true,
                    focusConfirm: false,
                    confirmButtonText:
                        '<i class="fa fa-thumbs-up"></i> Great!',
                    confirmButtonAriaLabel: 'Thumbs up, great!',
                    cancelButtonText:
                        '<i class="fa fa-thumbs-down"></i>',
                    cancelButtonAriaLabel: 'Thumbs down'
                })

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
                            text: this.sendEmail === 1 ? 'Registrando Orden de Pago y Enviado al Cliente...' : 'Registrando Orden de Pago...'
                        })

                        axios.post('/api/register/store-purchase-order', data).then(res => {
                            this.$toast.success({
                                title: 'Muy Bien',
                                message: 'Orden de Pago Creado Correctamente',
                                showDuration: 1000,
                                hideDuration: 8000,
                                position: 'top right',
                            })
                            setTimeout(() => {
                                this.$vs.loading.close()
                            }, 2300)
                            window.location = '/' + this.language + "/purchase-orders";
                        }).catch(err => {
                            console.log('mostrando el error', err)
                            this.$toast.error({
                                title: this.$t('backend.project.billing.toast_alert_algo_salio_mal'),
                                message: this.$t('backend.project.billing.toast_alert_comunicate_administrador'),
                                showDuration: 1000,
                                hideDuration: 8000,
                            })
                            setTimeout(() => {
                                this.$vs.loading.close()
                            }, 2300)
                        });
                    }
                })


            }, 200)
        },
        closeModalSelectLanguage(){
            this.sendEmail = 2
            this.languageEmail = null
            this.sendEmailManager = false
        }

    },

    computed: {
        totalPricePurchaseOrder: {
            get() {
                let price = 0
                let quantity = 1
                this.fields.forEach(value => {
                    if (value.value.quantity > 1) {
                        quantity = value.value.quantity
                    }
                    price += Number(value.value.price) * Number(quantity)
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

    mounted() {
        this.getProjects();
        document.getElementById('txtCodePurchaseOrderNumber').disabled = true;
        let themeDarkLocalChange = localStorage.getItem('theme')
        if (themeDarkLocalChange === '3' || themeDarkLocalChange === '1') {
            this.logo = window.logoGreen
        } else {
            this.logo = window.logo_ligth
        }

        window.matchMedia('(prefers-color-scheme: dark)')
            .addEventListener('change', event => {
                let themeDarkLocalChange = localStorage.getItem('theme')
                console.log('TEMA ACTUAL', themeDarkLocalChange)
                if (event.matches === true && (themeDarkLocalChange === '4' || themeDarkLocalChange === '2')) {
                    this.logo = window.logoGreen // LOGO VERDE FOSFORECENTE
                } else {
                    this.logo = window.logo_ligth // LOGO AZUL TURQUI
                }
            })
    }
}
</script>

<style scoped>
/*.showProjectModal >>> .vs-popup {*/
/*    max-width: 1024px !important;*/
/*    height: auto;*/
/*}*/
.select-project-purcharse .form-group {
    width: 25rem !important;
}

.item-purchase-order {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
}

.wrapprer-purchase {
    width: 100% !important;
    max-width: 12rem !important;
}

.demo-inline-spacing.align-right-button-create-purchase {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-end;
    align-items: center;
}
.con-vs-checkbox{
    justify-content: left !important;
}
.vs-checkbox{
    width: 26px;
    height: 26px;
}
</style>
