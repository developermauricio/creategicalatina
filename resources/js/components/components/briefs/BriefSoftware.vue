<template>
    <div>
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
                            <p class="invoice-date-title" style="margin-bottom: 0px !important;">
                                {{ $t('frontend.brief.fecha_actual') }}:</p>
                            <p class="invoice-date">{{
                                    moment(dateNow).locale(language).format("dddd, MMMM Do YYYY")
                                }}</p>
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
                    <div v-for="(question, index) in questions" :key="question.id" class="col-12 col-lg-6 col-md-6">
                        <h6 class="pt-1">{{ question.question[language] }}:
                            <vs-tooltip position="right" class="d-inline-block" :text="question.note[language]">
                                <vs-icon icon="help_outline" style="font-size: 1.7rem;"></vs-icon>
                            </vs-tooltip>
                            <vs-tooltip position="right" class="d-inline-block"
                                        :text=" $t('frontend.brief.titulo_grabadora_tooltip')">
                                <vs-icon :color="question.colorSuccess" @click="openModalReconding(question)"
                                         icon="mic"
                                         style="font-size: 1.7rem; cursor: pointer"></vs-icon>
                            </vs-tooltip>
                        </h6>
                    <input-form
                        :showLabel="false"
                        label=""
                        id="txtObservacionesPauta"
                        pattern="all"
                        :errorMsg="$t('err_msg_definition')"
                        :requiredMsg="$t('req_msg_definition')"
                        :required="true"
                        :modelo.sync="question.model"
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
<!--        <div class="text-right pt-2" style="padding-right: 15px">-->
<!--            <button-->
<!--                @click="saveBriefProject"-->
<!--                type="button"-->
<!--                class="btn btn-primary pull-right"-->
<!--            >{{ $t('btn_guardar') }}-->
<!--            </button>-->
<!--        </div>-->
    </div>
    <!--=====================================
       MODAL BRIEF
   ======================================-->
    <vs-popup class="holamundo" :title="infoModalRecording.question[language]"
              :active.sync="popupRecondingActivo">
        <div class="row pr-md-4 pl-md-4 pr-lg-4 pl-lg-3 justify-content-center">
            <div class="col-12 pb-2">
                <h2 class="font-weight-bolder display-5 text-center"
                    v-text="infoModalRecording.question[language]"></h2>
                <p class="text-justify pb-1" v-text="infoModalRecording.note[language]"></p>
                <audio-recorder @removedRecording="removedPathRecording" @pathRecording="savePathRecording"
                                @addRecording="questionRecording" :modalRecordingValue="popupRecondingActivo"
                                :questionRecording="infoModalRecording"
                                class="offset-1"
                                upload-url="/api/save-recording-brief"
                                :show-download-button=false
                                :attempts="infoModalRecording.attempts"
                                :textIntentos="$t('frontend.brief.titulo_grabadora_intentos')"
                                :filename="infoModalRecording.question[language]"
                                :time="2"
                                :headers="headers"
                />
                <!--                        :before-recording="callback"-->
                <!--                        :pause-recording="callback"-->
                <!--                        :after-recording="callback"-->
                <!--                        :select-record="callback"-->
                <!--                        :before-upload="callback"-->
                <!--                        :successful-upload="callback"-->
                <!--                        :failed-upload="callback"/>-->
            </div>
        </div>
    </vs-popup>
    </div>
</template>

<script>
require("moment/min/locales.min");
import moment from 'moment';
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import "@ckeditor/ckeditor5-build-classic/build/translations/es.js";
import {VueSlickPopover, VueSlickPopoverContent} from "vue-slick-popover"
import "vue-slick-popover/dist/vue-slick-popover.css"

