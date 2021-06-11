<template>

    <!--=====================================
		HISTORIAL DE FACTURACIÓN
     ======================================-->
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Historial de Facturas</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <button @click="popupCreateInvoiceActive = true" type="button"
                                        class="btn float-right btn-primary waves-effect waves-float waves-light">
                                    Nueva Factura
                                </button>
                            </div>
                        </div>
                        <div class="row p-2">
                            <v-table
                                :data="dataInvoice"
                                class="table table-bordered table-hover"
                            >
                                <thead slot="head">
                                <th class="text-center">Código</th>
                                <th class="text-center">Factura Nombre</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">SubTotal</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Fecha de Registro</th>
                                <th class="text-center">Acciones</th>
                                </thead>
                                <tbody slot="body" slot-scope="{displayData}">
                                <tr v-for="(row, index) in displayData" :key="row.id">
                                    <td>{{ row.code }}</td>
                                    <td>{{ row.name }}</td>
                                    <td>
                                        <div v-if="row.state = 1" class="badge badge-pill badge-glow badge-warning">
                                            Revisión
                                        </div>
                                        <div v-else-if="row.state = 2" class="badge badge-pill badge-glow badge-danger">
                                            Borrador
                                        </div>
                                        <div v-else-if="row.state = 3"
                                             class="badge badge-pill badge-glow badge-success">Aprobado
                                        </div>
                                        <div v-else-if="row.state = 4" class="badge badge-pill badge-glow badge-info">
                                            Pagada
                                        </div>
                                        <div v-else-if="row.state = 5" class="badge badge-pill badge-glow badge-danger">
                                            Rechazada
                                        </div>
                                    </td>
                                    <td>{{ row.subtotal | currency }}</td>
                                    <td>{{ row.total | currency }}</td>
                                    <td>{{
                                            moment(row.date).locale(language).format("dddd, MMMM Do YYYY, hh:mm:s A")
                                        }}
                                    </td>
                                    <td>

                                        <div class="dropdown">
                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow waves-effect waves-float waves-light" data-toggle="dropdown">
                                                <vs-icon icon="more_vert"></vs-icon>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" :href="'/'+language+'/admin/invoice/'+row.slug">
                                                    <vs-icon size="small"  icon="print"></vs-icon>
                                                    <span>Imprimir</span>
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <vs-icon size="small"  icon="visibility"></vs-icon>
                                                    <span>Ver</span>
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <vs-icon size="small"  icon="send"></vs-icon>
                                                    <span>Enviar</span>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>

                            </v-table>
                        </div>
                        <!--=====================================
                           MODAL CREAR FACTURA
                         ======================================-->

                        <vs-popup fullscreen class="holamundo"
                                  title="Crear Factura"
                                  :active.sync="popupCreateInvoiceActive">
                            <div class="row pt-1 pr-md-4 pl-md-4 pr-lg-4 pl-lg-4">
                                <div class="col-12">
                                    <create-invoice-project :projectInfo="projectInfo"></create-invoice-project>
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
require("moment/min/locales.min");
import moment from 'moment';

export default {
    name: "TypeInvoice",

    data() {
        return {
            moment: moment,
            popupCreateInvoiceActive: false,
            dataInvoice: [],
            language: window.lang, //Idioma actual de la aplicación
        }
    },
    methods: {
        getDataInvoice() {
            axios.get('/api/get-data-invoice-projects/' + this.projectInfo.id)
                .then(resp => {
                    this.dataInvoice = resp.data.data
                });
        },
    },

    props: ['projectInfo'],

    mounted() {
        this.getDataInvoice();
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
