<template>
  <div>
    <input type="hidden" @click="openModalAddTypeProject" id="openModalAddTypeProject"/>
    <!--=====================================
		  MODAL INFOMRACIÓN DEL TIPO DE PROYECTO
    ======================================-->
    <vs-popup class="holamundo" title="Nuevo tipo de proyecto" :fullscreen="true"
              :active.sync="popupActiveAddTypeProject">
      <div class="pr-3 pl-3">
        <div class="row">
          <div class="col-12 col-md-6 col-lg-6 pb-2 border">
            <p class="pt-2">Titulo en Español:</p>
            <!--=====================================
             INPUT TITULO EN ESPAÑOL
         ======================================-->
            <input-form
              id="txtTitleTypeProject"
              label="Ingresa un titulo es español para el tipo de proyecto"
              pattern="alf"
              errorMsg="Ingrese un titulo válido"
              requiredMsg="El titulo en español es obligatorio"
              :modelo.sync="titleEs"
              :required="true"
              :msgServer.sync="errors.titleEs"
            ></input-form>
            <!--=====================================
              DECRIPCION EN ESPAÑOL
          ======================================-->
            <p>Descripción en Español:</p>
            <input-form
              type="textarea"
              label="Ingrese la descripción en español para el tipo de proyecto"
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
          </div>
          <div class="col-12 col-md-6 col-lg-6 border">
            <p class="pt-2">Titulo en Ingles:</p>
            <!--=====================================
             INPUT TITULO EN ESPAÑOL
         ======================================-->
            <input-form id="txtTitleTypeProject"
                        label="Ingresa un titulo en ingles para el tipo proyecto"
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
            <input-form
              type="textarea"
              label="Ingrese la descripción en ingles para el tipo proyecto"
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
        </div>
        <div class="row">
          <div class="col-12">
            <h6 class="pb-1">Imagen del proyecto:</h6>
            <vue-dropzone class="imageDropzoneUploadProject dropzone upload-logo dropzone-area dz-clickable"
                          ref="myVueDropzone" id="dropzoneUploadImageTypeProject" :options="dropzoneOptions"
                          @vdropzone-removed-file="removedImage"
                          @vdropzone-success="addUploadImageTypeProject"
                          @vdropzone-error="dropzoneError"
                          @vdropzone-max-files-exceeded="deleteArchive"
            >
            </vue-dropzone>
            <h6 class="pt-2">Equipo de trabajo:</h6>
            <input-form
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
            <div class="centerx" v-if="team">
              <vs-chip class="mb-1" v-for="team in team" :key="team.id">
                <vs-avatar size="large" :src="team.user.picture"/>
                {{ team.user.name }} {{ team.user.last_name }}
              </vs-chip>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="d-flex align-items-center float-right">
            <a type="button" class="float-right btn btn-primary waves-effect waves-float waves-light">Crear Tipo
              Proyecto</a>
          </div>
        </div>
      </div>
    </vs-popup>
  </div>
</template>

<script>
import vue2Dropzone from 'vue2-dropzone'

export default {
  name: "AddNewTypeProject",
  components: {
    vueDropzone: vue2Dropzone
  },
  data() {
    return {
      csrf_token: window.token,
      popupActiveAddTypeProject: false,
      titleEs: '',
      titleEn: '',
      descriptionEs: '',
      descriptionEn: '',
      urlImagenProject: null,
      errors: {},

      team: [],
      optionsTeam: [],

      dropzoneOptions: {
        url: '/api/upload-type-image-project',
        thumbnailWidth: 150,
        paramName: 'image',
        acceptedFiles: "image/*",
        dictDefaultMessage: 'Clic aquí o arrastra una imagen',
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
    addTagPositionTeam(newTag) {
      const tag = {
        name: newTag,
        code: newTag.substring(0, 2) + Math.floor(Math.random() * 10000000)
      };
      this.options.push(tag);
      this.value.push(tag);
    },

    openModalAddTypeProject(e) {
      e.preventDefault();
      this.popupActiveAddTypeProject = true
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

    deleteArchive(file) {
      this.$refs.myVueDropzone.removeFile(file)
    }

  },
  mounted() {
    this.getTeam()
  }
}
</script>

<style scoped>

</style>
