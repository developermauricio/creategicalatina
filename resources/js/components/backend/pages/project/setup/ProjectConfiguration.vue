<template>
  <div class="pt-2">
    <!--=====================================
		  TARJETAS DE PROYECTOS
    ======================================-->
    <div class="row">
      <div class="col-md-3 col-lg-3 col-6" v-for="project in dataTypeProject" :key="project.id">
        <div class="card">
          <img @click="openModalSetup(project.id)" style="cursor: pointer" class="card-img-top pt-4 pl-4 pr-4"
               :src="project.picture" alt="Card image cap">
          <div class="card-body">
            <h4 @click="openModalSetup(project.id)" style="cursor:pointer;" class="card-title">{{
                project.name[language]
              }}</h4>
            <a @click="openModalSetup(project.id)" href="javascript:void(0)" class="card-link">Más info</a>
            <p class="card-text">
              <small class="text-muted">Última actualización
                {{ moment(project.updated_at).locale(language).format('MMMM Do YYYY') }}</small>
            </p>
          </div>
        </div>
      </div>
    </div>

    <!--=====================================
		  MODAL INFOMRACIÓN DEL TIPO DE PROYECTO
    ======================================-->
    <vs-popup class="holamundo" :title="title[language]" :fullscreen="true" :active.sync="popupActiveSetup">
      <div class="pr-3 pl-3">
        <div class="row">
          <div class="col-12 pb-2">
