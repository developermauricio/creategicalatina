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
                                <button @click="popupCreateInvoiceActive = true" type="button" class="btn float-right btn-primary waves-effect waves-float waves-light">
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
                                <th class="text-center">Factura Nombre</th>
                                <th class="text-center">Estado</th>
                                </thead>
                                <tbody slot="body" slot-scope="{displayData}">
                                <tr v-for="(row, index) in displayData" :key="row.id">
                                    <td>{{ row.name }}</td>
                                    <td>{{ row.state }}</td>
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
                                    <create-invoice-project :projectInfo ="projectInfo"></create-invoice-project>
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

export default {
    name: "TypeInvoice",

    data() {
        return {
            popupCreateInvoiceActive: false,
            dataInvoice: [],
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
