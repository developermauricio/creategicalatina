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
                                                :label="$t('backend.team.create-teams.titulo_fecha_nacimiento')"
                                                id="txtFechaNacimiento"
                                                pattern="all"
                                                :errorMsg="$t('backend.team.create-teams.titulo_fecha_valida')"
                                                :requiredMsg="$t('backend.team.create-teams.titulo_fecha_nacimiento_requerido')"
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
                                            <h2>{{ $t('backend.team.create-teams.titulo_que_area_de_trabajo_asignado') }}</h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <input-form
                                                :label="$t('backend.team.create-teams.titulo_seleccionado_area_de_trabajo')"
                                                id="txtTypeWorkArea"
                                                errorMsg
                                                :requiredMsg="$t('backend.team.create-teams.titulo_debe_seleccionar_area_trabajo')"
                                                :required="false"
                                                :modelo.sync="teamWorkArea"
                                                @updatedValue="getPosition"
                                                :msgServer.sync="errors.teamWorkArea"
                                                type="multiselect"
                                                :selectLabel="$t('backend.team.create-teams.titulo_buscar_seleccionar_area_trabajo')"
                                                :multiselect="{
                                           options: optionsTypeWorkAreas,
                                           selectLabel:$t('backend.team.create-teams.titulo_selecciona_area_de_trabajo'),
                                           selectedLabel:this.$t('backend.customer.create-customers.multiselect_seleccionado'),
                                           deselectLabel:this.$t('backend.customer.create-customers.multiselect_desmarcar'),
                                          placeholder:$t('backend.team.create-teams.titulo_selecciona_area_de_trabajo'),
                                          taggable : true,
                                          'track-by':'id',
                                          label: 'name',
                                          'custom-label': typeWorkArea=>typeWorkArea.name[language]
                                        }"
                                            ></input-form>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4" v-if="teamWorkArea">
                                            <input-form
                                                :label="$t('backend.team.create-teams.titulo_selecciona_uno_varios_cargos')"
                                                id="txtPositionWorkTeam"
                                                :requiredMsg="$t('backend.team.create-teams.titulo_debes_seleccionar_uno_varios_cargos')"
                                                :required="true"
                                                :modelo.sync="positionTeam"
                                                :msgServer.sync="errors.positionTeam"
                                                type="multiselect"
                                                selectLabel=""
                                                :multiselect="{ 'tag-placeholder' : '',
                                          // selectLabel   : $t('company.multiselect.select'),
                                          // selectedLabel : $t('company.multiselect.selected'),
                                          // deselectLabel : $t('company.multiselect.remove'),
                                          placeholder : $t('backend.team.create-teams.titulo_buscar_seleccionar_cargo'),
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
                                                <h2>{{ $t('backend.team.create-teams.titulo_informacion_de_sueldo') }}</h2>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-4 col-lg-4">
                                                <input-form
                                                    type="money"
                                                    :label="$t('backend.team.create-teams.titulo_sueldo')"
                                                    id="txtPrice"
                                                    pattern="all"
                                                    :errorMsg="$t('backend.team.create-teams.titulo_ingrese_valor_valido')"
                                                    :requiredMsg="$t('backend.team.create-teams.titulo_salario_requerido')"
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
                                                    :label="$t('backend.team.create-teams.titulo_agregar_nota')"
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
                                            <label class="form-control-label" id="add-archive-dropzone-team">{{
                                                    $t('backend.team.create-teams.titulo_agregar_archivos')
                                                }}</label>
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
                                    <h3 class="d-flex justify-content-center pb-2">{{ $t('backend.team.create-teams.titulo_datos_del_usuario') }}</h3>
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
                                                <label>{{ $t('backend.team.create-teams.titulo_fecha_nacimiento') }}:</label>
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
                                                <label style="padding-bottom: 0.5rem">{{ $t('backend.team.create-teams.titulo_cargo_posiciones') }}{{
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
                                                <label>{{ $t('backend.team.create-teams.titulo_sueldo') }}:</label>
                                                <p>{{ salary | currency }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" v-if="noteTeam">
                                        <div class="col-12">
                                            <label>{{  $t('backend.team.create-teams.titulo_nota') }}:</label>
                                            <p v-text="noteTeam"></p>
                                        </div>
                                    </div>
                                    <div class="row"  v-if="urlsArchiveTeam.length > 0">
                                        <div class="col-12">
                                            <label>{{ $t('backend.team.create-teams.titulo_archives') }}:</label>
                                        </div>
                                    </div>
                                    <div class="content-body" v-if="urlsArchiveTeam.length > 0 ">
                                        <div class="row">
                                            <div class="col-12 col-lg-3 col-md-3" v-for="archives in urlsArchiveTeam" :key="archives.uuid">
                                                <div class="card shadow-none bg-transparent border-secondary" style="cursor: pointer">
                                                    <div class="card-body" @click="openModalArchivePopup(archives, archives.nameArchive)">
                                                        <div class="d-flex align-items-center justify-content-center w-100">
                                                            <img v-if="archives.extension === 'csv'
                                                            || archives.extension === 'pdf'
                                                            || archives.extension === 'docx'
                                                            || archives.extension === 'pptx'
                                                            || archives.extension === 'xlsx'
                                                            || archives.extension === 'jpg'
                                                            || archives.extension === 'png'" :src="'/images/archives-icons/'+archives.extension+'.png'" alt="file-icon" height="35"/>
                                                            <img v-else src="/images/archives-icons/archive.png" alt="" height="35">
                                                        </div>
                                                        <h6 class="card-title text-center" v-text="archives.nameArchive"></h6>
                                                        <p class="card-text text-center">
                                                            <small class="text-muted">{{ $t('backend.team.create-teams.titulo_vista_previa') }}</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pt-1">
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <input-form
                                                :label="$t('backend.customer.create-customers.titulo_seleccionar_idioma_email')"
                                                id="txtLaguangeEmail"
                                                errorMsg
                                                :requiredMsg="$t('backend.customer.create-customers.titulo_obligario_idioma_email')"
                                                :required="true"
                                                :modelo.sync="languageEmail"
                                                :msgServer.sync="errors.languageEmail"
                                                type="multiselect"
                                                selectLabel="Tipo de documento"
                                                :multiselect="{ options: optionsLanguage,
                                           selectLabel:this.$t('backend.customer.create-customers.multiselect_seleccionar'),
                                           selectedLabel:this.$t('backend.customer.create-customers.multiselect_seleccionado'),
                                           deselectLabel:this.$t('backend.customer.create-customers.multiselect_desmarcar'),
                                          placeholder:this.$t('backend.customer.create-customers.titulo_seleccionar_idioma_email'),
                                          taggable : true,
                                          'track-by':'id',
                                          label: 'name',
                                          'custom-label': language=>language.name
                                        }"
                                            ></input-form>
                                        </div>
                                    </div>
                                </section>
                            </tab-content>
                            <template slot="footer" slot-scope="props">
                                <div class="wizard-footer-left">
                                    <wizard-button v-if="props.activeTabIndex > 0"
                                                   @click.native="props.prevTab()"
                                                   :style="props.fillButtonStyle">
                                        {{ $t('backend.customer.create-customers.btn_titulo_wizard_volver') }}
                                    </wizard-button>
                                </div>
                                <div class="wizard-footer-right">
                                    <wizard-button v-if="!props.isLastStep" @click.native="props.nextTab()"
                                                   class="wizard-footer-right" :style="props.fillButtonStyle">
                                        {{ $t('backend.customer.create-customers.btn_titulo_wizard_siguiente') }}
                                    </wizard-button>

                                    <wizard-button v-else @click.native="createNewTeam()"
                                                   class="wizard-footer-right finish-button"
                                                   :style="props.fillButtonStyle">
                                        {{
                                            props.isLastStep ? $t('backend.team.create-teams.titulo_crear_miembro') : $t('backend.customer.create-customers.btn_titulo_wizard_siguiente')
                                        }}
                                    </wizard-button>
                                </div>
                            </template>
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

export default {
    name: "CreateNewTeam",
    components: {
        Multiselect,
        Datepicker,
        VuePhoneNumberInput,
        vue2Dropzone,
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
            languageEmail: null,
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
            optionsLanguage: [
                {id: 1, name: this.$t('Español'), code: 'es'},
                {id: 2, name: this.$t('Inglés'), code: 'en'},
            ],
            user: {
                last_name: '',
                phone: '',
                address: '',
                dataBirth: null,
                valueCountryUser: null,
                valueCityUser: null,
                valueIdentificationType: null,
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

                const data = new FormData()
                data.append('name', this.userName);
                data.append('last_name', this.user.last_name);
                data.append('email', this.email);
                data.append('phone', this.user.phoneI);
                data.append('address', this.user.address);
                data.append('dataBirth', moment(this.user.dataBirth).format("YYYY-MM-DD HH:mm:ss"));
                data.append('country', JSON.stringify(this.user.valueCountryUser));
                data.append('city', JSON.stringify(this.user.valueCityUser));
                data.append('type_identification', JSON.stringify(this.user.valueIdentificationType));
                data.append('identification', this.user.identification);
                data.append('position_team', JSON.stringify(this.positionTeam));
                data.append('salary', this.salary);
                data.append('note', this.noteTeam);
                data.append('archives', JSON.stringify(this.urlsArchiveTeam));
                data.append('languageEmail', JSON.stringify(this.languageEmail));

                Swal.fire({
                        title: this.$t('backend.customer.create-customers.confimar_registro_alerta_title'),
                        text: this.$t('backend.customer.create-customers.confimar_registro_alerta_mensaje'),
                        confirmButtonColor: "#F05E7D",
                        cancelButtonColor: "#79ebdf",
                        confirmButtonText: this.$t('backend.customer.create-customers.confimar_registro_alerta_aceptar'),
                        cancelButtonText: this.$t('backend.customer.create-customers.confimar_registro_alerta_cancelar'),
                        customClass: "swal-confirmation",
                        showCancelButton: true,
                        reverseButtons: true,
                        allowOutsideClick: false,
                    }).then(result => {
                        if (result.value) {
                            resp.$vs.loading({
                                color: resp.colorLoading,
                                text: this.$t('backend.team.create-teams.titulo_creando_nuevo_miembro')
                            })

                            axios.post('/api/register/store-team', data).then(res => {
                                resp.$vs.loading.close()
                                this.$toast.success({
                                    title: this.$t('backend.customer.create-customers.title_muy_bien_toast'),
                                    message: this.$t('backend.team.create-teams.titulo_miembro_creado_correctamente'),
                                    showDuration: 1000,
                                    hideDuration: 5000,
                                    position: 'top right',
                                })
                                // console.log('/'+this.language+"/profile")
                                window.location = '/' + this.language + "/new-member";
                            }).catch(err => {
                                this.$toast.error({
                                    title: this.$t('backend.customer.create-customers.title_atención_toast'),
                                    message: err,
                                    showDuration: 1000,
                                    hideDuration: 8000,
                                })
                                resp.$vs.loading.close()
                            });

                        }
                    })


            }, 200)
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
            if (this.userName) {
                this.addArchive = true
                this.eventSelectScroll('#add-archive-dropzone-team')
            } else {
                this.$toast.error({
                    title: this.$t('backend.customer.create-customers.title_atención_toast'),
                    message: 'Para agregar archivos, debe ingresar un' +
                        ' nombre',
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