<!--            <div class="p">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate laborum reprehenderit-->
<!--              veniam voluptates. Eligendi exercitationem expedita magni quis sint! At, consequuntur dolores hic pariatur-->
<!--              quia reiciendis temporibus? Quam, quasi, recusandae.-->
<!--            </div>-->
          </div>
        </div>
        <div class="row">
          <!--=====================================
              INFORMACIÓN EN ESPAÑOL
          ======================================-->
          <div class="col-12 col-md-6 col-lg-6 p-2 border">
            <p>Titulo en Español:
              <span @click="editEs === false ? editEsF() : saveTypeProject()" class="float-right"
                    style="cursor: pointer">
              <vs-tooltip :text="editEs === true ? 'Guardar cambios': 'Editar Información'" size="75px">
                <vs-icon :color="editEs === true ? '#28c76f': ''" :icon="iconEditTitleEs"></vs-icon>
              </vs-tooltip>
            </span>
              <span @click="cancelEditEs()" v-if="editEs === true" class="float-right pr-1" style="cursor: pointer">
              <vs-tooltip text="Cancelar" size="75px">
                <vs-icon color="#ea5455" icon="cancel"></vs-icon>
              </vs-tooltip>
            </span>
            </p>
            <h4 v-if="editTitleEs === false">{{ titleEs }}</h4>
            <!--=====================================
              INPUT TITULO EN ESPAÑOL
          ======================================-->
            <input-form v-else
                        @keyup.enter="saveTypeProject()"
                        id="txtTitleTypeProject"
                        label="Ingresa un titulo es español para el proyecto"
                        pattern="alf"
                        errorMsg="Ingrese un titulo válido"
                        requiredMsg="El titulo en español es obligatorio"
                        :modelo.sync="titleEs"
                        :required="true"
                        :msgServer.sync="errors.titleEs"
            ></input-form>
            <hr>

            <!--=====================================
              DECRIPCION EN ESPAÑOL
          ======================================-->
            <p>Descripción en Español:</p>
            <p v-if="editDescriptionEs === false">{{ descriptionEs }}</p>
            <input-form
              v-else
              type="textarea"
              label="Ingrese la descripción en español para el proyecto"
              id="txtDescriptionTypeProjectEs"
              pattern="all"
              errorMsg="Ingrese información válida"
              requiredMsg="Este campo es requerido"
              :required="false"
              :modelo.sync="descriptionEs"
              :msgServer.sync="errors.descriptionEs"
              :options="{
                                                rows: 7
                                                }"
            ></input-form>
            <hr>
            <!--=====================================
              INFORMACIÓN EN INGLES
          ======================================-->
            <p>Titulo en Ingles:
              <span @click="editEn === false ? editEnF() : saveTypeProject()" class="float-right"
                    style="cursor: pointer">
              <vs-tooltip :text="editEn === true ? 'Guardar cambios': 'Editar Información'" size="75px">
                <vs-icon :color="editEn === true ? '#28c76f': ''" :icon="iconEditTitleEn"></vs-icon>
              </vs-tooltip>
            </span>
              <span @click="cancelEditEn()" v-if="editEn === true" class="float-right pr-1" style="cursor: pointer">
              <vs-tooltip text="Cancelar" size="75px">
                <vs-icon color="#ea5455" icon="cancel"></vs-icon>
              </vs-tooltip>
            </span>
            </p>
            <h4 v-if="editTitleEn === false">{{ titleEn }}</h4>
            <!--=====================================
             INPUT TITULO EN ESPAÑOL
         ======================================-->
            <input-form v-else
                        @keyup.enter="saveTypeProject()"
                        id="txtTitleTypeProject"
                        label="Ingresa un titulo en ingles para el proyecto"
                        pattern="alf"
                        errorMsg="Ingrese un titulo válido"
                        requiredMsg="El titulo en ingles es obligatorio"
                        :modelo.sync="titleEn"
                        :required="true"
                        :msgServer.sync="errors.titleEn"
            ></input-form>
            <hr>

            <!--=====================================
              DECRIPCION EN INGLES
          ======================================-->
            <p>Descripción en Ingles:</p>
            <p v-if="editDescriptionEn === false">{{ descriptionEn }}</p>
            <input-form
              v-else
              type="textarea"
              label="Ingrese la descripción en ingles para el proyecto"
              id="txtDescriptionTypeProjectEs"
              pattern="all"
              errorMsg="Ingrese información válida"
              requiredMsg="Este campo es requerido"
              :required="false"
              :modelo.sync="descriptionEn"
              :msgServer.sync="errors.descriptionEn"
              :options="{
                                                rows: 7
                                                }"
            ></input-form>
          </div>
          <!--=====================================
              IMAGEN Y EQUIPO DE TRABAJO
          ======================================-->
          <div class="col-12 col-md-6 col-lg-6 p-2">
            <h6 class="pb-1">Imagen del proyecto:
            </h6>
            <!--=====================================
              IMAGEN
            ======================================-->

            <!--=====================================
              SUBIR IMAGEN
          ======================================-->
            <div v-if="popupActiveSetup && showDropzone">
              <vue-dropzone class="imageDropzoneUploadProject dropzone upload-logo dropzone-area dz-clickable"
                            ref="myVueDropzone" id="dropzoneUploadImageTypeProject" :options="dropzoneOptions"
                            :useCustomSlot=true
                            @vdropzone-complete="uploadCompleted"
                            @vdropzone-removed-file="removedImage"
                            @vdropzone-success="addUploadImageTypeProject"
                            @vdropzone-error="dropzoneError"
                            @vdropzone-max-files-exceeded="deleteArchive"

              >
                <div id="sectionImagenProject" class="meetup-img-wrapper rounded-top text-center">
                  <img :src="picture" alt="picture project" width="300" style="width: 70%;">
                  <h5 class="text-center mt-1">Para actualizar, clic aquí o arrastra una imagen</h5>
                </div>
              </vue-dropzone>
              <button id="btnSaveImageProject" style="display: none; margin: auto; margin-top: -3rem;"
                      @click="saveImageProject()" type="button" class="btn btn-flat-success text-center waves-effect">
                Guardar Imagen
              </button>
            </div>
            <div v-if="popupActiveSetup && showSectionTeam">
              <h6 class="pb-1 pt-2">Equipo de trabajo:
                <span @click="editTeam === false ? editTeamF() : saveEditTeam()" class="float-right pr-1"
                      style="cursor: pointer">
                              <vs-tooltip :text="editTeam === false ? 'Editar equipo de trabajo' : 'Guardar Cambios'"
                                          size="75px">
                                <vs-icon :color="editTeam === false ? '': '#28c76f'"
                                         :icon="editTeam === false ? 'mode_edit': 'check_circle'"></vs-icon>
                              </vs-tooltip>
              </span>
                <span @click="cancelEditTeam()" v-if="editTeam === true" class="float-right pr-1"
                      style="cursor: pointer">
              <vs-tooltip text="Cancelar" size="75px">
                <vs-icon color="#ea5455" icon="cancel"></vs-icon>
              </vs-tooltip>
            </span>
              </h6>

              <input-form
                v-if="editTeam === true"
                label="Agregar a uno o varios miembros del equipo"
                id="txtPositionWorkTeam"
                :requiredMsg="$t('backend.team.create-teams.titulo_debes_seleccionar_uno_varios_cargos')"
                :required="true"
                :modelo.sync="team"
                :msgServer.sync="errors.team"
                type="multiselect"
                selectLabel=""
                :multiselect="{ 'tag-placeholder' : '',
                                          // selectLabel   : $t('company.multiselect.select'),
                                          // selectedLabel : $t('company.multiselect.selected'),
                                          // deselectLabel : $t('company.multiselect.remove'),
                                          placeholder : $t('backend.team.create-teams.titulo_buscar_seleccionar_cargo'),
                                          label : 'name',
                                          'track-by' : 'id',
                                          options : optionsTeam,
                                          multiple : true,
                                          taggable : true,
                                          'custom-label': team => team.user.name +' '+team.user.last_name
                                        }"
                @tag="addTagPositionTeam"
              ></input-form>

              <div class="centerx">
                <vs-chip class="mb-1" v-for="team in team" :key="team.id">
                  <vs-avatar size="large" :src="team.user.picture"/>
                  {{ team.user.name }} {{ team.user.last_name }}
                </vs-chip>
              </div>
            </div>
          </div>
        </div>
      </div>
    </vs-popup>
  </div>
