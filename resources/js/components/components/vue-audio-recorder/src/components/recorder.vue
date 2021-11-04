<style lang="scss">
.ar {
  width: 420px;
  font-family: 'Roboto', sans-serif;
  border-radius: 16px;
  background-color: #FAFAFA;
  box-shadow: 0 4px 18px 0 rgba(0, 0, 0, 0.17);
  position: relative;
  box-sizing: content-box;

  &-content {
    padding: 16px;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  &-records {
    height: 138px;
    padding-top: 1px;
    overflow-y: auto;
    margin-bottom: 20px;

    &__record {
      width: 320px;
      height: 45px;
      padding: 0 10px;
      margin: 0 auto;
      line-height: 0px;
      display: flex;
      justify-content: space-between;
      border-bottom: 1px solid #E8E8E8;
      position: relative;

      &--selected {
        border: 1px solid #E8E8E8;
        border-radius: 24px;
        background-color: #FFFFFF;
        margin-top: -1px;
        padding: 0 34px;
      }
    }
  }

  &-recorder {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;

    &__duration {
      color: #AEAEAE;
      font-size: 32px;
      font-weight: 500;
      margin-top: 20px;
      margin-bottom: 16px;
    }

    &__stop {
      position: absolute;
      top: 10px;
      right: -52px;
    }

    &__time-limit {
      position: absolute;
      color: #AEAEAE;
      font-size: 12px;
      top: 128px;
    }

    &__records-limit {
      position: absolute;
      color: #AEAEAE;
      font-size: 13px;
      top: 78px;
    }
  }

  &-spinner {
    display: flex;
    height: 30px;
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    margin: auto;
    width: 144px;
    z-index: 10;

    &__dot {
      display: block;
      margin: 0 8px;
      border-radius: 50%;
      width: 30px;
      height: 30px;
      background: #05CBCD;
      animation-name: blink;
      animation-duration: 1.4s;
      animation-iteration-count: infinite;
      animation-fill-mode: both;

      &:nth-child(2) {
        animation-delay: .2s;
      }

      &:nth-child(3) {
        animation-delay: .4s;
      }

      @keyframes blink {
        0% {
          opacity: .2;
        }
        20% {
          opacity: 1;
        }
        100% {
          opacity: .2;
        }
      }
    }
  }

  &__text {
    color: rgba(84, 84, 84, 0.5);
    font-size: 16px;
  }

  &__blur {
    filter: blur(2px);
    opacity: 0.7;
  }

  &__overlay {
    position: absolute;
    width: 100%;
    height: 100%;
    z-index: 10;
  }

  &__upload-status {
    text-align: center;
    font-size: 10px;
    padding: 2px;
    letter-spacing: 1px;
    position: absolute;
    bottom: 0;

    &--success {
      color: green;
    }

    &--fail {
      color: red;
    }
  }

  &__rm {
    cursor: pointer;
    position: absolute;
    width: 6px;
    height: 6px;
    padding: 6px;
    line-height: 6px;
    margin: auto;
    left: 10px;
    bottom: 0;
    top: 0;
    color: rgb(244, 120, 90);
  }

  &__downloader,
  &__uploader {
    position: absolute;
    top: 0;
    bottom: 0;
    margin: auto;
  }

  &__downloader {
    right: 115px;
  }

  &__uploader {
    right: 85px;
  }
}

@import '../scss/icons';
</style>

<template>
  <div class="ar">
    <div class="ar__overlay" v-if="isUploading"></div>
    <div class="ar-spinner" v-if="isUploading">
      <div class="ar-spinner__dot"></div>
      <div class="ar-spinner__dot"></div>
      <div class="ar-spinner__dot"></div>
    </div>

    <div class="ar-content" :class="{'ar__blur': isUploading}">
      <div class="ar-recorder">
        <icon-button
          class="ar-icon ar-icon__lg"
          :name="iconButtonType"
          :class="{
            'ar-icon--rec': isRecording,
            'ar-icon--pulse': isRecording && volume > 0.02
          }"
          @click.native="toggleRecorder"/>
        <icon-button
          class="ar-icon ar-icon__sm ar-recorder__stop"
          name="stop"
          @click.native="stopRecorder"/>
      </div>

      <div class="ar-recorder__records-limit" v-if="attempts">{{ textIntentos }}: {{ attemptsLeft }}/{{ attempts }}
      </div>
      <div class="ar-recorder__duration">{{ recordedTime }}</div>
      <div class="ar-recorder__time-limit" v-if="time">{{ $t('frontend.brief.titulo_grabadora_la_duracion_de_cada_nota')}} {{ time }}m</div>

      <div class="ar-records">

        <div
          class="ar-records__record"
          :class="{'ar-records__record--selected': record.id === selected.id}"
          :key="record.id"
          v-for="(record, idx) in questionRecording.recordQuestion"
          @click="choiceRecord(record)" style="cursor: pointer">
          <div
            class="ar__rm"
            v-if="record.id === selected.id"
            @click="removeRecord(idx)">&times;
          </div>
          <div class="ar__text">{{ $t('frontend.brief.titulo_grabadora_grabacion') }} {{ idx + 1 }} <span style="font-size: 0.82rem; color: #F05E7D !important;"
                                                              v-if="record.id !== selected.id">{{ $t('frontend.brief.titulo_grabadora_clic_escuchar_guardar') }}</span>
          </div>
          <div class="ar__text">{{ record.duration }}</div>

          <downloader
            v-if="record.id === selected.id && showDownloadButton"
            class="ar__downloader"
            :record="record"
            :filename="filename"/>

          <uploader
            v-if="record.id === selected.id && showUploadButton"
            class="ar__uploader"
            :record="record"
            :filename="filename"
            :headers="headers"
            :upload-url="uploadUrl"
            :pathValidation="questionRecording.pathsRecording[idx]"
          />
        </div>
      </div>

      <audio-player :record="selected"/>
    </div>
  </div>
