<style lang="scss">
  @import '../scss/icons';
</style>

<template>
  <icon-button name="save" class="ar-icon ar-icon__xs ar-icon--no-border" @click.native="upload"/>
</template>

<script>
  import IconButton from './icon-button'
  import UploaderPropsMixin from '../mixins/uploader-props'

  export default {
    mixins: [UploaderPropsMixin],
    props: {
      record: { type: Object },
      pathValidation:
        {
          id:null
        }
    },
    components: {
      IconButton
    },
    methods: {
      upload () {
        if (!this.record.url) {
          return
        }

        if (this.pathValidation){
          if (this.pathValidation.id == this.record.id){
            alert('Nota voz ya guardada');
            return;
          }
        }

        const data = new FormData()
        data.append('audio', this.record.blob, `${this.filename}.mp3`)
        data.append('id', this.record.id)
        data.append('fileName',  this.filename)

        const headers = Object.assign(this.headers, {})
        headers['Content-Type'] = `multipart/form-data; boundary=${data._boundary}`
        Swal.fire({
          title: this.$t('frontend.brief.confimar_registro_alerta_title'),
          text: this.$t('frontend.brief.confimar_registro_alerta_mensaje_guardar_grabacion'),
          confirmButtonColor: "#F05E7D",
          cancelButtonColor: "#79ebdf",
          confirmButtonText: this.$t('frontend.brief.confimar_registro_alerta_aceptar'),
          cancelButtonText: this.$t('frontend.brief.confimar_registro_alerta_cancelar'),
          customClass: "swal-confirmation",
          showCancelButton: true,
          reverseButtons: true,
          allowOutsideClick: false,
        }).then(result => {
          if (result.value) {
            this.$eventBus.$emit('start-upload')
            axios.post(this.uploadUrl, data, {headers: headers}).then(resp => {
              this.$eventBus.$emit('end-upload', {status: 'success', response: resp})
              this.$toast.success({
                title: this.$t('frontend.brief.title_muy_bien_toast'),
                message: this.$t('frontend.brief.title_mensaje_success_toast_grabacion_guardada'),
                showDuration: 1000,
                hideDuration: 5000,
                position: 'top right',
              })
            }).catch(error => {
              this.$eventBus.$emit('end-upload', {status: 'fail', response: error})
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
      }
    }
  }
</script>