</template>

<script>
import moment from "moment";
import vue2Dropzone from 'vue2-dropzone'

require("moment/min/locales.min");
export default {
  name: "ProjectConfiguration",
  components: {
    vueDropzone: vue2Dropzone
  },
  data() {
    return {
      dataTypeProject: null,
      language: window.lang,
      moment: moment,
      popupActiveSetup: false,
      showDropzone: true,
      showSectionTeam: true,

      editTitleEs: false,
      editTitleEn: false,
      editDescriptionEs: false,
      editDescriptionEn: false,
      iconEditTitleEs: 'mode_edit',
      iconEditDescriptionE: 'mode_edit',
      iconEditTitleEn: 'mode_edit',
      iconEditDescriptionEn: 'mode_edit',

      editEs: false,
      editEn: false,
      editTeam: false,

      idTypeProject: null,
      title: '',
      titleEs: '',
      titleEn: '',
      descriptionEs: null,
      descriptionEn: null,
      picture: null,
      urlImagenProject: null,
      team: [],
      optionsTeam: [],

      errors: {},
      csrf_token: window.token,

      dropzoneOptions: {
        url: '/api/upload-type-image-project',
        thumbnailWidth: 150,
        paramName: 'image',
        acceptedFiles: "image/*",
        dictFileTooBig: this.$t('backend.customer.create-customers.msg_uno_el_archivo_demasiado') + " ({{filesize}}MiB). " + this.$t('backend.customer.create-customers.msg_dos_tamaño_maximo') + " {{maxFilesize}}MiB.",
        dictRemoveFile: this.$t('backend.customer.create-customers.msg_tres_remover_archivo'),
        dictMaxFilesExceeded: 'Solo se permite subir una imagen.',
        maxFilesize: 5,
        maxFiles: 1,
        addRemoveLinks: true,
        headers: {
          'X-CSRF-TOKEN': this.csrf_token //Este token lo pasamos por los props
        },
      }

    }
  },
  methods: {
    deleteArchive(file){
      this.$refs.myVueDropzone.removeFile(file)
    },
    saveEditTeam() {
      const data = new FormData();
      data.append("team", JSON.stringify(this.team));
      data.append("typeProject", this.idTypeProject);

      Swal.fire({
        title: 'Confirmar',
        text: '¿Esta seguro de actualizar?',
        confirmButtonColor: "#F05E7D",
        cancelButtonColor: "#79ebdf",
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        customClass: "swal-confirmation",
        showCancelButton: true,
        reverseButtons: true,
        allowOutsideClick: false,
      }).then(result => {
        if (result.value) {
          axios.post('/api/save-team-project-type', data).then(resp => {
            this.$toast.success({
              title: 'Correcto',
              message: 'Se actualizó correctamente',
              showDuration: 1000,
              hideDuration: 3000,
              position: 'top right',
            })
            this.openModalSetup(this.idTypeProject)
            this.showSectionTeam = false
            this.cancelEditTeam()
          }).catch(err => {
            this.$toast.error({
              title: this.$t('backend.customer.create-customers.title_error_toast'),
              message: this.$t('backend.customer.create-customers.title_mensaje_error_toast'),
              showDuration: 1000,
              hideDuration: 5000,
              position: 'top right',
            })
          })
        }
      });
    },

    cancelEditTeam() {
      this.editTeam = false
      this.openModalSetup(this.idTypeProject)
    },

    addTagPositionTeam(newTag) {
      const tag = {
        name: newTag,
        code: newTag.substring(0, 2) + Math.floor(Math.random() * 10000000)
      };
      this.options.push(tag);
      this.value.push(tag);
    },

    dropzoneError(file, message, xhr) {
      this.showDropzone = false;
      setTimeout(() => {
        this.showDropzone = true
      }, 200)
      this.$toast.error({
        title: this.$t('backend.customer.create-customers.title_error_toast'),
        message: message,
        showDuration: 1000,
        hideDuration: 8000,
        position: 'top right',
      })
    },

    uploadCompleted() {
      document.getElementById("sectionImagenProject").style.display = "none";
      document.getElementById("btnSaveImageProject").style.display = "block";
    },

    removedImage(file, error, xhr) {
      document.getElementById("sectionImagenProject").style.display = "block";

      const data = new FormData();
      data.append("image", this.urlImagenProject);
      axios.post('/api/removed-image-type-project', data)
        .then(resp => {
          this.$toast.success({
            title: this.$t('backend.customer.create-customers.title_muy_bien_toast'),
            message: this.$t('backend.customer.create-customers.title_mensaje_success_toast_remove_image'),
            showDuration: 1000,
            hideDuration: 5000,
            position: 'top right',
          })
          this.urlImagenProject = null
          document.getElementById("btnSaveImageProject").style.display = "none";
        }).catch(err => {
        this.$toast.error({
          title: this.$t('backend.customer.create-customers.title_error_toast'),
          message: this.$t('backend.customer.create-customers.title_mensaje_error_toast'),
          showDuration: 1000,
          hideDuration: 5000,
          position: 'top right',
        })
      });
    },

    addUploadImageTypeProject(file, response) {
      this.urlImagenProject = response.data

      setTimeout(() => {
        this.$toast.success({
          title: this.$t('backend.customer.create-customers.title_muy_bien_toast'),
          message: this.$t('backend.customer.create-customers.title_mensaje_success_toast_archivo'),
          showDuration: 1000,
          hideDuration: 5000,
          position: 'top right',
        })
      }, 1000);
    },

    /*=============================================
      MÉTODO PARA GUARDAR LA IMAGEN
    =============================================*/
    saveImageProject() {
      const data = new FormData();
      data.append("image", this.urlImagenProject);
      data.append('id', this.idTypeProject);

      Swal.fire({
        title: 'Confirmar',
        text: '¿Esta seguro de actualizar?',
        confirmButtonColor: "#F05E7D",
        cancelButtonColor: "#79ebdf",
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        customClass: "swal-confirmation",
        showCancelButton: true,
        reverseButtons: true,
        allowOutsideClick: false,
      }).then(result => {
        if (result.value) {
          axios.post('/api/save-image-type-project', data).then(resp => {
            this.$toast.success({
              title: 'Correcto',
              message: 'Se actualizó correctamente',
              showDuration: 1000,
              hideDuration: 3000,
              position: 'top right',
            })
            this.showDropzone = false
            this.openModalSetup(this.idTypeProject)
            this.getProjectsType()
          }).catch(err => {
            this.$toast.error({
              title: this.$t('backend.customer.create-customers.title_error_toast'),
              message: this.$t('backend.customer.create-customers.title_mensaje_error_toast'),
              showDuration: 1000,
              hideDuration: 5000,
              position: 'top right',
            })
          })
        }
      });
    },
    /*=============================================
      TRAEMOS TODOS LOS PROYECTOS
    =============================================*/
    getProjectsType() {
      axios.get('/api/get-data-type-project').then(resp => {
        this.dataTypeProject = resp.data.data
      }).catch(err => {

      })
    },

    /*=============================================
      ABRIMOS LA MODAL
    =============================================*/
    openModalSetup(id) {
      this.$vs.loading({
        color: '#3f4f6e',
        text: 'Espere por favor...'
      })

      this.resetEdit()
      this.idTypeProject = id
      axios.get('/api/get-data-type-project-info/' + id).then(resp => {
        this.title = resp.data.data.name
        this.picture = resp.data.data.picture
        this.team = resp.data.data.team
        /*=============================================
          DATOS EN ESPAÑOL
        =============================================*/

        this.titleEs = resp.data.data.name['es']
        this.titleEn = resp.data.data.name['en']
        this.descriptionEs = resp.data.data.description['es']
        this.descriptionEn = resp.data.data.description['en']


        setTimeout(() => {
          this.popupActiveSetup = true
          this.showDropzone = true
          this.showSectionTeam = true
          this.$vs.loading.close()
        }, 200)

      }).catch(err => {

      })
    },
    /*=============================================
      METODO PARA ACTUALIZAR EL TIPO DE PROYECTO
    =============================================*/
    saveTypeProject() {
      eventBus.$emit("validarFormulario");
      setTimeout(() => {
        const data = new FormData()
        data.append('id', this.idTypeProject);
        data.append('titleEs', this.titleEs);
        data.append('titleEn', this.titleEn);
        data.append('descriptionEs', this.descriptionEs);
        data.append('descriptionEn', this.descriptionEn);
        Swal.fire({
          title: 'Confirmar',
          text: '¿Esta seguro de actualizar?',
          confirmButtonColor: "#F05E7D",
          cancelButtonColor: "#79ebdf",
          confirmButtonText: 'Aceptar',
          cancelButtonText: 'Cancelar',
          customClass: "swal-confirmation",
          showCancelButton: true,
          reverseButtons: true,
          allowOutsideClick: false,
        }).then(result => {
          if (result.value) {
            axios.post('/api/save-type-project', data).then(resp => {
              this.$toast.success({
                title: 'Correcto',
                message: 'Se actualizó correctamente',
                showDuration: 1000,
                hideDuration: 3000,
                position: 'top right',
              })
              this.title['es'] = this.titleEs
              this.title['en'] = this.titleEn
              this.resetEdit()
            }).catch(err => {
              alert('ERROR', err)
            })
            // this.editEsF()
          }
        })
      }, 100)

    },

    resetEdit(){

      this.editEs = false
      this.editTitleEs = false
      this.editDescriptionEs = false
      this.editEn = false
      this.editTitleEn = false
      this.editDescriptionEn = false
      this.iconEditTitleEn = 'mode_edit'
      this.iconEditTitleEs = 'mode_edit'
      this.editTeam = false
    },

    getTeam() {
      axios.get('/api/grid-list-team/').then(resp => {
        this.optionsTeam = resp.data.data
      }).catch(err => {
        this.$toast.error({
          title: this.$t('backend.customer.create-customers.title_error_toast'),
          message: this.$t('backend.customer.create-customers.title_mensaje_error_toast'),
          showDuration: 1000,
          hideDuration: 5000,
          position: 'top right',
        })
      });
    },

    /*=============================================
      EDITARL EL TITULO EN ESPAÑOL
    =============================================*/
    editEsF() {
      if (this.editTitleEs) {
        this.editTitleEs = false;
        this.editDescriptionEs = false;
        this.editEs = false;
        this.iconEditTitleEs = 'mode_edit';
      } else {
        this.editTitleEs = true;
        this.editDescriptionEs = true;
        this.editEs = true;
        this.iconEditTitleEs = 'check_circle';
      }
    },

    cancelEditEs() {
      this.editTitleEs = false;
      this.editDescriptionEs = false;
      this.editEs = false;
      this.iconEditTitleEs = 'mode_edit';
    },

    /*=============================================
      EDITARL EL TITULO EN INGLES
    =============================================*/

    editEnF() {
      if (this.editTitleEn) {
        this.editTitleEn = false;
        this.editDescriptionEn = false;
        this.editEn = false;
        this.iconEditTitleEn = 'mode_edit';
      } else {
        this.editTitleEn = true;
        this.editDescriptionEn = true;
        this.editEn = true;
        this.iconEditTitleEn = 'check_circle';
      }
    },

    cancelEditEn() {
      this.editTitleEn = false;
      this.editDescriptionEn = false;
      this.editEn = false;
      this.iconEditTitleEn = 'mode_edit';
    },

    editTeamF() {
      this.editTeam = true;
    }

  },
  mounted() {
    this.getProjectsType()
    this.getTeam()
  }
}
</script>

<style>
.imageDropzoneUploadProject.dropzone {
  text-align: center !important;
}

.imageDropzoneUploadProject.dropzone .dz-message {
  position: relative !important;
}

.imageDropzoneUploadProject.dropzone .dz-message:before {
  display: none !important;
}

.imageDropzoneUploadProject.dropzone .dz-preview .dz-remove {
  margin-top: 2rem !important;
}

.imageDropzoneUploadProject.dropzone .dz-details {
  /*display: none !important;*/
  margin-top: -6rem;
}

.vs-chip--close .icon-scale {
  margin-top: 0.1rem !important;
}
</style>
