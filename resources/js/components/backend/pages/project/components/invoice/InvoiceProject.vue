<template>
    <div>
        <div class="row">
            <div class="col-12 col-md-4 col-lg-4 pt-4">
                <input-form
                    :label="$t('backend.project.billing.titulo_selecciona_tipo_facturacion')"
                    id="txtTypeInvoice"
                    errorMsg
                    requiredMsg=""
                    :modelo.sync="modelTypeInvoice"
                    :required="false"
                    type="multiselect"
                    @updatedValue="changeTypeInvoice"
                    :selectLabel="$t('backend.project.billing.titulo_selecciona_opcion')"
                    :multiselect="{
                                           options: optionsInvoice,
                                           selectLabel:this.$t('backend.customer.create-customers.multiselect_seleccionar'),
                                           selectedLabel:this.$t('backend.customer.create-customers.multiselect_seleccionado'),
                                           deselectLabel:this.$t('backend.customer.create-customers.multiselect_desmarcar'),
                                          placeholder: this.$t('backend.project.billing.titulo_selecciona_opcion'),
                                          taggable : true,
                                          'track-by':'id',
                                          label: 'name',
                                          'custom-label': typeInvoice=>typeInvoice.name[language]
                                        }"
                ></input-form>
            </div>
        </div>
        <type-invoice :projectInfo="projectInfo" v-if="typeInvoice"></type-invoice>
        <!--        <customer-type-company :type_client ="modelTypeClient" v-if="typeEntity"></customer-type-company>-->
        <!--        <customer-type-person-natural :type_client ="modelTypeClient" v-if="typeClient"></customer-type-person-natural>-->
    </div>
</template>

<script>
export default {
    name: "InvoiceProject",
    data() {
        return {
            optionsInvoice: [],
            language: window.lang,
            typeInvoice: false,
            modelTypeInvoice: null,
        }
    },

    methods: {
        getInvoiceTypes() {
            axios.get('/api/get-invoice-types')
                .then(resp => {
                    this.optionsInvoice = resp.data.data
                }).catch(err => {
                console.log(err);
            })
        },
        changeTypeInvoice(typeInvoiceSelect) {
            if (typeInvoiceSelect !== null){
                if (typeInvoiceSelect.id === 1){
                    // this.typeClient = false
                    this.typeInvoice = true
                }
            }
        },
    },
    props:['projectInfo'],

    mounted() {
        this.getInvoiceTypes()
    }
}
</script>

<style scoped>

</style>
