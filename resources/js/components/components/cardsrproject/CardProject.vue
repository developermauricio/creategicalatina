<template>
  <div>
    <!--=====================================
 1. PASO SELECCIONAR EL TIPO DE PROYECTO
    ======================================-->

    <!--=====================================
TARJETAS TIPO PROYECTO PARA MOBILE
    ======================================-->
    <div class="row row-cards-mobile-register-project" style="display: none">
      <p class="pb-1 text-center">{{ $t('frontend.register-client.selecciona_tipo_proyecto') }}</p>
      <div class="col-12">
        <splide :slides="optionsTypeProject" :options="options">
          <splide-slide v-for="typeProject in optionsTypeProject" :key="typeProject.id" :id="typeProject.id">
            <div
              :class="typeProject.id === ( selectProjectType ? selectProjectType.id : 0 ) ? 'card  active': 'card '"
            >
              <img @click="typeProjectSelected( typeProject )" class="card-img-top pt-1 pr-1 pl-1"
                   :src="typeProject.picture" alt="Card image cap">
              <div class="card-body" style="padding-top: 1rem !important;">
                <h6 class="card-title text-center text-title-card-mobile"
                    style="font-size: 1.2rem; margin-bottom: 0.30rem !important;">
                  {{ typeProject.name[language] }}</h6>
                <p class="card-text text-center" @click="moreInformationProject(typeProject)">
                  {{ $t('mas_info') }}
                </p>
              </div>
            </div>
          </splide-slide>
        </splide>
      </div>
    </div>
    <!--=====================================
    TARJETAS TIPO PROYECTO PARA ESCRITORIO
    ======================================-->
    <div class="row-cards-desktop-register-project">
      <div v-if="skeletonValue == 1">
        <div class="row">
          <div class="col-12 col-md-3 col-lg-3 pt-3" v-for="skele in 6">
            <SkeletonScaffold
              :primary="colorCardLoading"
              borderRadius="0px"
              animTimingFunction="ease-in">
              <div v-mBox v-mDark style="height: 1.5em"></div>
              <br/>
              <div v-mCardImg></div>
            </SkeletonScaffold>
          </div>
        </div>
      </div>
      <div v-if="skeletonValue === 0">
        <p class="pb-1">{{ $t('frontend.register-client.selecciona_tipo_proyecto') }}</p>
        <div class="row">
          <div class="col-6 col-lg-3 col-md-3" v-for="typeProject in optionsTypeProject"
               :key="typeProject.id">
            <div :class="typeProject.id === ( selectProjectType ? selectProjectType.id : 0 ) ? 'active': ''"
            >
              <div class="card-container card-info-animation" style="cursor:pointer">
                <div class="card-flip">
                  <!--=====================================
                  LADO FRONTAL DE LA TARJETA
                  ======================================-->
                  <div class="front" @click="typeProjectSelected( typeProject )">
                    <div class="card no-b">
                      <div class="card-body text-center">
                        <h3 class="p-t-10  font-weight-bold">{{
                            typeProject.name[language]
                          }}</h3>
                        <img style="margin-top: 0.5rem" width="170"
                             :src="typeProject.picture" alt="">
                      </div>
                    </div>
                  </div>
                  <!--=====================================
                  LADO POSTERIOR DE LA TARJETA
                  ======================================-->
                  <div class="back">
                    <div class="card" style="border: 2px solid #79ebdf; !important">
                      <div class="card-body cardPatterType pt-1 pr- pl-1 pb-0"
                           @click="typeProjectSelected( typeProject )">
                        <i class="fa fa-check-circle text-success checkPatterType"></i>
                        <h3 class="p-t-10  font-weight-bold">{{
                            typeProject.name[language]
                          }}</h3>
                        <p class="mt-1 text-justify" style="line-height: 1.3rem !important">
                          {{ typeProject.description[language] }}</p>
                      </div>
                      <button @click="moreInformationProject(typeProject)" type="button"
                              class="float-right btn btn-flat-primary waves-effect link">
                        {{ $t('mas_info') }}
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--=====================================
   2. PASO SELECCIONAR LAS CATEGORIAS DEL PROYECTO
    ======================================-->
    <div v-if="selectProjectType.id">
      <div class="divider" id="section-projects-categories">
        <div class="divider-text">{{ $t('frontend.register-client.siguiente_paso') }}</div>
      </div>
      <!--=====================================
     TARJETAS CATEGORIAS PROYECTOS PARA MOBILE
      ======================================-->
      <div style="display: none" class="section-categories-project-mobile">
        <div class="row pt-2 pb-2 justify-content-center">
          <div class="col-12">
            <h3 class="font-weight-bolder display-4 text-center">
              {{ selectProjectType.name[language] }}</h3>
          </div>
        </div>
        <p class="pt-1 text-center">{{ $t('frontend.register-client.selecciona_categoria_proyecto') }}
          <vs-tooltip class="d-inline-block pr-1" position="right"
                      :text="$t('frontend.register-client.msj_tooltip_info_select_category')">
            <vs-icon icon="help_outline" style="font-size: 1.3rem;"></vs-icon>
          </vs-tooltip>
        </p>
        <div class="row">
          <div class="col-12">
            <splide :slides="optionsCategoriesProject" :options="optionsCategoriesProjectCards">
              <splide-slide v-for="categoriesProject in optionsCategoriesProject"
                            :key="categoriesProject.id"
                            :id="categoriesProject.id">
                <div
                  :class="selectedCategoriesProjectActive( categoriesProject ) ? 'card  active' : 'card'"
                  @click="categoriesProjectSelected( categoriesProject )">
                  <img width="200" class="card-img-top pt-1" :src="categoriesProject.picture"
                       alt="Card image cap">
                  <div class="card-body" style="padding-top: 1rem !important;">
                    <h6 class="card-title text-center text-title-card-mobile"
                        style="font-size: 1.2rem; margin-bottom: 0.30rem !important;">
                      {{ categoriesProject.name[language] }}</h6>
                    <p class="card-text text-center">
                      {{ $t('mas_info') }}
                    </p>
                  </div>
                </div>
              </splide-slide>
            </splide>
          </div>
        </div>
      </div>
      <!--=====================================
     TARJETAS CATEGORIAS PROYECTOS PARA ESCRITORIO
      ======================================-->
      <div class="section-categories-project-desktop">
        <div class="row pt-2 pb-1 justify-content-center">
          <div class="col-12">
            <h3 class="font-weight-bolder display-4 text-center">
              {{ selectProjectType.name[language] }}</h3>
          </div>
        </div>
        <div class="d-inline-block">
          <p class="pt-1">{{ $t('frontend.register-client.selecciona_categoria_proyecto') }}
            <vs-tooltip position="right" class="d-inline-block pr-1"
                        :text="$t('frontend.register-client.msj_tooltip_info_select_category')">
              <vs-icon icon="help_outline" style="font-size: 1.3rem;"></vs-icon>
            </vs-tooltip>
          </p>

        </div>

        <div class="row">
          <div class="col-6 col-lg-3 col-md-3" v-for="categoriesProject in optionsCategoriesProject"
               :key="categoriesProject.id">
            <div
              :class="selectedCategoriesProjectActive( categoriesProject ) ? 'active' : ''"
              @click="categoriesProjectSelected( categoriesProject )">
              <div class="card-container" id="card-info-animation-category" style="cursor:pointer">
                <div class="card-flip">
                  <div class="front">
                    <div class="card no-b">
                      <div class="card-body text-center">
                        <h3 class="p-t-10  font-weight-bold">{{
                            categoriesProject.name[language]
                          }}</h3>
                        <img style="margin-top: 0.5rem" width="170"
                             :src="categoriesProject.picture" alt="">
                      </div>
                    </div>
                  </div>

                  <div class="back">
                    <div class="card" style="border: 2px solid #79ebdf; !important">
                      <div class="card-body cardPatterType">
                        <i class="fa fa-check-circle text-success checkPatterType"></i>
                        <h3 class="p-t-10  font-weight-bold">{{
                            categoriesProject.name[language]
                          }}</h3>
                        <p class="mt-1 text-justify" style="line-height: 1.3rem !important">
                          Lorem
                          ipsum
                          dolor sit amet,
                          consectetur adipisicing elit. Accusantium ad aliquam asperiores aut
                          dolorum
                          esse,
                          fuga ipsum itaque natus nesciunt pariatur perferendis perspiciatis
                          provident
                          recusandae repudiandae saepe tempore veniam voluptatum.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--=====================================
     TAGS CATEGORIAS PROYECTO
      ======================================-->
      <div class="row pl-2 pr-2" v-if="listCategoriesProject.length > 0">
        <div class="col-12">
          <p class="">{{ $t('frontend.register-client.categorias_seleccionadas') }}</p>
          <vs-chip style="margin-right: 1rem"
                   v-for="tagsCategoriesProject in listCategoriesProject" :key="tagsCategoriesProject.id"
                   @click="removeTagsCategoriesProject(tagsCategoriesProject)" closable close-icon="delete">
            <span style="font-size: 1rem !important;">{{ tagsCategoriesProject.name[language] }}</span>
          </vs-chip>
          <div id="section-tags-categories-project"></div>
        </div>
      </div>
      <!--=====================================
     SECCIÓN BRIEF
      ======================================-->
      <div class="section-brief pt-1 pb-2" v-if="listCategoriesProject.length > 0">
        <div class="divider" id="section-brief">
          <div class="divider-text">{{ $t('frontend.register-client.siguiente_paso') }}</div>
        </div>
        <div class="row pt-2 pb-1 justify-content-center">
          <div class="col-12">
            <h3 class="font-weight-bolder display-4 text-center">
              Brief</h3>
          </div>
        </div>
        <div class="d-inline-block">
          <p class="pt-1">{{ $t('frontend.register-client.selecciona_agregar_brief') }}
            <vs-tooltip position="right" class="d-inline-block pr-1"
                        :text="$t('frontend.register-client.msj_tooltip_titulo_agregar_brief')">
              <vs-icon icon="help_outline" style="font-size: 1.3rem;"></vs-icon>
            </vs-tooltip>
          </p>
        </div>
        <div class="row">
          <div class="col-12 col-lg-4 col-md-4">
            <input-form
              id="txtNameProject"
              :label="$t('frontend.register-client.nombre_proyecto_registro')"
              pattern="all"
              :errorMsg="$t('frontend.register-client.error_name_project')"
              :requiredMsg="$t('frontend.register-client.requerido_name_project')"
              :modelo.sync="nameProject"
              :required="true"
              :msgServer.sync="errors.name"
            ></input-form>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="list-group">
                <h5 @click="modalBrief"
                    :class="{ 'succes-brief ': classBorderCheckBrief, 'icheck-brief':classBorderICheckBrief  }"
                    class="card-header links-title list-group-item list-group-item-action">
                  {{ $t('frontend.register-client.agregar_brief') }}
                  <span v-if="briefCheck"
                        class="badge badge-light-success badge-pill float-right icon-check-success-brief">
                                        <vs-icon size="medium" icon="done"></vs-icon>
                                    </span>
                  <span v-if="briefICheck"
                        class="badge badge-light-success badge-pill float-right icon-check-icheck-brief">
                                        <vs-icon size="medium" icon="block"></vs-icon>
                                    </span>
                </h5>

              </div>
            </div>
            <p v-if="textBriefCheck">El brief contiente información.</p>
            <p v-if="textBriefIcheck">El brief no tiene información, debes responder al menos una
              pregunta.</p>
          </div>
        </div>
        <!--=====================================
        SECCIÓN GUARDAR
        ======================================-->
        <div class="section-save-project pt-1 pb-2" v-if="listCategoriesProject.length > 0">
          <div class="divider" id="section-save-project">
            <div class="divider-text">{{ $t('frontend.register-client.siguiente_paso') }}</div>
          </div>
          <div class="row pt-2 pb-1 justify-content-center">
            <div class="col-12">
              <h3 class="font-weight-bolder display-4 text-center">
                {{ $t('frontend.register-client.titulo_guardar_proyecto') }}</h3>
            </div>
          </div>
          <div class="d-inline-block" v-if="optionToAssingProject">
            <p v-if="optionToAssingProject.length > 0" class="pt-1">
              {{ $t('frontend.register-client.titulo_seccion_cuarta_empresa') }}
              <vs-tooltip v-if="optionToAssingProject.length > 0" position="right" class="d-inline-block pr-1"
                          :text="$t('frontend.register-client.titulo_tooltip_seccion_cuarta')">
                <vs-icon icon="help_outline" style="font-size: 1.3rem;"></vs-icon>
              </vs-tooltip>
            </p>
            <p class="pt-1" v-else>
              {{ $t('frontend.register-client.titulo_seccion_cuarta') }}
            </p>
          </div>
          <div class="row">
            <div class="col-12">
              <input-form
                id="txtDescription"
                :label="$t('frontend.register-client.titulo_observacioness')"
                pattern="all"
                errorMsg=""
                type="textarea"
                requiredMsg=""
                :modelo.sync="observationProject"
                :required="false"
                :msgServer.sync="errors.observationProject"
                :options="{
                        rows: 5
                    }"
              ></input-form>
              <!--=====================================
		              CUANDO ES ADMINISTRADOR - ASIGNAR CLIENTE
              ======================================-->
              <div v-if="$gate.allow('addCustomerProject', 'project')">
                <div class="row">
                  <div class="col-12 col-lg-5 col-md-5">
                    <input-form
                      label="Seleccionar el cliente"
                      id="txtTypeClient"
                      class="d-inline-block w-75"
                      errorMsg
                      requiredMsg=""
                      :modelo.sync="modelCustomer"
                      :required="false"
                      type="multiselect"
                      @updatedValue="changeTypeCustomer"
                      selectLabel="Seleccionar cliente"
                      :multiselect="{
                                           options: optionCustomers,
                                           selectLabel:this.$t('backend.customer.create-customers.multiselect_seleccionar'),
                                           selectedLabel:this.$t('backend.customer.create-customers.multiselect_seleccionado'),
                                           deselectLabel:this.$t('backend.customer.create-customers.multiselect_desmarcar'),
                                          placeholder: 'Seleccionar cliente',
                                          taggable : true,
                                          'track-by':'id',
                                          label: 'name',
                                          'custom-label': customer=>customer.name
                                        }"
                    >
                    </input-form>
                    <div @click="openModalCustomer" class="d-inline-block">
                      <vs-tooltip v-if="modelCustomer" position="right" class="pr-1 d-inline-block"
                                  text="Clic para consultar la información del cliente">
                        <vs-icon icon="help_outline" style="font-size: 1.3rem; cursor: pointer"></vs-icon>
                      </vs-tooltip>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row" v-if="optionToAssingProject && optionToAssingProject.length > 0">
            <div class="col-12 col-lg-4 col-md-4">
              <input-form
                :label="$t('frontend.register-client.titulo_asignar_empresa')"
                id="textAddCompany"
                errorMsg
                :requiredMsg="$t('frontend.register-client.titulo_asignar_empresa_requerido')"
                :required="true"
                :modelo.sync="valuetoassignProject"
                :msgServer.sync="errors.valuetoassignProject"
                type="multiselect"
                :selectLabel="$t('frontend.register-client.titulo_selecionar_empresa')"
                :multiselect="{ options: optionToAssingProject,
                                           selectLabel:this.$t('backend.customer.create-customers.multiselect_seleccionar'),
                                           selectedLabel:this.$t('backend.customer.create-customers.multiselect_seleccionado'),
                                           deselectLabel:this.$t('backend.customer.create-customers.multiselect_desmarcar'),
                                          placeholder:$t('frontend.register-client.titulo_selecionar_empresa'),
                                          taggable : true,
                                          'track-by':'id',
                                          label: 'name',
                                          'custom-label': toAssing=>toAssing.name
                                        }"
              ></input-form>
            </div>
          </div>
          <div class="row pb-3">
            <div class="col-12">
              <button @click="saveNewProject" type="button"
                      class="btn btn-primary waves-effect waves-float waves-light float-right">
                {{ $t('frontend.projects.new-project.btn_crear_nuevo_proyecto') }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--=====================================
    MODAL CLIENTE
    ======================================-->
    <show-customer-component :idCustomerProject = "idCustomer"></show-customer-component>
    <!--=====================================
    MODAL BRIEF
    ======================================-->
    <vs-popup @update:active="closeModalBrief" @dataBrief="validateBriefModal" fullscreen class="holamundo"
              :title="brief.title[language]"
              :active.sync="popupBriefActivo">
      <div class="row pt-1 pr-md-4 pl-md-4 pr-lg-4 pl-lg-4">
        <div class="col-12">
          <brief-software :brief="brief"></brief-software>
        </div>
      </div>
    </vs-popup>


    <!--=====================================
    MODAL MÁS INFORMACIÓN DE PROYECTO
    ======================================-->
    <vs-popup class="holamundo" :title="infoTypeProjectShowModal.name[language]"
              :active.sync="popupMoreInfoProjectActivo">
      <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
        fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
        deserunt mollit anim id est laborum.

      </p>
      <hr>
      <p>{{ $t('frontend.register-client.equipo_encardo') }}</p>
      <div>
        <div class="avatar-group">
          <div v-for="team in infoTypeProjectShowModal.team" :key="team.id" data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="team.id" class="avatar pull-up">
            <img :src="team.user.picture" alt="Avatar" width="33" height="33"/>
          </div>

        </div>
      </div>

    </vs-popup>
  </div>
</template>

<script>
import InfoCard from 'vue-info-card';
import Multiselect from "vue-multiselect";
import {Splide, SplideSlide} from '@splidejs/vue-splide';
import '@splidejs/splide/dist/css/themes/splide-default.min.css';

export default {
  name: "CardProject",
  components: {
    InfoCard,
    Splide,
    Multiselect,
    SplideSlide,
  },
  data() {
    return {
      popupMoreInfoProjectActivo: false,
      popupBriefActivo: false,
      nameProject: '',
      valuetoassignProject: null,
      iCount: null,
      observationProject: '',
      briefCheck: false,
      briefICheck: false,
      textBriefCheck: false,
      textBriefIcheck: false,
      classBorderCheckBrief: false,
      classBorderICheckBrief: false,
      modelCustomer: null,
      idCustomer: null,
      brief: {
        title: {
          en: '',
          es: ''
        },
        note: {
          en: null,
          es: null
        },
        question: [
          {
            model: null,
            pathsRecording: []
          }
        ]
      },
      errors: {},
      infoTypeProjectShowModal: {
        name: {
          es: null,
          en: null
        },
        description: {
          es: null,
          en: null
        },
      },
      colorLoading: '#161d31',

      options: {
        gap: '1rem',
        focus: 'center',
        perPage: 2,
        accessibility: true,
        pagination: false,
        trimSpace: false,
        breakpoints: {
          height: '6rem',
        }
      },

      optionsCategoriesProjectCards: {
        gap: '1rem',
        focus: 'center',
        perPage: 2,
        accessibility: true,
        pagination: false,
        trimSpace: false,
        breakpoints: {
          height: '6rem',
        }
      },

      language: window.lang, //Idioma actual de la aplicación
      colorCardLoading: window.cardsLoadingColor, //color de las tarjetas cargando segun el tema
      skeletonValue: 1,
      theme: window.themeSession,
      selectProjectType: {
        brief: {
          id: null,
          title: {
            en: null,
            es: null
          },
          question: {
            id: null,
            model: null,
          }
        },
        created_at: null,
        description: {
          es: null,
          en: null
        },
        id: null,
        name: {
          es: null,
          en: null
        },
        picture: null,
        updated_at: null
      },
      listCategoriesProject: [],
      optionsTypeProject: [], //Arreglo con los tipos de proyectos
      optionsCategoriesProject: [], //Arreglo con las categorias de proyectos
      optionToAssingProject: [],
      optionCustomers: [],

    }
  },

  methods: {
    /*=============================================
         GUARDAR PROYECTO
    =============================================*/
    saveNewProject() {
      this.iCount = 0;
      if (this.brief.question) {
        this.brief.question.forEach(obj => {
          if (obj.model && obj.model !== '' || obj.pathsRecording.length > 0) {
            this.iCount++
          }
        })
      }

      if (this.iCount == 0) {
        this.$toast.error({
          title: 'Error',
          message: `${this.$t('frontend.register-client.titulo_error_no_hay_brief')}`,
          showDuration: 1000,
          hideDuration: 6000,
          position: 'top right',
        })
        this.briefCheck = false;
        this.classBorderCheckBrief = false
        this.textBriefIcheck = true
        this.textBriefCheck = false
        this.briefICheck = true
        this.classBorderICheckBrief = true

      }
      eventBus.$emit("validarFormulario");
      setTimeout(() => {
        let resp = this;
        /***  VALIDANDO LOS ERRORES Y MOSTRANDO UNA ALERTA  ***/
        if (document.querySelectorAll(".is-invalid").length > 0) {
          this.$toast.error({
            title: 'Error',
            message: this.$t('backend.customer.create-customers.error_llenar_todos_campos'),
            showDuration: 1000,
            hideDuration: 6000,
            position: 'top right',
          })
          return;
        }
      }, 200)
      if (this.optionToAssingProject.length < 0) {
        if (this.valuetoassignProject === null) {
          return
        }
      }
      if (this.iCount == 0 || !this.nameProject) {
        return
      } else {
        /*=============================================
            ENVIAR DATOS AL SERVIDOR
        =============================================*/
        let resp = this;
        const data = new FormData();
        data.append('nameProject', this.nameProject);
        if (this.$gate.allow('addCustomerProject', 'project')){
          data.append('idCustomer', this.modelCustomer.id);
          data.append('idTypeCustomer', this.modelCustomer.type_customer.id);
          data.append('idManager', this.modelCustomer.id_manager);
          data.append('customerEmail', this.modelCustomer.email);
          data.append('customerName', this.modelCustomer.name);
          data.append('customerPicture', this.modelCustomer.picture);
        }

        data.append('typeProject', JSON.stringify(this.selectProjectType));
        data.append('categoriesProject', JSON.stringify(this.listCategoriesProject));
        data.append('briefProject', JSON.stringify(this.selectProjectType.brief.question));
        data.append('observationsProject', this.observationProject);
        data.append('toAssingCompany', JSON.stringify(this.valuetoassignProject))
        Swal.fire({
          title: this.$t('frontend.projects.new-project.confimar_registro_alerta_title'),
          text: this.$t('frontend.projects.new-project.confimar_registro_alerta_mensaje'),
          confirmButtonColor: "#F05E7D",
          cancelButtonColor: "#79ebdf",
          confirmButtonText: this.$t('frontend.projects.new-project.confimar_registro_alerta_aceptar'),
          cancelButtonText: this.$t('frontend.projects.new-project.confimar_registro_alerta_cancelar'),
          customClass: "swal-confirmation",
          showCancelButton: true,
          reverseButtons: true,
          allowOutsideClick: false,
        }).then(result => {
          if (result.value) {
            resp.$vs.loading({
              color: resp.colorLoading,
              text: this.$t('frontend.projects.new-project.titulo_loading_creando_empresa')
            })
            axios.post('/api/create-new-project', data).then(resp => {
              this.$vs.loading.close()
              this.$toast.success({
                title: this.$t('frontend.projects.new-project.title_muy_bien_toast'),
                message: this.$t('frontend.projects.new-project.title_mensaje_success_toast_register'),
                showDuration: 1000,
                hideDuration: 5000,
                position: 'top right',
              })
              // window.location = '/' + this.language + "/projects";
            }).catch(err => {
              this.$toast.error({
                title: this.$t('frontend.projects.new-project.title_atención_toast'),
                message: err,
                showDuration: 1000,
                hideDuration: 8000,

              })
              resp.$vs.loading.close()
            });
          }
        })
      }
    },
    /*=============================================
         SELECCIONA EL TIPO DE PROYECTO
    =============================================*/
    typeProjectSelected(typeProject) {
      this.iCount = null;
      this.brief.question = null
      this.briefCheck = false;
      this.classBorderCheckBrief = false
      this.textBriefIcheck = false
      this.textBriefCheck = false
      this.briefICheck = false
      this.classBorderICheckBrief = false
      this.textBriefIcheck = false
      this.$vs.loading({
        color: this.colorLoading,
        text: `${this.$t('loading_modal')}`
      })
      this.listCategoriesProject = [];
      this.selectProjectType = typeProject;
      //Enviamos el tipo del projecto al componente padre
      this.getCategoriesProjects(typeProject.id)
      this.$tours['myTour'].finish()

    },
    /*=============================================
         SELECCIONA EL TIPO DE CATEGORIA Y LO AGREGA UN ARRAY
    =============================================*/
    categoriesProjectSelected(categoriesProject) {
      if (this.listCategoriesProject.length == 0) {
        this.listCategoriesProject.push(categoriesProject);
        this.eventSelectScroll("#section-tags-categories-project");
        // this.fourthSeccion = true;
        // this.openNotification('Datos complementarios de la campaña', true);
        return;
      }
      let add = 0;
      for (let item of this.listCategoriesProject) {
        if (parseInt(item.id) == parseInt(categoriesProject.id)) add++;
      }
      if (add == 0) {
        this.listCategoriesProject.push(categoriesProject);
        this.eventSelectScroll("#section-tags-categories-project");
      } else {
        let index = this.listCategoriesProject.indexOf(categoriesProject);
        if (index != -1) this.listCategoriesProject.splice(index, 1);
      }
    },
    /*=============================================
         SELECCIONA LAS CATEGORIAS Y LAS MUESTRA COMO ACTIVAS
    =============================================*/
    selectedCategoriesProjectActive(categoriesProject) {
      if (this.listCategoriesProject.length == 0) return false;
      for (let item of this.listCategoriesProject) {
        if (parseInt(item.id) == parseInt(categoriesProject.id)) {
          return true;
        }
      }
      return false;
    },
    /*=============================================
         REMOVER CATEGORÍAS EN LOS TAGS
    =============================================*/
    removeTagsCategoriesProject(categoriesProject) {
      this.listCategoriesProject.splice(this.listCategoriesProject.indexOf(categoriesProject), 1)
    },

    /*=============================================
         ABRIR MODAL PARA MOSTRAR MÁS INFORMACIÓN EN LOS TIPOS DE PROYECTOS
    =============================================*/
    moreInformationProject(typeProject) {
      this.popupMoreInfoProjectActivo = true;
      this.infoTypeProjectShowModal = Object.assign({}, typeProject)
      console.log(this.infoTypeProjectShowModal)

    },

    /*=============================================
         ABRIR MODAL PARA EL BRIEF
    =============================================*/
    modalBrief() {
      this.brief = this.selectProjectType.brief
      if (this.brief.question.length > 0) {
        this.popupBriefActivo = true;
      } else {
        this.$vs.loading.close()
        this.$toast.error({
          title: `${this.$t('frontend.brief.lo_sentimos')}`,
          message: `${this.$t('frontend.brief.err_no_brief')}`,
          showDuration: 1000,
          hideDuration: 8000,
          position: 'top right',
        })
        this.brief = {
          title: {
            en: '',
            es: ''
          },
          note: {
            en: null,
            es: null
          },
        }

      }

    },

    openModalCustomer(){
      this.idCustomer = this.modelCustomer
    },

    changeTypeCustomer(customer){
      this.modelCustomer = customer
    },

    /*=============================================
         TRAE TODOS LOS TIPOS DE PROYECTOS
    =============================================*/
    getTypeProjects() {
      axios.get('/api/get-type-projects').then(resp => {
        setTimeout(() => {
          this.skeletonValue = 0
        }, 2000)
        this.optionsTypeProject = resp.data.data
      }).catch(err => {

      })
    },
    /*=============================================
         TRAE TODAS LAS CATEGORIAS POR TIPO DE PROYECTO
    =============================================*/
    getCategoriesProjects(id) {
      axios.get('/api/get-categories-projects/' + id).then(resp => {
        this.optionsCategoriesProject = resp.data.data
        this.eventSelectScroll('#section-projects-categories')
        this.$vs.loading.close()
      }).catch(err => {

      })
    },

      getDataCustomer(){
        axios.get('/api/get-data-customer').then(resp =>{
            this.optionCustomers = resp.data.data
        }).catch(err =>{
          this.$toast.error({
            title: 'Error',
            message: 'Error al cargar la información',
            showDuration: 1000,
            hideDuration: 6000,
            position: 'top right',
          })
        })
      },
    /*=============================================
         EVENTO QUE PERMITE HACER SCROLL
    =============================================*/
    eventSelectScroll(option) {
      const options = {
        container: "body",
        easing: "linear"
      };
      setTimeout(() => {
        this.$scrollTo(option, 1000, options);
      }, 100);
    },
    validateBriefModal() {

    },
    closeModalBrief() {
      let i = 0;
      this.brief.question.forEach(obj => {
        if (obj.model && obj.model !== '' || obj.pathsRecording.length > 0) {
          i++
        }
      })
      if (i == 0) {
        this.$toast.error({
          title: 'Error',
          message: `${this.$t('frontend.register-client.titulo_error_no_hay_brief')}`,
          showDuration: 1000,
          hideDuration: 6000,
          position: 'top right',
        })
        this.briefCheck = false;
        this.classBorderCheckBrief = false
        this.textBriefIcheck = true
        this.textBriefCheck = false
        this.briefICheck = true
        this.classBorderICheckBrief = true
      } else {
        this.textBriefIcheck = false
        this.textBriefCheck = true
        this.briefICheck = false
        this.classBorderICheckBrief = false
        this.briefCheck = true;
        this.classBorderCheckBrief = true
        this.$toast.success({
          title: 'Ok',
          message: `${this.$t('frontend.register-client.titulo_success_se_agrego_brief')}`,
          showDuration: 1000,
          hideDuration: 6000,
          position: 'top right',
        })
      }
    },
    getHasCompanies() {
      axios.get('/api/get-companies-customer')
        .then(resp => {
          this.optionToAssingProject = resp.data.data
        }).catch(err => {

      })
    }
  },

  mounted() {
    this.getHasCompanies();
    this.getTypeProjects();
    this.getDataCustomer();
  },

}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
@media (max-width: 1024px)  and (min-width: 320px) {

  .section-categories-project-mobile {
    display: block !important;
  }

  .section-categories-project-desktop {
    display: none !important;
  }

  .row-cards-mobile-register-project {
    display: block !important;
  }

  .row-cards-desktop-register-project {
    display: none;
  }
}

.card-container {
  perspective: 700px;
}

.card-flip, .card-container {
  transform-style: preserve-3d;
  transition: all 0.7s ease;
}

.card-flip div {
  backface-visibility: hidden;
  transform-style: preserve-3d;
}

.card-container:hover .card-flip, .active .card-flip {
  transform: rotateY(180deg);
}

.card-flip {
  display: grid;
  grid-template: 1fr / 1fr;
  grid-template-areas: "frontAndBack";
  transform-style: preserve-3d;
  transition: all 0.7s ease;
}

.front {
  grid-area: frontAndBack;
}

.back {
  grid-area: frontAndBack;
  transform: rotateY(-180deg);
}

.front .title.grey-background {
  display: none !important;
}

.back .title.grey-background {
  display: none !important;
}

.badge.icon-check-icheck-brief {
  background-color: rgba(240, 94, 125, 0.12) !important;
  color: #F05E7D !important;
}

.badge.icon-check-success-brief {
  background-color: rgba(121, 235, 223, 0.12) !important;
  color: #79ebdf !important;
}

.card-header.succes-brief {
  border-color: #79ebdf !important;

}

.card-header.icheck-brief {
  border-color: #F05E7D !important;

}

.multiselect__tag {
  background: #F05E7D !important;
}

.multiselect__tag-icon:focus, .multiselect__tag-icon:hover {
  background: #283046 !important;
}

.multiselect__option--highlight {
  background: #F05E7D !important;
}
</style>
