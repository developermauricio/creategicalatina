<template>
    <div class="invoice-preview-card" v-if="titleBrief[language]">
        <div class="invoice-padding pb-0">
            <!-- Header starts -->
            <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                <div>
                    <div class="logo-wrapper">
                       <span class="brand-logo">
                                <img width="200" :src="logo" alt="">
                       </span>
                    </div>
                    <p class="card-text mb-25">Office 149, 450 Edificio Colpatria</p>
                    <p class="card-text mb-25">Bogotá, Colombia</p>
                    <p class="card-text mb-0">+57 (123) 456 7891, +57 (876) 543 2198</p>
                </div>
                <div class="mt-md-0 mt-2">
                    <h4 class="invoice-title">
                        Brief
                        <span class="invoice-number">#3492</span>
                    </h4>
                    <div class="invoice-date-wrapper">
                        <p class="invoice-date-title" style="margin-bottom: 0px !important;">{{ $t('frontend.brief.fecha_actual') }}:</p>
                        <p class="invoice-date">{{ moment(dateNow).locale(language).format("dddd, MMMM Do YYYY") }}</p>
                    </div>
<!--                    <div class="invoice-date-wrapper">-->
<!--                        <p class="invoice-date-title">Due Date:</p>-->
<!--                        <p class="invoice-date">29/08/2020</p>-->
<!--                    </div>-->
                </div>
            </div>
            <!-- Header ends -->
        </div>

        <hr class="invoice-spacing"/>

        <!-- Address and Contact starts -->
        <div class="card-body pt-0">
            <h2 class="font-weight-bolder display-5 text-center" v-text="titleBrief[language]"></h2>
            <div class="row">
                <div v-for="question in questions" :key="question.id" class="col-12 col-lg-6 col-md-6">
                    <h6 class="pt-1">{{ question.question[language] }}:<vs-tooltip position="right" class="d-inline-block pr-1" :text="question.note[language]"><vs-icon icon="help_outline" style="font-size: 1.3rem;"></vs-icon></vs-tooltip></h6>
                    <input-form
                        :showLabel="false"
                        label="Pregunta"
                        id="txtObservacionesPauta"
                        pattern="all"
                        :errorMsg="$t('err_msg_definition')"
                        :requiredMsg="$t('req_msg_definition')"
                        :required="false"
                        :modelo.sync="answer"
                        type="ckeditor"
                        :options="{ rows: '10' ,
                                  editor: editor,
                                  config: editorConfig
                                }"
                    ></input-form>
                </div>
            </div>
        </div>
        <!-- Invoice Description ends -->

        <hr class="invoice-spacing"/>

        <!-- Invoice Note starts -->
        <div class="pt-0">
            <div class="row">
                <div class="col-12">
                    <span class="font-weight-bold">{{ $t('frontend.brief.title_nota') }}:</span>
                    <span v-if="noteBrief[language]">{{ noteBrief[language] }}</span>
                </div>
            </div>
        </div>
        <!-- Invoice Note ends -->
        <div class="text-right pt-2" style="padding-right: 15px">
            <button
                type="button"
                class="btn btn-primary pull-right"
            >{{ $t('btn_guardar') }}</button>
        </div>
    </div>
</template>

<script>
require("moment/min/locales.min");
import moment from 'moment';
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import "@ckeditor/ckeditor5-build-classic/build/translations/es.js";
export default {
    name: "BriefSoftware",
    components:{
        ClassicEditor,
    },
    data() {
        return {
            colorLoading: '#161d31',
            answer: null,
            editor: ClassicEditor,
            titleBrief: {
                en:null,
                es:null
            },
            noteBrief: {
                en:null,
                es:null
            },
            questions: [],
            editorConfig: {
                language: window.lang,
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', ]
            },
            logo: window.logo,
            dateNow: new Date(),
            moment: moment,
            language: window.lang, //Idioma actual de la aplicación
        }
    },
    props:['brief'],
    watch: {
        brief: function(newVal, oldVal) { // watch it
            this.$vs.loading({
                color: this.colorLoading,
                text: `${this.$t('loading_modal')}`
            })
            console.log('Prop changed: ', newVal, ' | was: ', oldVal)
            axios.get('/api/get-brief/'+newVal.id).then(resp =>{
                this.questions = resp.data.data
                this.$vs.loading.close()
                this.titleBrief = newVal.title
                this.noteBrief = newVal.note
            })
        }
    },
    methods: {
        // getBrief() {
        //     axios.get('/api/get-brief/'+this.id_type_project).then(resp =>{
        //         this.questions = resp.data.data
        //         // this.$vs.loading.close()
        //     })
        // }
    },
}
</script>

<style scoped>

</style>
