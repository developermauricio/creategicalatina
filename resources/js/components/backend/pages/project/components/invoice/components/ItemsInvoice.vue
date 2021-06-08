<template>
    <div class="row w-100 pr-lg-0 pr-1 py-2">
        <div class="col-lg-5 col-12 mb-lg-0 mb-2 mt-lg-0 mt-2">
            <p class="card-text col-title mb-md-1 mb-0">Item</p>
            <textarea v-model="itemsInformation.item" class="form-control mt-2" rows="1"></textarea>
<!--            <input-form-->
<!--                :showLabel="false"-->
<!--                label=""-->
<!--                id="txtItemsDetail"-->
<!--                pattern="all"-->
<!--                :required="false"-->
<!--                :modelo.sync="itemsInformation.item"-->
<!--                type="ckeditor"-->
<!--                :options="{ rows: '10' ,-->
<!--                                  editor: editor,-->
<!--                                  config: editorConfig-->
<!--                                }"-->
<!--            ></input-form>-->
        </div>
        <div class="col-lg-3 col-12 my-lg-0">
            <p class="card-text col-title mb-0">Costo</p>
            <input-form
                type="money"
                label=""
                id="txtPrice"
                pattern="all"
                :required="false"
                :modelo.sync="itemsInformation.price"
                :money="money"
            ></input-form>
        </div>
        <div class="col-lg-2 col-12 my-lg-0">
            <p class="card-text col-title mb-md-2 mb-0">Cantidad</p>
            <input type="number" v-model="itemsInformation.quantity" class="form-control" value="1"
                   placeholder="1"/>
        </div>
        <div class="col-lg-2 col-12  mt-lg-0">
            <p class="card-text col-title mb-md-2 mb-0">Valor</p>
            <p class="card-text mb-0">{{ itemsInformation.price | currency }}</p>
        </div>
    </div>
</template>

<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import "@ckeditor/ckeditor5-build-classic/build/translations/es.js"

export default {
    name: "ItemsInvoice",
    components: {
        ClassicEditor,
    },
    data() {
        return {
            editor: ClassicEditor,
            editorConfig: {
                language: window.lang,
                toolbar: ['bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote',]
            },
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
        }
    }
}
</script>

<style scoped>
.invoice-product-details {
    padding: 0.75rem 3.45rem 0.3rem 3.45rem !important;
}
</style>
