<template>
    <div>
        <div class="row">
            <div class="col-12 col-md-4 col-lg-4 pt-2">
                <input-form
                    :label="$t('backend.customer.create-customers.titulo_selecciona_tipo_cliente')"
                    id="txtTypeClient"
                    errorMsg
                    requiredMsg=""
                    :modelo.sync="modelTypeClient"
                    :required="false"
                    type="multiselect"
                    @updatedValue="changeTypeClient"
                    :selectLabel="$t('backend.customer.create-customers.titulo_selecciona_tipo_cliente')"
                    :multiselect="{
                                           options: optionsTypeClient,
                                           selectLabel:this.$t('backend.customer.create-customers.multiselect_seleccionar'),
                                           selectedLabel:this.$t('backend.customer.create-customers.multiselect_seleccionado'),
                                           deselectLabel:this.$t('backend.customer.create-customers.multiselect_desmarcar'),
                                          placeholder: this.$t('backend.customer.create-customers.titulo_selecciona_tipo_cliente'),
                                          taggable : true,
                                          'track-by':'id',
                                          label: 'name',
                                          'custom-label': typeClient=>typeClient.name[language]
                                        }"
                ></input-form>
            </div>
        </div>
    <customer-type-company :type_client ="modelTypeClient" v-if="typeEntity"></customer-type-company>
        <customer-type-person-natural :type_client ="modelTypeClient" v-if="typeClient"></customer-type-person-natural>
    </div>
</template>

<script>
import Multiselect from "vue-multiselect";
export default {
    name: "CreateNewCustomer",
    components: {
        Multiselect,
    },
    data(){
        return {
            language: window.lang,
            typeClient: false,
            typeEntity: false,
            optionsTypeClient: [],
            modelTypeClient: [],
        }
    },
    methods: {
        changeTypeClient(typeClientSelect){
           if (typeClientSelect !== null){
               if (typeClientSelect.id === 1){
                   this.typeClient = false
                   this.typeEntity = true
               }else if(typeClientSelect.id === 2){
                   this.typeEntity = false
                   this.typeClient = true
               }
           }else{
               this.typeClient = false
               this.typeEntity = false
           }

        },
        getTypeEntity(){
            axios.get('/api/get-type-entities')
            .then(resp => {
                this.optionsTypeClient = resp.data.data;
            })
        }
    },
    mounted() {
      this.getTypeEntity();
    }
}
</script>

<style scoped>

</style>
