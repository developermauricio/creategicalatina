<template>

    <!--=====================================
		HISTORIAL DE FACTURACIÓN
     ======================================-->
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ this.$t('backend.project.billing.titulo_historial_facturas') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <button @click="activeModalInvoice" type="button"
                                        class="btn float-right btn-primary waves-effect waves-float waves-light">
                                    {{ this.$t('backend.project.billing.titulo_nueva_factura') }}
                                </button>
                            </div>
                        </div>
                        <div class="row p-2" v-if="dataInvoice.length > 0">
                            <v-table
                                :search="true"
                                :data="dataInvoice"
                                class="table table-bordered table-hover"
                            >
                                <thead slot="head">
                                <th class="text-center">{{ this.$t('backend.project.billing.titulo_tabla_codigo') }}</th>
                                <th class="text-center">{{ this.$t('backend.project.billing.titulo_tabla_estado') }}</th>
                                <th class="text-center">{{ this.$t('backend.project.billing.titulo_tabla_total') }}</th>
                                <th class="text-center">{{ this.$t('backend.project.billing.titulo_tabla_fecha_registro') }}</th>
                                <th class="text-center">{{ this.$t('backend.project.billing.titulo_tabla_fecha_vencimiento') }}</th>
                                <th class="text-center">{{ this.$t('backend.project.billing.titulo_tabla_acciones') }}</th>
                                </thead>
                                <tbody slot="body" slot-scope="{displayData}">

                                <tr v-for="(row, index) in displayData" :key="row.id">
                                    <td>{{ row.code }}</td>
                                    <td>
                                        <div v-if="row.state === '1'" class="badge badge-pill badge-glow badge-warning">
                                            Revisión
                                        </div>
                                        <div v-else-if="row.state === '2'" class="badge badge-pill badge-glow badge-danger">
                                            Borrador
                                        </div>
                                        <div v-else-if="row.state === '3'" class="badge badge-pill badge-glow badge-success">
                                            Aprobado
                                        </div>
                                        <div v-else-if="row.state === '4'" class="badge badge-pill badge-glow badge-info">
                                            Pagada
                                        </div>
                                        <div v-else-if="row.state === '5'" class="badge badge-pill badge-glow badge-danger">
                                            Rechazada
                                        </div>
                                    </td>
                                    <td><currency-display :value="row.total"></currency-display></td>
                                    <td>{{ moment(row.date).locale(language).format("dddd, MMMM Do YYYY") }}</td>
                                    <td>{{ moment(row.expiration).locale(language).format("dddd, MMMM Do YYYY") }}</td>
                                    <td>

                                        <div class="dropdown">
                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow waves-effect waves-float waves-light" data-toggle="dropdown">
                                                <vs-icon icon="more_vert"></vs-icon>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" target="_blank" :href="'/'+language+'/admin/invoice-print/'+row.slug">
                                                    <vs-icon size="small"  icon="print"></vs-icon>
                                                    <span v-text="$t('backend.project.billing.titulo_tabla_imprimir')"></span>
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <vs-icon size="small"  icon="visibility"></vs-icon>
                                                    <span v-text="$t('backend.project.billing.titulo_tabla_ver')"></span>
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <vs-icon size="small"  icon="send"></vs-icon>
                                                    <span v-text="$t('backend.project.billing.titulo_tabla_enviar')"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>

                            </v-table>
                        </div>
                        <div v-else class="row">
                            <div class="col-12 text-center">
                                {{ $t('backend.project.billing.titulo_no_hay_facturas') }}
                            </div>
                        </div>
                        <!--=====================================
                           MODAL CREAR FACTURA
                         ======================================-->

                        <vs-popup @update:active="closeModalCreateInvoice"
                                  fullscreen
                                  class="holamundo"
                                  button-close-hidden
                                  :title="$t('backend.project.billing.titulo_crear_factura')"
                                  :active.sync="popupCreateInvoiceActive">
                            <div class="row pt-1 pr-md-4 pl-md-4 pr-lg-4 pl-lg-4">
                                <div class="col-12">
                                    <create-invoice-project :logo="logo" @createInvoice="getDataInvoice()" @closeModalCreateInvoice="closeModalCreateInvoice" :projectInfo="projectInfo"></create-invoice-project>
                                </div>
                            </div>
                        </vs-popup>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Swal from "sweetalert2";

require("moment/min/locales.min");
import moment from 'moment';

export default {
    name: "TypeInvoice",

    data() {
        return {
            themeDark:null,
            moment: moment,
            logo: null,
            popupCreateInvoiceActive: false,
            dataInvoice: [],
            language: window.lang, //Idioma actual de la aplicación
        }
    },
    methods: {
        closeModalCreateInvoice(){
          this.popupCreateInvoiceActive = false
        },
        activeModalInvoice(){

            let themeDarkLocal = localStorage.getItem('theme')
            this.themeDark = window.themeSession
            console.log(themeDarkLocal)
            if ( themeDarkLocal === '3'  || themeDarkLocal === '1') {
                this.logo = window.logoGreen
                window.matchMedia('(prefers-color-scheme: dark)')
                    .addEventListener('change', event => {
                        if (event.matches === true){
                            this.logo = window.logoGreen
                        }
                    })
            } else {
                this.logo = window.logo_ligth
                window.matchMedia('(prefers-color-scheme: dark)')
                    .addEventListener('change', event => {
                        console.log('event dark', event.matches)
                        if (event.matches === false){
                            this.logo = window.logo_ligth
                        }
                    })
            }
            setTimeout(() =>{
                this.popupCreateInvoiceActive = true;
            }, 200)

        },
        getDataInvoice() {
            setTimeout(()=>{
                this.popupCreateInvoiceActive = false;
                axios.get('/api/get-data-invoice-projects/' + this.projectInfo.id)
                    .then(resp => {
                        this.dataInvoice = resp.data.data
                    });
            }, 200)

        },
    },

    props: ['projectInfo'],

    mounted() {
        this.getDataInvoice();
        this.themeDark = window.themeSession
        if (this.themeDark === '3' || this.themeDark === '1'){
            $('.vs-popup').addClass('dark-layout');
            $('.row-item-invoice').addClass('dark-layout-create-invoice');
        }else{
            $('.pop-create-invoice').removeClass('dark-layout-create-invoice');
            $('.row-item-invoice').removeClass('dark-layout-create-invoice');
        }

        const divs = document.querySelectorAll('.vs-popup--background');

        divs.forEach(el => el.addEventListener('click', event => {
            Swal.fire({
                title: 'Confirmar',
                text: '¿Quiere continuar creando la factura?',
                confirmButtonColor: "#F05E7D",
                cancelButtonColor: "#79ebdf",
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                customClass: "swal-confirmation",
                showCancelButton: true,
                reverseButtons: true,
                allowOutsideClick: false,
            }).then((result) => {
                if (result.value) {
                    this.activeModalInvoice()
                }else{
                    this.closeModalCreateInvoice();
                }

            });
        }));
    }
}
</script>

<style scoped>
#txtFechaInicial .text-danger.asterisco {
    display: none !important;
}

#txtFechaFinal .text-danger.asterisco {
    display: none !important;
}
</style>