export default {
    name: "BriefSoftware",
    components: {
        ClassicEditor,
        VueSlickPopover,
        VueSlickPopoverContent
    },
    data() {
        return {
            headers: {
                'X-CSRF-TOKEN': window.token
            },
            theme: window.themeSession,
            colorLoading: '#161d31',
            answer: null,
            editor: ClassicEditor,
            titleBrief: {
                en: null,
                es: null
            },
            noteBrief: {
                en: null,
                es: null
            },
            questions: [
                {
                    recording: null
                }
            ],
            editorConfig: {
                language: window.lang,
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',]
            },
            popupRecondingActivo: false,
            logo: window.logo,
            classDarkIcon: false,
            dateNow: new Date(),
            moment: moment,
            language: window.lang, //Idioma actual de la aplicación
            infoModalRecording: {
                question: {
                    es: null,
                    en: null
                },
                note: {
                    es: null,
                    en: null
                },
                recordQuestion: []
            },
        }
    },
    props: ['brief'],
    watch: {
        brief: function (brief, oldVal) { // watch it
            this.$vs.loading({
                color: this.colorLoading,
                text: `${this.$t('loading_modal')}`
            })
            setTimeout(() =>{
                this.questions = brief.question
                // axios.get('/api/get-brief/' + brief.id).then(resp => {
                //     console.log('data consulta',resp.data)
                //     this.questions = resp.data.data
                //     this.questions.forEach(obj => {
                //             obj.attempts = 2
                //             obj.recordQuestion = []
                //             obj.pathsRecording = []
                //             obj.colorSuccess = '#ee5f7e'
                //         }
                //     )
                //     this.$vs.loading.close()
                //     this.titleBrief = brief.title
                //     this.noteBrief = brief.note
                // })
                this.questions.forEach(obj => {
                        obj.attempts = 2
                        obj.recordQuestion = []
                        obj.pathsRecording = []
                        obj.colorSuccess = '#ee5f7e'
                    }
                )
                this.titleBrief = brief.title
                this.noteBrief = brief.note
                this.$vs.loading.close()
            }, 500)

        },

    },
    methods: {
        openModalReconding(question) {
            this.popupRecondingActivo = true
            this.infoModalRecording = Object.assign({}, question)
            // this.infoModalRecording = question
        },
        questionRecording(data) {
            if (data.id === data.id) {
                let currentQuestion = this.questions.find(obj => obj.id == data.id);
                currentQuestion.recordQuestion = data.recordQuestion;
                // currentQuestion.attempts = currentQuestion.attempts - 1;
                console.log('data trae datos del recording', currentQuestion)
            }
        },
        savePathRecording(data) {
            if (data.id === data.id) {
                let currentQuestion = this.questions.find(obj => obj.id == data.id);
                currentQuestion.pathsRecording = data.pathsRecording;
                currentQuestion.colorSuccess = '#79eade'; // #4BB543
                // currentQuestion.attempts = currentQuestion.attempts - 1;
                console.log('data trae datos del recording', currentQuestion)
            }
        },
        removedPathRecording(data) {
            if (data.id === data.id) {
                let currentQuestion = this.questions.find(obj => obj.id == data.id);
                console.log('index', currentQuestion.pathsRecording);
                if (currentQuestion.pathsRecording.length == 0) {
                    console.log('saber si ', currentQuestion.pathsRecording)
                    currentQuestion.colorSuccess = '#ee5f7e';
                }
            }
        },
        saveBriefProject(){
            let i = 0;
            this.questions.forEach(obj => {
                if (obj.model && obj.model !== '' || obj.pathsRecording.length > 0 ){
                    i++
                }
            })
            if (i == 0){
                this.$toast.error({
                    title: 'Error',
                    message: 'El brief no puede estar vacio, responda una pregunta',
                    showDuration: 1000,
                    hideDuration: 6000,
                    position: 'top right',
                })
            }else{
                this.$emit("dataBrief", this.questions)
                console.log('si hay datos')
            }

        }
    },
}
</script>

<style>
.ar-records__record {
    margin-bottom: 0.7rem !important;
}

.ar-records__record--selected {
    margin-top: -7px !important;
}

.ar-records {
    padding-top: 25px !important;
}

.ar__text {
    margin-top: 1.71rem !important;
}

.ar-recorder__duration {
    padding-top: 0.5rem !important;
}

.ar__rm {
    margin-bottom: 1.30rem !important;
}

.ar-icon.ar-icon__lg svg {
    padding-bottom: 1rem !important;
}

.ar-icon.ar-icon__sm.ar-recorder__stop svg {
    padding-bottom: 0.85rem !important;
}

.incon-help-brief {
    color: rgb(95 88 115) !important;
    font-size: 1.6rem;
    cursor: pointer;
    margin-left: 7px;
}

.incon-help-brief.dark-layout {
    color: #d0d2d6 !important;
}
</style>
