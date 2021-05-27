<template>
    <div class="row pt-2">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="body">
                    <form class="pt-2 pr-4 pl-4 pb-4" method="post">
                        <form-wizard
                            color="#F05E7D"
                            subtitle
                            title
                            finishButtonText="Crear Cliente"
                            nextButtonText="Siguiente"
                            backButtonText="Atrás"
                            shape="tab"
                            error-color="#ff4949"
                            @on-change="cambioPagina"
                            @on-complete="createNewTeam()"
                            ref="wizard"
                        >
                            <!------------------------------
                              TAB DATOS DEL MIEMBRO
                            -------------------------------->
                            <tab-content
                                :title="$t('backend.team.create-teams.titulo_wizard_datos_miembro')"
                                :beforeChange="validarTab"
                            >
                                <section style="width: 100%">
                                    <div class="row">
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <input-form
                                                id="txtNameUserTeam"
                                                :label="$t('backend.customer.create-customers.titulo_nombre_cliente')"
                                                pattern="alf"
                                                :errorMsg="$t('backend.customer.create-customers.titulo_error_nombre_cliente')"
                                                :requiredMsg="$t('backend.customer.create-customers.titulo_obligatrio_nombre_cliente')"
                                                :modelo.sync="userName"
                                                :required="true"
                                                :msgServer.sync="errors.name"
                                            ></input-form>
                                            <p v-if="textValidaNameAddArchive">{{
                                                    $t('backend.customer.create-customers.title_estas_agregando_archivos_person_natural_customer')
                                                }}</p>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <input-form
                                                id="txtUserLastName"
                                                :label="$t('backend.customer.create-customers.titulo_apellidos_cliente')"
                                                pattern="alf"
                                                :errorMsg="$t('backend.customer.create-customers.titulo_error_apellidos_cliente')"
                                                :requiredMsg="$t('backend.customer.create-customers.titulo_obligatrio_apellidos_cliente')"
                                                :modelo.sync="user.last_name"
                                                :required="true"
                                                :msgServer.sync="errors.last_name"
                                            ></input-form>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <input-form
                                                id="txtUserEmail"
                                                :label="$t('backend.customer.create-customers.titulo_email')"
                                                pattern="email"
                                                :errorMsg="$t('backend.customer.create-customers.titulo_error_email')"
                                                :requiredMsg="$t('backend.customer.create-customers.titulo_obligatrio_email')"
                                                :modelo.sync="email"
                                                :required="true"
                                                :msgServer.sync="errors.email"
                                            ></input-form>
                                            <p style="margin-top: -1rem;font-size: 0.9rem; display: none"
                                               id="text-verify-email" class="text-danger">{{
                                                    $t('backend.customer.create-customers.titulo_msg_validar_email')
                                                }}</p>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <input-form
                                                id="txtAddress"
                                                :label="$t('backend.customer.create-customers.titulo_direccion')"
                                                pattern="all"
                                                :errorMsg="$t('backend.customer.create-customers.titulo_error_direccion')"
                                                :requiredMsg="$t('backend.customer.create-customers.titulo_obligatrio_direccion')"
                                                :modelo.sync="user.address"
                                                :required="true"
                                                :msgServer.sync="errors.address"
                                            ></input-form>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <label class="form-control-label label-selects">{{
                                                    $t('backend.customer.create-customers.titulo_telefono')
                                                }}</label>
                                            <VuePhoneNumberInput
                                                v-model="user.phone"
                                                :required="true"
                                                :requiredMsg="$t('backend.customer.create-customers.titulo_obligatrio_telefono')"
                                                @update="user.phoneI=$event.formatInternational"
                                                :fetch-country="true"
                                                :translations="{
                                countrySelectorLabel: $t('backend.customer.create-customers.titulo_codigo_pais'),
                                countrySelectorError: $t('backend.customer.create-customers.titulo_selecciona_pais'),
                                phoneNumberLabel: $t('backend.customer.create-customers.titulo_numero_telefono'),
                                example: $t('backend.customer.create-customers.titulo_telefono_ejemplo')
                            }"/>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <input-form
                                                :label="$t('backend.customer.create-customers.titulo_tipo_documento')"
                                                id="txtIdentificationType"
                                                errorMsg
                                                :requiredMsg="$t('backend.customer.create-customers.titulo_obligatrio_tipo_documento')"
                                                :required="true"
                                                :modelo.sync="user.valueIdentificationType"
                                                :msgServer.sync="errors.valueIdentificationType"
                                                type="multiselect"
                                                selectLabel="Tipo de documento"
                                                :multiselect="{ options: optionsIdentificationType,
                                           selectLabel:this.$t('backend.customer.create-customers.multiselect_seleccionar'),
                                           selectedLabel:this.$t('backend.customer.create-customers.multiselect_seleccionado'),
                                           deselectLabel:this.$t('backend.customer.create-customers.multiselect_desmarcar'),
                                          placeholder:this.$t('backend.customer.create-customers.titulo_seleccionar_tipo_documento'),
                                          taggable : true,
                                          'track-by':'id',
                                          label: 'name',
                                          'custom-label': identiType=>identiType.name[language]
                                        }"
                                            ></input-form>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <input-form
                                                id="txtIdentifacation"
                                                :label="$t('backend.customer.create-customers.titulo_identificacion_representante')"
                                                pattern="alf_num"
                                                :errorMsg="$t('backend.customer.create-customers.titulo_error_identificacion_representante')"
                                                :requiredMsg="$t('backend.customer.create-customers.titulo_obligatrio_identificacion_representante')"
                                                :modelo.sync="user.identification"
                                                :required="true"
                                                :msgServer.sync="errors.identification"
                                            ></input-form>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <input-form
                                                label="Fecha de Nacimiento"
                                                id="txtFechaNacimiento"
                                                pattern="all"
                                                errorMsg="Ingresa fecha válida"
                                                requiredMsg="Fecha de nacimiento requerido"
                                                :required="true"
                                                :modelo.sync="user.dataBirth"
                                                :msgServer.sync="errors.dataBirth"
                                                type="date"
                                                :datepicker="{
                                                   'clear-button': false,
                                                  'bootstrap-styling':true,

                                                }"
                                            ></input-form>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <input-form
                                                :label="$t('backend.customer.create-customers.titulo_seleccionar_pais')"
                                                id="txtCountryManagger"
                                                errorMsg
                                                :requiredMsg="$t('backend.customer.create-customers.titulo_obligatrio_selecciona_pais')"
                                                :required="true"
                                                :modelo.sync="user.valueCountryUser"
                                                :msgServer.sync="errors.valueCountryUser"
                                                type="multiselect"
                                                :selectLabel="$t('backend.customer.create-customers.titulo_buscar_selecciona_pais')"
                                                @updatedValue="getCities"
                                                :multiselect="{
                                           options: optionsCountries,
                                           selectLabel:this.$t('backend.customer.create-customers.multiselect_seleccionar'),
                                           selectedLabel:this.$t('backend.customer.create-customers.multiselect_seleccionado'),
                                           deselectLabel:this.$t('backend.customer.create-customers.multiselect_desmarcar'),
                                          placeholder:this.$t('backend.customer.create-customers.titulo_seleccionar_pais'),
                                          taggable : true,
                                          'track-by':'id',
                                          label: 'name',
                                          'custom-label': country=>country.name
                                        }"
                                            ></input-form>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4" v-if="user.valueCountryUser">
                                            <input-form
                                                class="input-label-register"
                                                :label="$t('backend.customer.create-customers.titulo_seleccionar_ciudad')"
                                                id="txtCityUser"
                                                errorMsg
                                                :requiredMsg="$t('backend.customer.create-customers.titulo_obligatrio_selecciona_ciudad')"
                                                :required="false"
                                                :modelo.sync="user.valueCityUser"
                                                :msgServer.sync="errors.valueCity"
                                                type="multiselect"
                                                :selectLabel="$t('backend.customer.create-customers.titulo_buscar_selecciona_ciudad')"
                                                :multiselect="{ options: optionsCities,
                                           selectLabel:this.$t('backend.customer.create-customers.multiselect_seleccionar'),
                                           selectedLabel:this.$t('backend.customer.create-customers.multiselect_seleccionado'),
                                           deselectLabel:this.$t('backend.customer.create-customers.multiselect_desmarcar'),
                                          placeholder:this.$t('backend.customer.create-customers.titulo_seleccionar_ciudad'),
                                          taggable : true,
                                          'track-by':'id',
                                          label: 'name',
                                          'custom-label': cities=>cities.name
                                        }"
                                            ></input-form>
                                        </div>
                                    </div>
                                    <div class="row pt-1">
                                        <div class="demo-inline-spacing">
                                            <!-- Boton para agregar archivos -->
                                            <button v-if="addArchive === false" @click="btnAddArchivesCompany"
                                                    type="button"
                                                    class="btn btn-primary waves-effect waves-float waves-light"
                                                    style="font-size: 0.92rem">
                                                {{ $t('backend.customer.create-customers.btn_agregar_archivos') }}
                                            </button>
                                            <button v-if="addArchive === true" @click="btnCancelAddArchives"
                                                    type="button"
                                                    class="btn btn-primary waves-effect waves-float waves-light"
                                                    style="font-size: 0.92rem">
                                                {{ $t('backend.customer.create-customers.btn_no_agregar_archivos') }}
                                            </button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12 pb-1">
                                            <h2>¿En que area de trabajo será asignado?</h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <input-form
                                                label="Selecciona area de trabajo"
                                                id="txtTypeWorkArea"
                                                errorMsg
                                                requiredMsg="Debes seleccionar una area de trabajo"
                                                :required="false"
                                                :modelo.sync="teamWorkArea"
                                                @updatedValue="getPosition"
                                                :msgServer.sync="errors.teamWorkArea"
                                                type="multiselect"
                                                selectLabel="Buscar y seleccionar una area de trabajo"
                                                :multiselect="{
                                           options: optionsTypeWorkAreas,
                                           selectLabel:'Selecciona area de trabajo',
                                           selectedLabel:this.$t('backend.customer.create-customers.multiselect_seleccionado'),
                                           deselectLabel:this.$t('backend.customer.create-customers.multiselect_desmarcar'),
                                          placeholder:'Selecciona area de trabajo',
                                          taggable : true,
                                          'track-by':'id',
                                          label: 'name',
                                          'custom-label': typeWorkArea=>typeWorkArea.name[language]
                                        }"
                                            ></input-form>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4" v-if="teamWorkArea">
                                            <input-form
                                                label="Selecciona uno o varios cargos"
                                                id="txtPositionWorkTeam"
                                                :requiredMsg="$t('register-aspirant.requerido_selecc_music_perfilacion')"
                                                :required="true"
                                                :modelo.sync="positionTeam"
                                                :msgServer.sync="errors.positionTeam"
                                                type="multiselect"
                                                selectLabel=""
                                                :multiselect="{ 'tag-placeholder' : '',
                                          // selectLabel   : $t('company.multiselect.select'),
                                          // selectedLabel : $t('company.multiselect.selected'),
                                          // deselectLabel : $t('company.multiselect.remove'),
                                          placeholder : 'Buscar y seleccionar cargo',
                                          label : 'name',
                                          'track-by' : 'id',
                                          options : optionsPositionWorkArea,
                                          multiple : true,
                                          taggable : true,
                                          'custom-label': position => position.name[language]
                                        }"
                                                @tag="addTagPositionTeam"
                                            ></input-form>
                                        </div>
                                    </div>
                                    <hr>
                                    <div v-if="positionTeam.length > 0">
                                        <div class="row">
                                            <div class="col-12 pb-1">
                                                <h2>Información de sueldo</h2>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-4 col-lg-4">
                                                <input-form
                                                    type="money"
                                                    label="Sueldo"
                                                    id="txtPrice"
                                                    pattern="all"
                                                    errorMsg="ingresa un valor válido"
                                                    requiredMsg="este campo es requerido"
                                                    :required="true"
                                                    :modelo.sync="salary"
                                                    :msgServer.sync="errors.salary"
                                                    :money="money"
                                                ></input-form>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <input-form
                                                    type="textarea"
                                                    label="Agregar una nota"
                                                    id="txtBudgetDescription"
                                                    pattern="all"
                                                    errorMsg="Ingrese información válida"
                                                    requiredMsg="Este campo es requerido"
                                                    :required="false"
                                                    :modelo.sync="noteTeam"
                                                    :msgServer.sync="errors.noteTeam"
                                                    :options="{
                                                rows: 5
                                                }"
                                                >
                                                </input-form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" v-if="addArchive">
                                        <div class="col-12">
                                            <label class="form-control-label" id="add-archive-dropzone-team">Agregar
                                                Archivos</label>
                                            <vue2Dropzone class="dropzone upload-logo dropzone-area dz-clickable"
                                                          ref="myVueDropzone"
                                                          @vdropzone-sending="sendingEvent"
                                                          @vdropzone-max-files-exceeded="maxFiles"
                                                          @vdropzone-success="addArchiveTeam"
                                                          @vdropzone-removed-file="removedArchiveDropzoneTeam"
                                                          id="dpz-archives-customer-company"
                                                          :options="dropzoneOptionsTeamArchive">

                                            </vue2Dropzone>
                                        </div>
                                    </div>
                                </section>
                            </tab-content>
                            <!------------------------------
                              TAB CONFIRMAR DATOS
                            -------------------------------->
                            <tab-content
                                :title="$t('backend.team.create-teams.titulo_wizard_confirmar_datos')"
                                :beforeChange="validarTab"
                            >
                                <section style="width: 100%" v-if="currentTab===1">
                                    <h3 class="d-flex justify-content-center pb-2">Datos del Usuario</h3>
                                    <div class="row">
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>{{
                                                        $t('backend.customer.create-customers.titulo_nombre')
                                                    }}:</label>
                                                <p v-text="userName"></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>{{
                                                        $t('backend.customer.create-customers.titulo_apellidos')
                                                    }}:</label>
                                                <p v-text="user.last_name"></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>Fecha de Nacimiento:</label>
                                                <p>{{
                                                        moment(user.dataBirth).locale(language).format("dddd, MMMM Do YYYY")
                                                    }}</p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>{{
                                                        $t('backend.customer.create-customers.titulo_email')
                                                    }}:</label>
                                                <p v-text="email"></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>{{
                                                        $t('backend.customer.create-customers.titulo_direccion')
                                                    }}:</label>
                                                <p v-text="user.address"></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>{{
                                                        $t('backend.customer.create-customers.titulo_telefono')
                                                    }}:</label>
                                                <p v-text="user.phoneI"></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>{{
                                                        $t('backend.customer.create-customers.titulo_tipo_documento')
                                                    }}:</label>
                                                <p v-text="user.valueIdentificationType.name[language]"></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>{{
                                                        $t('backend.customer.create-customers.titulo_identificacion_representante')
                                                    }}:</label>
                                                <p v-text="user.identification"></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4" v-if="positionTeam.length > 0">
                                            <div class="form-group">
                                                <label style="padding-bottom: 0.5rem">Cargo{{
                                                        positionTeam.length > 1 ? 's' : ''
                                                    }}:</label><br>
                                                <div v-for="position in positionTeam" :key="position.id">
                                                    <div style="padding-bottom: 0.5rem">
                                                        <span
                                                            class="label text-center font-weight-bold badge badge-pill badge-glow badge-primary"
                                                            style="margin-right: 0.5rem">{{
                                                                position.name[language]
                                                            }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>{{
                                                        $t('backend.customer.create-customers.titulo_pais')
                                                    }}:</label>
                                                <p v-text="user.valueCountryUser.name"></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4" v-if="user.valueCityUser">
                                            <div class="form-group">
                                                <label>{{
                                                        $t('backend.customer.create-customers.titulo_ciudad')
                                                    }}:</label>
                                                <p v-text="user.valueCityUser.name"></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4" v-if="salary">
                                            <div class="form-group">
                                                <label>Salario:</label>
                                                <p>{{ salary | currency }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" v-if="noteTeam">
                                        <div class="col-12">
                                            <label>Nota:</label>
                                            <p v-text="noteTeam"></p>
                                        </div>
                                    </div>
                                    <div class="content-body" v-if="urlsArchiveTeam.length > 0 ">
                                        <div class="row">
                                            <div class="col-6 col-lg-3 col-md-3" v-for="archives in urlsArchiveTeam" :key="archives.uuid">
                                                <div class="card shadow-none bg-transparent border-secondary">
                                                    <div class="card-body" @click="openModalArchivePopup(archives, archives.nameArchive)">
                                                        <div class="d-flex align-items-center justify-content-center w-100 pb-2">
                                                            <img :src="'/images/archives-icons/'+archives.extension+'.png'" alt="file-icon" height="35"/>
                                                        </div>
                                                        <h6 class="card-title text-center" v-text="archives.nameArchive"></h6>
<!--                                                        <p class="card-text text-center">-->
<!--                                                            <small class="text-muted">Peso: 34Kb</small>-->
<!--                                                        </p>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </tab-content>
                        </form-wizard>
                    </form>
                </div>
            </div>
        </div>
        <vs-popup fullscreen class="holamundo" :title="titleNameArchive"
                  :active.sync="popupPreviewActivo">
            <preview-doc :dataArchiveUrl="dataArchive.urlArchive" :extension="dataArchive.extension"></preview-doc>
        </vs-popup>
    </div>
</template>

<script>
require("moment/min/locales.min");
import moment from 'moment';
import Multiselect from "vue-multiselect";
import VuePhoneNumberInput from "vue-phone-number-input";
import "vue-phone-number-input/dist/vue-phone-number-input.css";
import vue2Dropzone from 'vue2-dropzone'
import Datepicker from 'vuejs-datepicker';
import {en, es} from 'vuejs-datepicker/dist/locale'
import VMask from 'v-mask'
import {VueMaskFilter} from 'v-mask'


export default {
    name: "CreateNewTeam",
    components: {
        Multiselect,
        Datepicker,
        VuePhoneNumberInput,
        vue2Dropzone,
        VMask,
        VueMaskFilter
    },
    data() {
        return {
            en: en,
            es: es,
            titleNameArchive: null,
            popupPreviewActivo: false,
            csrf_token: window.token,
            teamWorkArea: null,
            positionTeam: [],
            noteTeam: null,
            colorLoading: '#3f4f6e',
            salary: null,
            moment: moment,
            dataArchive:[
                {
                    urlArchive:null
                },
                {
                    extension:null
                }
            ],
            optionsTypeWorkAreas: [],
            language: window.lang,
            textValidaNameAddArchive: false,
            currentTab: 0,
            optionsIdentificationType: [],
            optionsPositionWorkArea: [],
            optionsCountries: [],
            optionsCities: [],
            urlsArchiveTeam: [],
            addArchive: false,
            userName: '',
            user: {
                last_name: '',
                phone: '',
                address: '',
                dataBirth: null,
                valueCountryUser: null,
                valueCityUser: null,
                valueIdentificationType: null,
                valueTypePosition: null,
                identification: ''
            },
            money: {
                decimal: ",",
                thousands: ".",
                prefix: "$ ",
                suffix: "",
                precision: 0
            },
            email: '',
            emailverify: '',
            errors: {},
            dropzoneOptionsTeamArchive: {
                url: '/api/upload-archive-team',
                // thumbnailWidth: 200,
                maxFilesize: 1,
                maxFiles: 20,
                paramName: 'archive',
                acceptedFiles: "image/*,application/pdf,.doc,.docx,.xls,.xlsx,.csv,.tsv,.ppt,.pptx,.pages,.odt,.rtf",
                addRemoveLinks: true,
                dictDefaultMessage: this.$t('backend.customer.create-customers.titulo_mensaje_dropzone_archivos'),
                dictMaxFilesExceeded: this.$t('backend.customer.create-customers.msg_dropzone_no_puede_subir_mas_archivos_archivo'),
                dictFileTooBig: this.$t('backend.customer.create-customers.msg_uno_el_archivo_demasiado') + " ({{filesize}}MiB). " + this.$t('backend.customer.create-customers.msg_dos_tamaño_maximo') + " {{maxFilesize}}MiB.",
                dictRemoveFile: this.$t('backend.customer.create-customers.msg_tres_remover_archivo'),
                dictInvalidFileType: this.$t('backend.customer.create-customers.msg_error_tipo_archivo_archivo'),
                headers: {
                    'X-CSRF-TOKEN': this.csrf_token //Este token lo pasamos por los props
                },
                // params: {id: this.entity_get_data.id}  //Para enviar parametros
            },
        }
    },
    methods: {
        createNewTeam() {

        },
        openModalArchivePopup(data, nameArchive) {
            this.dataArchive = data
            this.popupPreviewActivo = true
            this.titleNameArchive = nameArchive
            // this.infoModalRecording = question
        },
        eventSelectScroll(option) {
            const options = {
                container: "body",
                easing: "linear"
            };
            setTimeout(() => {
                this.$scrollTo(option, 1000, options);
            }, 100);
        },
        btnAddArchivesCompany() {
            if (this.user) {
                this.addArchive = true
                this.eventSelectScroll('#add-archive-dropzone-team')
            } else {
                this.$toast.error({
                    title: this.$t('backend.customer.create-customers.title_atención_toast'),
                    message: this.$t('backend.customer.create-customers.title_mensaje_para_agregar_archivos'),
                    showDuration: 1000,
                    hideDuration: 8000,
                })
            }

        },

        btnCancelAddArchives() {
            this.addArchive = false

            for (let i = 0; i < this.urlsArchiveTeam.length; i++) {
                const data = new FormData();
                data.append("archiveTeam", this.urlsArchiveTeam[i].urlArchive);
                setTimeout(() => {
                    axios.post('/api/removed-archive-team', data)
                        .then(resp => {
                            this.$toast.success({
                                title: this.$t('backend.customer.create-customers.title_muy_bien_toast'),
                                message: this.$t('backend.customer.create-customers.title_mensaje_success_toast_remove_image'),
                                showDuration: 1000,
                                hideDuration: 5000,
                                position: 'top right',
                            })
                            this.urlsArchiveTeam.splice(i, 1);
                        }).catch(err => {
                        this.$toast.error({
                            title: this.$t('backend.customer.create-customers.title_error_toast'),
                            message: this.$t('backend.customer.create-customers.title_mensaje_error_toast'),
                            showDuration: 1000,
                            hideDuration: 5000,
                            position: 'top right',
                        })
                    });
                }, 1000)
            }

            this.urlsArchiveTeam = [];
            this.textValidaNameAddArchive = false
        },
        sendingEvent(file, xhr, formData) {
            console.log('upload file', file.upload);
            formData.append('nameTeam', this.userName);
            formData.append('nameId', file.upload.uuid);
        },

        maxFiles(file) {
            this.$refs.myVueDropzone.removeFile(file);
            this.$toast.error({
                title: this.$t('backend.customer.create-customers.title_atención_toast'),
                message: this.$t('backend.customer.create-customers.msg_dropzone_no_puede_subir_mas_archivos'),
                showDuration: 1000,
                hideDuration: 8000,
                position: 'top right',
            })
        },
        addArchiveTeam(file, response) {
            console.log(file)
            this.urlsArchiveTeam.push({
                nameArchive: file.name,
                urlArchive: response.data,
                uuid: response.uuid,
                extension: response.extension
            })
            console.log(this.urlsArchiveTeam);
            if (this.urlsArchiveTeam) {
                this.textValidaNameAddArchive = true
                setTimeout(() => {
                    document.getElementById('txtNameUserTeam').disabled = true;
                }, 500)
            }
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

        removedArchiveDropzoneTeam(file, error, xhr) {
            console.log('remove file ', file.upload.uuid);
            let uuid = file.upload.uuid

            for (let i = 0; i < this.urlsArchiveTeam.length; i++)
                if (this.urlsArchiveTeam[i].uuid === uuid) {
                    const data = new FormData();
                    data.append("archiveTeam", this.urlsArchiveTeam[i].urlArchive);
                    axios.post('/api/removed-archive-team', data)
                        .then(resp => {
                            this.$toast.success({
                                title: this.$t('backend.customer.create-customers.title_muy_bien_toast'),
                                message: this.$t('backend.customer.create-customers.title_mensaje_success_toast_remove_image'),
                                showDuration: 1000,
                                hideDuration: 5000,
                                position: 'top right',
                            })
                            this.urlsArchiveTeam.splice(i, 1);
                        }).catch(err => {
                        this.$toast.error({
                            title: this.$t('backend.customer.create-customers.title_error_toast'),
                            message: this.$t('backend.customer.create-customers.title_mensaje_error_toast'),
                            showDuration: 1000,
                            hideDuration: 5000,
                            position: 'top right',
                        })
                    });
                    break;
                }
        },

        validarTab() {
            eventBus.$emit("validarFormulario");
            setTimeout(() => {
                const validated = document.querySelectorAll(".is-invalid").length < 1;
                console.log(validated)
                if (validated) {
                    this.$refs.wizard.tabs[this.currentTab].validationError = null;
                    this.$refs.wizard.changeTab(this.currentTab, this.currentTab + 1);
                }
            }, 200);
            return false;
        },

        addArchivePersonNaturalCustomer(file, response) {
            this.urlsArchivePersonNatural.push({
                urlArchive: response.data,
                uuid: response.uuid,
                extension: response.extension
            })
            if (this.urlsArchivePersonNatural) {
                this.textValidaNameAddArchive = true
                setTimeout(() => {
                    document.getElementById('txtNameUserCustomer').disabled = true;

                }, 500);
            }
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
        getIdentificationType() {
            axios.get('/api/get-identificationtype').then(resp => {
                this.optionsIdentificationType = resp.data.data
                this.$vs.loading.close()
            }).catch(err => {
                this.$toast.error({
                    title: this.$t('backend.customer.create-customers.title_error_toast'),
                    message: this.$t('backend.customer.create-customers.title_mensaje_error_toast'),
                    showDuration: 1000,
                    hideDuration: 5000,
                    position: 'top right',
                })
                this.$vs.loading.close()
            });
        },

        getCountries() {
            axios.get('/api/get-countries').then(resp => {
                this.optionsCountries = resp.data.data
                this.$vs.loading.close()
            }).catch(err => {
                this.$toast.error({
                    title: this.$t('backend.customer.create-customers.title_error_toast'),
                    message: this.$t('backend.customer.create-customers.title_mensaje_error_toast'),
                    showDuration: 1000,
                    hideDuration: 5000,
                    position: 'top right',
                })
                this.$vs.loading.close()
            });
        },

        getCities(iddepartamento) {
            if (iddepartamento === null) {
                // this.optionsCities = [];
                // this.user.valueCity = null;
            } else {
                this.$vs.loading({color: this.colorLoading})
                axios
                    .get('/api/get-cities/' + iddepartamento.alpha2Code)
                    .then(res => {
                        this.optionsCities = res.data.data
                        this.$vs.loading.close()
                    })
                    .catch(err => {
                        this.$toast.error({
                            title: this.$t('backend.customer.create-customers.title_error_toast'),
                            message: this.$t('backend.customer.create-customers.title_mensaje_error_toast'),
                            showDuration: 1000,
                            hideDuration: 5000,
                            position: 'top right',
                        })
                        this.$vs.loading.close()
                    })
            }
        },

        getPosition(idWorkArea) {
            console.log(idWorkArea);
            if (idWorkArea !== null) {
                this.$vs.loading({color: this.colorLoading})
                axios.get('/api/get-position-team/' + idWorkArea.id)
                    .then(resp => {
                        this.optionsPositionWorkArea = resp.data.data
                        this.$vs.loading.close()
                    })
                    .catch(err => {
                        this.$toast.error({
                            title: this.$t('backend.customer.create-customers.title_error_toast'),
                            message: this.$t('backend.customer.create-customers.title_mensaje_error_toast'),
                            showDuration: 1000,
                            hideDuration: 5000,
                            position: 'top right',
                        })
                        this.$vs.loading.close()
                    })
            } else {
                this.positionTeam = []
            }
        },
        addTagPositionTeam(newTag) {
            const tag = {
                name: newTag,
                code: newTag.substring(0, 2) + Math.floor(Math.random() * 10000000)
            };
            this.options.push(tag);
            this.value.push(tag);
        },
        getTypeWorkAreas() {
            axios.get('/api/get-type-work-area').then(resp => {
                this.optionsTypeWorkAreas = resp.data.data
                this.$vs.loading.close()
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

        cambioPagina(prevIndex, nextIndex) {
            this.currentTab = nextIndex;
        },

    },
    watch: {
        email: function (val) {
            let data = this
            if (val) {
                axios.get('/api/verify-email-user/' + val)
                    .then(resp => {
                        if (resp.data) {
                            $("#txtUserEmail").addClass("is-invalid");
                            $("#text-verify-email").css("display", "block");
                        } else {
                            data.emailverify = ''
                            $("#txtUserEmail").removeClass("is-invalid");
                            $("#text-verify-email").css("display", "none");
                        }
                    }).catch(err => {
                });
            }
        },

        userName: function (val) {
            if (!val && this.addArchive === true) {
                this.addArchive = false
                this.$toast.error({
                    title: this.$t('backend.customer.create-customers.title_atención_toast'),
                    message: this.$t('backend.customer.create-customers.title_mensaje_para_agregar_archivos'),
                    showDuration: 1000,
                    hideDuration: 8000,
                })

                for (let i = 0; i < this.urlsArchiveTeam.length; i++) {
                    const data = new FormData();
                    data.append("archiveTeam", this.urlsArchiveTeam[i].urlArchive);
                    setTimeout(() => {
                        axios.post('/api/removed-archive-team', data)
                            .then(resp => {
                                this.$toast.success({
                                    title: this.$t('backend.customer.create-customers.title_muy_bien_toast'),
                                    message: this.$t('backend.customer.create-customers.title_mensaje_success_toast_remove_image'),
                                    showDuration: 1000,
                                    hideDuration: 5000,
                                    position: 'top right',
                                })
                                this.urlsArchiveTeam.splice(i, 1);
                            }).catch(err => {
                            this.$toast.error({
                                title: this.$t('backend.customer.create-customers.title_error_toast'),
                                message: this.$t('backend.customer.create-customers.title_mensaje_error_toast'),
                                showDuration: 1000,
                                hideDuration: 5000,
                                position: 'top right',
                            })
                        });
                    }, 1000)
                }
                this.urlsArchiveTeam = [];
                this.textValidaNameAddArchive = false
            }
        },

        urlsArchiveTeam: function (val) {
            if (!val.length) {
                document.getElementById('txtNameUserTeam').disabled = false;
                this.textValidaNameAddArchive = false
            }
        },
    },

    mounted() {
        this.getCountries();
        this.getIdentificationType();
        this.getTypeWorkAreas();
    }
}
</script>

<style scoped>
.vdp-datepicker__calendar .cell:not(.blank):not(.disabled).day:hover, .vdp-datepicker__calendar .cell:not(.blank):not(.disabled).month:hover, .vdp-datepicker__calendar .cell:not(.blank):not(.disabled).year:hover {
    border: 1px solid #f05e7d !important;
}

.vdp-datepicker__calendar .cell.selected {
    background: #f05e7d !important;
}
</style>
