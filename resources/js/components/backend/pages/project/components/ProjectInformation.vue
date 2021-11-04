<template>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <vs-collapse accordion>
                            <!--=====================================
                                 INFORMACIÓN DEL PROYECTO
                             ======================================-->
                            <vs-collapse-item :open="true" >
                                <div slot="header">
                                    <h3>{{ this.$t('backend.project.project-detail.titulo_informacio_proyecto') }}</h3>
                                </div>
                                <div class="row pl-2 pr-2 pt-1 pb-3">
                                    <div class="col-6 col-md-3 col-lg-3 pt-1">
                                        <h5 class="mb-75">{{ this.$t('backend.project.project-detail.titulo_nombre_proyecto') }}</h5>
                                        <p class="card-text" v-text="projectInfo.name"></p>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-3 pt-1">
                                        <h5 class="mb-75">{{ this.$t('backend.project.project-detail.titulo_area_trabajo') }}</h5>
                                        <p class="card-text" v-text="projectInfo.type_project.name[language]"></p>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-3 pt-1">
                                        <h5 class="mb-75">{{ this.$t('backend.project.project-detail.titulo_categoria') }}</h5>
                                        <vs-chip v-for="chip in projectInfo.project_categories" :key="chip.id">
                                            {{  chip.name[language] }}
                                        </vs-chip>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-3 pt-1">
                                        <h5 class="mb-75">{{ this.$t('backend.project.project-detail.titulo_fecha_registro') }}</h5>
                                        <p class="card-text">
                                            {{ moment(projectInfo.created_at).locale(language).format("dddd, MMMM Do YYYY") }}</p>
                                    </div>
                                </div>
                                <div class="row pl-2 pr-2 pt-1 pb-3">
                                    <div class="col-6 col-md-3 col-lg-3">
                                        <h5 class="mb-75">{{ this.$t('backend.project.project-detail.titulo_fecha_entrega') }}</h5>
                                        <p class="card-text" v-if="projectInfo.end_time">
                                            {{ moment(projectInfo.end_time).locale(language).format("dddd, MMMM Do YYYY") }}</p>
                                        <p class="card-text" v-else>
                                            No registrado
                                        </p>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-3">
                                        <h5 class="mb-75">{{ this.$t('backend.project.project-detail.titulo_estado') }}</h5>
                                        <p class="card-text" v-if="projectInfo.state === '1'">{{ this.$t('backend.project.project-detail.titulo_estado_revision') }}</p>
                                        <p class="card-text" v-else-if="projectInfo.state === '2'">{{ this.$t('backend.project.project-detail.titulo_estado_borrador') }}</p>
                                        <p class="card-text" v-else-if="projectInfo.state === '3'">{{ this.$t('backend.project.project-detail.titulo_estado_aprobado') }}</p>
                                        <p class="card-text" v-else-if="projectInfo.state === '4'">{{ this.$t('backend.project.project-detail.titulo_estado_desarrollo') }}</p>
                                        <p class="card-text" v-else-if="projectInfo.state === '5'">{{ this.$t('backend.project.project-detail.titulo_estado_rechazado') }}</p>
                                        <p class="card-text" v-else-if="projectInfo.state === '6'">{{ this.$t('backend.project.project-detail.titulo_estado_finalizado') }}</p>
                                    </div>
                                    <div class="col-6 col-md-6 col-lg-6">
                                        <h5 class="mb-75">{{ this.$t('backend.project.project-detail.titulo_descripcion_corta') }}</h5>
                                        <p class="card-text" v-if="projectInfo.description_short">{{ projectInfo.description_short }}</p>
                                        <p class="card-text" v-else>{{ this.$t('backend.project.project-detail.titulo_no_registrado') }}</p>
                                    </div>
                                </div>
                                <div class="row pl-2 pr-2 pb-3">
                                    <div class="col-12">
                                        <h5 class="mb-75">{{ this.$t('backend.project.project-detail.titulo_descripcion') }}</h5>
                                        <p class="card-text" v-if="projectInfo.description">{{ projectInfo.description }}</p>
                                        <p class="card-text" v-else>{{ this.$t('backend.project.project-detail.titulo_no_registrado') }}</p>
                                    </div>
                                </div>
                                <div class="row pl-2 pr-2 pb-3">
                                    <div class="col-12">
                                        <h5 class="mb-75">{{ this.$t('backend.project.project-detail.titulo_observaciones') }}</h5>
                                        <p class="card-text" v-if="projectInfo.observations">{{ projectInfo.observations }}</p>
                                        <p class="card-text" v-else>{{ this.$t('backend.project.project-detail.titulo_no_registrado') }}</p>
                                    </div>
                                </div>
                            </vs-collapse-item>
                            <!--=====================================
                                 BRIEF
                             ======================================-->
                            <vs-collapse-item>
                                <div slot="header">
                                    <h3>Brief</h3>
                                </div>
                                <div class="row pl-2 pr-2 pt-1 ">
                                    <div class="col-12">
                                        <h4 v-text="brief.title[language]"></h4>
                                    </div>
                                </div>
                                <div class="row pl-2 pr-2 pb-3" >
                                    <div v-for="(answer, index) in answer" :key="answer.id" class="col-12 col-md-6 col-lg-6 pt-1">
                                        <h5 class="mb-75">{{ answer.question.question[language] }}</h5>
                                        <div class="pb-2" v-for="audio in JSON.parse(answer.audio)" :key="audio.id">
                                            <vue-plyr>
                                                <audio controls>
                                                    <source
                                                        :src="'/storage/'+audio.path"
                                                        type="audio/mp3"
                                                    />
                                                    <source
                                                        :src="'/storage/'+audio.path"
                                                        type="audio/ogg"
                                                    />
                                                </audio>
                                            </vue-plyr>
                                        </div>
                                        <p style="text-align: justify" v-html="answer.answer ? answer.answer: `<p class='text-primary'>${$t('backend.project.project-detail.titulo_no_registrado')}</p>`"></p>
                                    </div>
                                </div>
                            </vs-collapse-item>
                            <!--=====================================
                                 INFORMACIÓN DEL CLIENTE
                             ======================================-->
                            <vs-collapse-item>
                                <div slot="header">
                                    <h3>{{ this.$t('backend.project.project-detail.titulo_informacion_cliente') }}</h3>
                                </div>
                                <div class="row pl-2 pr-2 pt-1 pb-3">
                                    <div class="col-6 col-md-3 col-lg-3 pt-1">
                                        <h5 class="mb-75">{{ this.$t('backend.project.project-detail.titulo_nombre') }}</h5>
                                        <p class="card-text" v-text="projectInfo.customer[0].user.name"></p>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-3 pt-1">
                                        <h5 class="mb-75">{{ this.$t('backend.project.project-detail.titulo_apellidos') }}</h5>
                                        <p class="card-text" v-text="projectInfo.customer[0].user.last_name"></p>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-3 pt-1">
                                        <h5 class="mb-75">{{ this.$t('backend.project.project-detail.titulo_correo_electronico') }}</h5>
                                        <p class="card-text" v-text="projectInfo.customer[0].user.email"></p>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-3 pt-1">
                                        <h5 class="mb-75">{{ this.$t('backend.project.project-detail.titulo_telefono') }}</h5>
                                        <p class="card-text" v-text="projectInfo.customer[0].user.phone"></p>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-3 pt-1">
                                        <h5 class="mb-75">{{ this.$t('backend.project.project-detail.titulo_fecha_nacimiento') }}</h5>
                                        <p class="card-text" v-text="moment(projectInfo.customer[0].user.birthday).locale(language).format('MMMM Do YYYY')"></p>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-3 pt-1">
                                        <h5 class="mb-75">{{ this.$t('backend.project.project-detail.titulo_direccion') }}</h5>
                                        <p class="card-text" v-text="projectInfo.customer[0].user.address"></p>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-3 pt-1">
                                        <h5 class="mb-75">{{ this.$t('backend.project.project-detail.titulo_pais') }}</h5>
                                        <p class="card-text">{{ projectInfo.customer[0].user.country.name }} <img
                                            width="15" :src="projectInfo.customer[0].user.country.flag" alt=""></p>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-3 pt-1" v-if="projectInfo.customer[0].user.city">
                                        <h5 class="mb-75">{{ this.$t('backend.project.project-detail.titulo_ciudad') }}</h5>
                                        <p class="card-text" v-text="projectInfo.customer[0].user.city.name"></p>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-3 pt-1">
                                        <h5 class="mb-75">{{ this.$t('backend.project.project-detail.titulo_cargo') }}</h5>
                                        <p class="card-text" v-text="projectInfo.customer[0].position.name[language]"></p>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-3 pt-1">
                                        <h5 class="mb-75">{{ this.$t('backend.project.project-detail.titulo_categoria') }}</h5>
                                        <p class="card-text" v-text="projectInfo.customer[0].company_category.name[language]"></p>
                                    </div>
                                </div>
                            </vs-collapse-item>
                        </vs-collapse>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
require("moment/min/locales.min");
import moment from 'moment';
import VuePlyr from 'vue-plyr'
import 'vue-plyr/dist/vue-plyr.css'
export default {
    name: "ProjectInformation",
    components:{
        VuePlyr
    },
    data(){
        return{
            moment:moment ,
            answer: [],
            brief: {
                title: {
                    en: null,
                    es: null
                }
            },
            language: window.lang,
        }
    },
    methods:{
      getBriefAnswer(){

          axios.get('/api/get-brief-answer/'+this.projectInfo.id+'/'+this.projectInfo.type_project.id)
          .then(resp => {
              this.answer = resp.data.answer
              this.brief = resp.data.brief
          })
      }
    },
    props: ['projectInfo'],

    mounted() {
        this.getBriefAnswer();
    }
}
</script>

<style scoped>
.plyr--full-ui input[type=range]{
    color: #F05E7D !important;
}
</style>