</template>

<script>
import AudioPlayer from './player'
import Downloader from './downloader'
import IconButton from './icon-button'
import Recorder from '../lib/recorder'
import Uploader from './uploader'
import UploaderPropsMixin from '../mixins/uploader-props'
import {convertTimeMMSS} from '../lib/utils'
// import Swal from "sweetalert2";

export default {
  mixins: [UploaderPropsMixin],
  props: {
    modalRecordingValue: false,
    questionRecording: {
      question: {
        es: null,
        en: null
      },
      note: {
        es: null,
        en: null
      },
      pathsRecording: [
        {
          path: null
        }
      ]
    },
    textIntentos: {type: ''},
    attempts: {type: Number},
    time: {type: Number},

    showDownloadButton: {type: Boolean, default: true},
    showUploadButton: {type: Boolean, default: true},

    micFailed: {type: Function},
    beforeRecording: {type: Function},
    pauseRecording: {type: Function},
    afterRecording: {type: Function},
    failedUpload: {type: Function},
    beforeUpload: {type: Function},
    successfulUpload: {type: Function},
    selectRecord: {type: Function}
  },
  data() {
    return {
      isUploading: false,
      recorder: this._initRecorder(),
      recordList: [],
      selected: {},
      uploadStatus: null,
      activeButtonSave: true
    }
  },
  components: {
    AudioPlayer,
    Downloader,
    IconButton,
    Uploader
  },
  created() {
  },
  mounted() {
    this.$eventBus.$on('start-upload', () => {
      this.isUploading = true
      this.beforeUpload && this.beforeUpload('before upload')
    })

    this.$eventBus.$on('end-upload', (msg) => {
      this.isUploading = false
      if (msg.status === 'success') {
        this.questionRecording.pathsRecording.push({'path': msg.response.data.data, 'id': msg.response.data.id})
        this.$emit("pathRecording", this.questionRecording)
        this.successfulUpload && this.successfulUpload(msg.response)
      } else {
        this.failedUpload && this.failedUpload(msg.response)
      }
    })
  },
  beforeDestroy() {
    this.stopRecorder()
    this.$destroy()
  },
  methods: {
    toggleRecorder() {
      if (this.attempts && this.recorder.records.length >= this.attempts) {
        return
      }

      if (!this.isRecording || (this.isRecording && this.isPause)) {
        this.recorder.start()
      } else {
        this.recorder.pause()
      }
    },
    stopRecorder() {
      if (!this.isRecording) {
        return
      }
      this.recorder.stop()
      this.questionRecording.recordQuestion = this.recorder.recordList()
      this.$emit("addRecording", this.questionRecording)
    },
    removeRecord(idx) {
      console.log(this.questionRecording.pathsRecording)
      if (this.questionRecording.pathsRecording[idx]) {
        let currentRecording = this.questionRecording.pathsRecording[idx].path;
        const data = new FormData()
        data.append('path', currentRecording)
        Swal.fire({
          title: this.$t('frontend.brief.confimar_registro_alerta_title'),
          text: this.$t('frontend.brief.confimar_registro_alerta_mensaje'),
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
            axios.post('/api/removed-recording-brief', data)
              .then(resp => {
                this.$toast.success({
                  title: this.$t('frontend.brief.title_muy_bien_toast'),
                  message: this.$t('frontend.brief.title_mensaje_success_toast_grabacion_eliminada'),
                  showDuration: 1000,
                  hideDuration: 5000,
                  position: 'top right',
                })

                this.questionRecording.recordQuestion.splice(idx, 1)
                this.questionRecording.pathsRecording.splice(idx, 1)
                this.recorder.records.splice(idx, 1)
                this.$set(this.selected, 'url', null)
                this.$eventBus.$emit('remove-record')
                this.$emit("removedRecording", this.questionRecording)
              }).catch(err =>{
              this.$toast.error({
                title: this.$t('backend.customer.create-customers.title_error_toast'),
                message: this.$t('backend.customer.create-customers.title_mensaje_error_toast'),
                showDuration: 1000,
                hideDuration: 5000,
                position: 'top right',
              })
            });
          }
        });
      }else{
        this.questionRecording.recordQuestion.splice(idx, 1)
        this.questionRecording.pathsRecording.splice(idx, 1)
        this.recorder.records.splice(idx, 1)
        this.$set(this.selected, 'url', null)
        this.$eventBus.$emit('remove-record')
      }


    },
    choiceRecord(record) {
      if (this.selected === record) {
        return
      }
      this.selected = record
      this.selectRecord && this.selectRecord(record)
    },
    _initRecorder() {
      return new Recorder({
        beforeRecording: this.beforeRecording,
        afterRecording: this.afterRecording,
        pauseRecording: this.pauseRecording,
        micFailed: this.micFailed
      })
    }
  },
  computed: {
    attemptsLeft() {
      return this.attempts - this.questionRecording.recordQuestion.length
    },
    iconButtonType() {
      return this.isRecording && this.isPause ? 'mic' : this.isRecording ? 'pause' : 'mic'
    },
    isPause() {
      return this.recorder.isPause
    },
    isRecording() {
      return this.recorder.isRecording
    },
    recordedTime() {
      if (this.time && this.recorder.duration >= this.time * 60) {
        this.stopRecorder()
      }
      return convertTimeMMSS(this.recorder.duration)
    },
    volume() {
      return parseFloat(this.recorder.volume)
    }
  },

  watch: {
    modalRecordingValue: function (val) {
      if (val) {

        if (this.questionRecording.recordQuestion.length > 0) {
          this.questionRecording.recordQuestion.forEach(record => {
            this.recorder.records.push(record);
          });
        }
      } else {
        this.recorder = this._initRecorder()
      }
    },
  }
}
</script>

