<template>
    <div>
        <input type="hidden" @click="getDataProject" id="inputGetDataProject"/>
        <vs-popup class="showProjectModal"
                  title="Información del Proyecto"
                  :active.sync="popupActiveShowProject"
                  fullscreen
                  @update:active="closeModalShowProject"
        >
            <div class="row" v-if="loadtData">
                <div class="col-12">
                    <div class="card profile-header mb-2">
                        <!-- profile cover photo -->
                        <img class="" :src="bannerProject" alt="User Profile Image" />
                        <!--/ profile cover photo -->

                        <div class="position-relative" style="margin-top: -7rem !important;">
                            <!-- profile picture -->
                            <div class="profile-img-container d-flex align-items-center mb-1">
                                <!-- profile title -->
                                <div class="profile-title ml-3">
                                    <h1 class="text-white" v-text="nameProject"></h1>
                                    <p class="text-white" v-text="workArea"></p>
                                </div>
                            </div>
                        </div>
                        <div  class="badge float-right badge-pill badge-glow badge-warning" v-if="state === '1'">Revisión</div>
                        <div  class="badge float-right badge-pill badge-glow badge-primary" v-else-if="state === '2'">Borrador</div>
                        <div  class="badge float-right badge-pill badge-glow badge-success" v-else-if="state === '3'">Aprobado</div>
                        <div  class="badge float-right badge-pill badge-glow badge-info" v-else-if="state === '4'">En Desarrollo</div>
                        <div  class="badge float-right badge-pill badge-glow badge-danger" v-else-if="state === '5'">Rechazado</div>
                        <div  class="badge float-right badge-pill badge-glow badge-success" v-else-if="state === '6'">Finalizado</div>
                    </div>
                </div>
            </div>
            <div class="row pr-1 pl-1">
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label class="font-weight-bold">Nombre del Proyecto:</label>
                        <p v-text="nameProject"></p>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label class="font-weight-bold">Area de Trabajo:</label>
                        <p v-text="workArea"></p>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label
                            class="font-weight-bold">{{
                                quantityArrayCategories > 1 ? 'Categorías' : 'Categoría'
                            }}:</label>
                        <br>
                        <vs-chip v-for="chip in category" :key="chip.id">
                            {{ chip.name[language] }}
                        </vs-chip>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label class="font-weight-bold">Fecha de Registro:</label>
                        <p> {{ moment(dateRegister).locale(language).format("dddd, Do MMMM YYYY") }}</p>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label class="font-weight-bold">Fecha de Entrega:</label>
                        <p> {{ moment(dateDelivery).locale(language).format("dddd, Do MMMM YYYY") }}</p>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label class="font-weight-bold">Estado:</label>
                        <p v-if="state === '1'">{{
                                this.$t('backend.project.project-detail.titulo_estado_revision')
                            }}</p>
                        <p v-else-if="state === '2'">{{
                                this.$t('backend.project.project-detail.titulo_estado_borrador')
                            }}</p>
                        <p v-else-if="state === '3'">{{
                                this.$t('backend.project.project-detail.titulo_estado_aprobado')
                            }}</p>
                        <p v-else-if="state === '4'">
                            {{ this.$t('backend.project.project-detail.titulo_estado_desarrollo') }}</p>
                        <p v-else-if="state === '5'">
                            {{ this.$t('backend.project.project-detail.titulo_estado_rechazado') }}</p>
                        <p v-else-if="state === '6'">
                            {{ this.$t('backend.project.project-detail.titulo_estado_finalizado') }}</p>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label class="font-weight-bold">Descripción Corta:</label>
                        <p v-text="descriptionShort"></p>
                    </div>
                </div>
            </div>
            <div class="row pr-1 pl-1">
                <div class="col-12">
                    <div class="form-group">
                        <label class="font-weight-bold">Descripción:</label>
                        <p v-text="description"></p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label class="font-weight-bold">Observaciones:</label>
                        <p v-text="observations"></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <a :href="'/'+language+'/admin-projects/'+slug" class="btn btn-flat-primary waves-effect">Más Información</a>
                </div>
            </div>
        </vs-popup>
    </div>
</template>

<script>
require("moment/min/locales.min");
import moment from 'moment';

export default {
    name: "ShowProject",
    data() {
        return {
            moment: moment,
            popupActiveShowProject: false,
            idProject: null,
            bannerProject: window.banner_project,
            nameProject: '',
            workArea: '',
            category: null,
            quantityArrayCategories: null,
            dateRegister: null,
            dateDelivery: null,
            state: null,
            descriptionShort: null,
            description: null,
            observations: null,
            slug: null,
            loadtData: false,
            language: window.lang

        }
    },
    methods: {
        getDataProject(e) {
            e.preventDefault();

            this.idProject = e.target.value;

            this.$vs.loading({
                color: '#3f4f6e',
                text: 'Espere un momento por favor...'
            })

            setTimeout(() => {
                axios.get('/api/get-data-project/' + this.idProject).then(resp => {

                    this.popupActiveShowProject = true
                    this.nameProject = resp.data.data.name
                    this.workArea = resp.data.data.type_project.name[this.language]
                    this.category = resp.data.data.project_categories
                    this.dateRegister = resp.data.data.created_at
                    this.dateDelivery = resp.data.data.end_time
                    this.state = resp.data.data.state
                    this.slug = resp.data.data.slug
                    this.descriptionShort = resp.data.data.description_short
                    this.description = resp.data.data.description
                    this.observations = resp.data.data.observations

                    this.quantityArrayCategories = this.category.length
                    this.loadtData = true
                })
                this.$vs.loading.close()
            }, 500)

        },
        closeModalShowProject() {
            this.loadtData = false
            this.popupActiveShowProject = false
        }
    }
}
</script>

<style scoped>
.showProjectModal >>> .vs-popup {
    max-width: 1024px !important;
    height: auto;
}
</style>
