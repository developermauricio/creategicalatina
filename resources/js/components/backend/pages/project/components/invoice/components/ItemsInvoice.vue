<template>
    <div class="row row-item-invoice  w-100 pr-lg-0 pr-1 py-2">
        <div class="col-lg-5 col-12 mb-lg-0 mb-2 mt-lg-0 mt-2 text-input-observation">
            <p class="card-text col-title mb-md-1 mb-0">{{ this.$t('backend.project.billing.titulo_item') }}</p>
<!--            <textarea v-model="itemsInformation.item" class="form-control mt-2" rows="1"></textarea>-->
            <input-form
                type="textarea"
                label=""
                id="txtCommentsInvoice"
                pattern="all"
                :errorMsg="$t('backend.project.billing.titulo_ingrese_texto_valido')"
                :requiredMsg="$t('backend.project.billing.titulo_descripcion_requerida')"
                :required="true"
                :modelo.sync="itemsInformation.item"
                :options="{
                                                rows: 1
                                                }"
            >
            </input-form>
        </div>
        <div class="col-lg-3 col-12 my-lg-0 text-input-costo">
            <p class="card-text col-title mb-0">{{ this.$t('backend.project.billing.titulo_costo') }}</p>
            <input-form
                type="money"
                label=""
                id="txtPrice"
                :errorMsg="$t('backend.project.billing.titulo_ingrese_valor_valido')"
                :requiredMsg="$t('backend.project.billing.titulo_costo_item_obligatorio')"
                pattern="all"
                :required="true"
                :modelo.sync="itemsInformation.price"
                :money="money"
            ></input-form>
        </div>
        <div class="col-lg-2 col-12 my-lg-0 text-input-quantity">
            <p class="card-text col-title mb-md-2 mb-0">{{ this.$t('backend.project.billing.titulo_cantidad') }}</p>
            <input-form
                type="input"
                label=""
                id="txtPrice"
                :errorMsg="$t('backend.project.billing.titulo_ingrese_cantidad_valida')"
                :requiredMsg="$t('backend.project.billing.titulo_cantidad_obligatorio')"
                pattern="num"
                :required="true"
                :modelo.sync="itemsInformation.quantity"
            ></input-form>
        </div>
        <div class="col-lg-2 col-12  mt-lg-0">
            <p class="card-text col-title mb-md-2 mb-0">{{ this.$t('backend.project.billing.titulo_valor') }}</p>
            <p class="card-text mb-0">{{ itemsValue | currency }}</p>
        </div>
    </div>
</template>

<script>

export default {
    name: "ItemsInvoice",
    data() {
        return {

            money: {
                decimal: ",",
                thousands: ".",
                prefix: "$ ",
                suffix: "",
                precision: 0
            },
        }
    },
    props: {
        value: {
            type: Object,
            required: true
        }
    },
    computed: {
        itemsInformation: {
            get() {
                return this.value
            },
            set(itemsInformation) {
                this.$emit('input', itemsInformation)
            }
        },

        itemsValue(){
            if(this.itemsInformation.price && this.itemsInformation.quantity){
                let value = Number(this.itemsInformation.price * this.itemsInformation.quantity)
                return isNaN(value) ? 0 : value
            }
            return isNaN(Number(this.itemsInformation.price)) ? 0 : this.itemsInformation.price
        },

    },
    watch:{
        itemsInformation: {
            deep: true,
            handler: (value) => {
                if (value.quantity <= 0){
                    value.quantity = ''
                }
            }
        }
    },
    // created() {
    //     let themeDarkLocal = localStorage.getItem('theme')
    //     if (themeDarkLocal === '3' || themeDarkLocal === '1') {
    //         $('.row-item-invoice').addClass('dark-layout-create-invoice');
    //     } else {
    //         $('.row-item-invoice').removeClass('dark-layout-create-invoice');
    //     }
    // },
    mounted() {
        let themeDarkLocal = localStorage.getItem('theme')
        if (themeDarkLocal === '3' || themeDarkLocal === '1') {
            $('.row-item-invoice').addClass('dark-layout-create-invoice');
        } else {
            $('.row-item-invoice').removeClass('dark-layout-create-invoice');
        }
    }
}
</script>

<style>
.invoice-product-details {
    padding: 0.75rem 3.45rem 0.3rem 3.45rem !important;
}
.text-input-observation span.text-danger.asterisco{
    display: none;
}
.text-input-observation .form-group{
    margin-top: -1rem !important;
}
.text-input-costo span.text-danger.asterisco{
    display: none;
}
.text-input-quantity span.text-danger.asterisco{
    display: none;
}
.text-input-quantity .form-group{
    margin-top: -1.6rem !important;
}
</style>
