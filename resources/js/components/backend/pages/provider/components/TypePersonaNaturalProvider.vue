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
                            @on-complete="createNewCustomer()"
                            ref="wizard"
                        >
                            <!------------------------------
                              TAB DATOS DEL REPRESENTANTE
                            -------------------------------->
                            <tab-content
                                :title="$t('backend.customer.create-customers.titulo_wizard_datos_cliente')"
                                :beforeChange="validarTab"
                            >
                                <section style="width: 100%">
                                    <div class="row">
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <input-form
                                                id="txtNameUserCustomer"
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
                                                :label="$t('backend.customer.create-customers.titulo_seleccionar_categoria_cliente')"
                                                id="txtTypeCompany"
                                                errorMsg
                                                :requiredMsg="$t('backend.customer.create-customers.titulo_obligatrio_selecciona_categoria_cliente')"
                                                :required="true"
                                                :modelo.sync="user.typeCompany"
                                                :msgServer.sync="errors.typeCompany"
                                                type="multiselect"
                                                :selectLabel="$t('backend.customer.create-customers.titulo_buscar_selecciona_categoria_cliente')"
                                                :multiselect="{
                                           options: optionsTypeCompanies,
                                           selectLabel:this.$t('backend.customer.create-customers.multiselect_seleccionar'),
                                           selectedLabel:this.$t('backend.customer.create-customers.multiselect_seleccionado'),
                                           deselectLabel:this.$t('backend.customer.create-customers.multiselect_desmarcar'),
                                          placeholder:this.$t('backend.customer.create-customers.titulo_seleccionar_categoria_cliente'),
                                          taggable : true,
                                          'track-by':'id',
                                          label: 'name',
                                          'custom-label': typeCompany=>typeCompany.name[language]
                                        }"
                                            ></input-form>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <input-form
                                                :label="$t('backend.customer.create-customers.titulo_tipo_posicion')"
                                                id="txtTypePosition"
                                                errorMsg
                                                :requiredMsg="$t('backend.customer.create-customers.titulo_requerido_tipo_posicion')"
                                                :required="true"
                                                :modelo.sync="user.valueTypePosition"
                                                :msgServer.sync="errors.valueTypePosition"
                                                type="multiselect"
                                                selectLabel="Tipo de documento"
                                                :multiselect="{ options: optionsTypePosition,
                                           selectLabel:this.$t('backend.customer.create-customers.multiselect_seleccionar'),
                                           selectedLabel:this.$t('backend.customer.create-customers.multiselect_seleccionado'),
                                           deselectLabel:this.$t('backend.customer.create-customers.multiselect_desmarcar'),
                                          placeholder:this.$t('backend.customer.create-customers.titulo_seleccionar_tipo_position'),
                                          taggable : true,
                                          'track-by':'id',
                                          label: 'name',
                                          'custom-label': positionType=>positionType.name[language]
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
                                            <!-- Boton para agregar redes sociales -->
                                            <button v-if="addSocialNetworksNatural === false"
                                                    @click="addSocialNetworksNatural = true"
                                                    type="button"
                                                    class="btn btn-primary waves-effect waves-float waves-light"
                                                    style="font-size: 0.92rem">
                                                {{ $t('backend.customer.create-customers.btn_agregar_redes') }}
                                            </button>
                                            <button v-if="addSocialNetworksNatural === true"
                                                    @click="btnCancelSocialNetworksNatural"
                                                    type="button"
                                                    class="btn btn-primary waves-effect waves-float waves-light"
                                                    style="font-size: 0.92rem">
                                                {{ $t('backend.customer.create-customers.btn_no_agregar_redes') }}
                                            </button>
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
                                    <hr v-if="addSocialNetworksNatural || addArchive">
                                    <div class="row pt-2" v-if="addSocialNetworksNatural">

                                        <div class="col-12 col-lg-6 col-md-6 profiling">

                                            <input-form
                                                :label="$t('backend.customer.create-customers.titulo_seleccionar_redes_sociales')"
                                                id="txtSocialNetworks"
                                                :requiredMsg="$t('backend.customer.create-customers.titulo_requerido_selecciona_redes_sociales')"
                                                :required="true"
                                                :modelo.sync="objectSocialNetworks"
                                                :msgServer.sync="errors.objectSocialNetworks"
                                                type="multiselect"
                                                selectLabel=""
                                                :multiselect="{ 'tag-placeholder' : '',
                                          // selectLabel   : $t('company.multiselect.select'),
                                          // selectedLabel : $t('company.multiselect.selected'),
                                          // deselectLabel : $t('company.multiselect.remove'),
                                          placeholder : $t('backend.customer.create-customers.titulo_seleccionar_redes_sociales'),
                                          label : 'social',
                                          'track-by' : 'id',
                                          options : listSocialNetworks,
                                          multiple : true,
                                          taggable : true,
                                          'custom-label': obj => obj.social
                                        }"
                                                @tag="addTagSocialInputs"
                                            ></input-form>
                                        </div>
                                    </div>
                                    <div class="row" v-if="objectSocialNetworks">
                                        <div
                                            v-for="inputsSocial in objectSocialNetworks"
                                            :key="inputsSocial.id"
                                            class="col-md-4 col-lg-4 col-12"
                                        >
                                            <input-form
                                                :label="'Link '+inputsSocial.social"
                                                :id="'txt'+inputsSocial+'SocialNewtwork'"
                                                pattern="url"
                                                :placeholder="inputsSocial.social+'url'"
                                                :errorMsg="$t('backend.customer.create-customers.error_msg_url')"
                                                :requiredMsg="$t('backend.customer.create-customers.requerido_msg_url')"
                                                :required="true"
                                                :modelo.sync="inputsSocial.model"
                                            ></input-form>
                                        </div>
                                    </div>
                                    <div class="row pt-1" v-if="addArchive">
                                        <div class="col-12">
                                            <label class="form-control-label" id="add-archive-dropzone-provider-natural">{{ $t('backend.customer.create-customers.title_label_agregar_archivos') }}</label>
                                            <vue2Dropzone class="dropzone upload-logo dropzone-area dz-clickable"
                                                          ref="myVueDropzone"
                                                          @vdropzone-sending="sendingEvent"
                                                          @vdropzone-max-files-exceeded="maxFiles"
                                                          @vdropzone-success="addArchivePersonNaturalCustomer"
                                                          @vdropzone-removed-file="removedArchiveDropzonePersonNaturalCustomer"
                                                          id="dpz-archives-customer-company"
                                                          :options="dropzoneOptionsCompanyArchive">

                                            </vue2Dropzone>
                                        </div>
                                    </div>
                                </section>
                            </tab-content>
                            <!------------------------------
                              TAB CONFIRMAR DATOS
                            -------------------------------->
                            <tab-content
                                :title="$t('backend.customer.create-customers.titulo_wizard_confirmar_datos')"
                                :beforeChange="validarTab"
                            >
                                <section style="width: 100%" v-if="currentTab===1">
                                    <h3 class="d-flex justify-content-center pb-2">
                                        {{
                                            $t('backend.provider.create-provider.titulo_wizard_datos_cliente')
                                        }}</h3>
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
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>{{
                                                        $t('backend.customer.create-customers.title_confirmar_tipo_cliente')
                                                    }}:</label>
                                                <p v-text="type_client.name[language]"></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>{{
                                                        $t('backend.customer.create-customers.titulo_tipo_posicion')
                                                    }}:</label>
                                                <p v-text="user.valueTypePosition.name[language]"></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>{{
                                                        $t('backend.customer.create-customers.title_confirmar_categoria')
                                                    }}:</label>
                                                <p v-text="user.typeCompany.name[language]"></p>
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
                                        <div v-if="objectSocialNetworks" class="col-12 col-md-4 col-lg-4"
                                             v-for="(socialNetworks, index) in objectSocialNetworks"
                                             :key="socialNetworks.id">
                                            <div class="form-group">
                                                <label>Social {{ index + 1 }}:</label><br>
                                                <a target="_blank" :href="socialNetworks.model">{{
                                                        socialNetworks.social
                                                    }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row"  v-if="urlsArchivePersonNatural.length > 0">
                                        <div class="col-12">
                                            <label>{{ $t('backend.customer.create-customers.titulo_archives') }}:</label>
                                        </div>
                                    </div>
                                    <div class="content-body" v-if="urlsArchivePersonNatural.length > 0 ">
                                        <div class="row">
                                            <div class="col-12 col-lg-3 col-md-3" v-for="archives in urlsArchivePersonNatural" :key="archives.uuid">
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
                                                            <small class="text-muted">{{ $t('backend.customer.create-customers.titulo_vista_previa') }}</small>
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

                                    <wizard-button v-else @click.native="createNewCustomer()"
                                                   class="wizard-footer-right finish-button"
                                                   :style="props.fillButtonStyle">
                                        {{
                                            props.isLastStep ? $t('backend.provider.create-provider.btn_titulo_wizard_create_empresa') : $t('backend.customer.create-customers.btn_titulo_wizard_siguiente')
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
import Multiselect from "vue-multiselect";
import VuePhoneNumberInput from "vue-phone-number-input";
import "vue-phone-number-input/dist/vue-phone-number-input.css";
import vue2Dropzone from 'vue2-dropzone'
// import 'vue2-dropzone/dist/vue2Dropzone.min.css'
export default {
    name: "TypePersonaNaturalProvider",
    components: {
        Multiselect,
        VuePhoneNumberInput,
        vue2Dropzone
    },
    data() {
        return {
            csrf_token: window.token,
            language: window.lang,
            titleNameArchive: null,
            popupPreviewActivo: false,
            languageEmail: null,
            textValidaNameAddArchive: false,
            addSocialNetworksNatural: false,
            addBiography: false,
            colorLoading: '#3f4f6e',
            addArchive: false,
            urlsArchivePersonNatural: [],
            userName: '',
            dataArchive:[
                {
                    urlArchive:null
                },
                {
                    extension:null
                }
            ],
            user: {
                last_name: '',
                email: '',
                phone: '',
                address:'',
                typeCompany: null,
                valueCountryUser: null,
                valueCityUser: null,
                valueIdentificationType: null,
                valueTypePosition: null,
                identification: ''
            },
            email: '',
            emailverify: '',
            emailCompany: '',
            emailverifyCompany: '',
            valueCreator: '',
            currentTab: 0,
            optionsCities: [],
            optionsCountries: [],
            optionsTypeCompanies: [],
            optionsIdentificationType: [],
            optionsTypePosition: [],
            optionsLanguage: [
                {id: 1, name: this.$t('Español'), code: 'es'},
                {id: 2, name: this.$t('Inglés'), code: 'en'},
            ],
            objectSocialNetworks: [],
            listSocialNetworks: [
                {social: "YouTube", model: "", id: 1},
                {social: "Facebook", model: "", id: 2},
                {social: "Instagram", model: "", id: 3},
                {social: "Spotify", model: "", id: 4},
                {social: "Apple Music", model: "", id: 5},
                {social: "TikTok", model: "", id: 6},
                {social: "Twitch", model: "", id: 9},
                {social: "Twitter", model: "", id: 8},
                {social: "Website", model: "", id: 7}
            ],
            urlYoutube: '',
            urlFacebook: '',
            urlInstagram: '',
            urlSpotify: '',
            urlAppleMusic: '',
            urlTiktok: '',
            urlTwitch: '',
            urlTwitter: '',
            urlWebSite: '',
            errors: {},
            dropzoneOptionsCompanyArchive: {
                url: '/api/upload-archive-company',
                // thumbnailWidth: 200,
                maxFilesize: 10,
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
        openModalArchivePopup(data, nameArchive) {
            this.dataArchive = data
            this.popupPreviewActivo = true
            this.titleNameArchive = nameArchive
            // this.infoModalRecording = question
        },
        sendingEvent(file, xhr, formData) {
            console.log('upload file', file.upload);
            formData.append('nameCompany', this.userName);
            formData.append('nameId', file.upload.uuid);
        },

        removedArchiveDropzonePersonNaturalCustomer(file, error, xhr) {
            console.log('remove file ', file.upload.uuid);
            let uuid = file.upload.uuid

            for (let i = 0; i < this.urlsArchivePersonNatural.length; i++) {
                if (this.urlsArchivePersonNatural[i].uuid === uuid) {
                    const data = new FormData();
                    data.append("archiveCompany", this.urlsArchivePersonNatural[i].urlArchive);
                    axios.post('/api/removed-archive-company', data)
                        .then(resp => {
                            this.$toast.success({
                                title: this.$t('backend.customer.create-customers.title_muy_bien_toast'),
                                message: this.$t('backend.customer.create-customers.title_mensaje_success_toast_remove_image'),
                                showDuration: 1000,
                                hideDuration: 5000,
                                position: 'top right',
                            })
                            this.urlsArchivePersonNatural.splice(i, 1);
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
            }
        },
        addArchivePersonNaturalCustomer(file, response) {
            this.urlsArchivePersonNatural.push({
                nameArchive: file.name,
                urlArchive: response.data,
                uuid: response.uuid,
                extension: response.extension
            })
            if (this.urlsArchivePersonNatural) {
                this.textValidaNameAddArchive = true
                setTimeout(()=>{
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
        /******************************************************
         METODOS DE VALIDACIONES AGREGAR REDES SOCIALES
         *******************************************************/
        validateUrlSocialNetworks(socialNetworks) {
            socialNetworks.map(social => {
                switch (social.social) {
                    case "YouTube":
                        this.urlYoutube = social.model;
                        break;
                    case "Facebook":
                        this.urlFacebook = social.model;
                        break;
                    case "Instagram":
                        this.urlInstagram = social.model;
                        break;
                    case "Spotify":
                        this.urlSpotify = social.model;
                        break;
                    case "Apple Music":
                        this.urlAppleMusic = social.model;
                        break;
                    case "TikTok":
                        this.urlTiktok = social.model;
                        break;
                    case "Twitter":
                        this.urlTwitter = social.model;
                        break;
                    case "Twitch":
                        this.urlTwitch = social.model;
                        break;
                    case "Website":
                        this.urlWebSite = social.model;
                        break;
                }
                return social;
            });
        },
        createNewCustomer() {
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
                if (this.objectSocialNetworks !== null) {
                    this.validateUrlSocialNetworks(this.objectSocialNetworks);
                }
                data.append('languageEmail', JSON.stringify(this.languageEmail));
                /***  DATOS DEL REPRESENTANTE  ***/
                this.dataSendRepresentavie(data);
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
                            text: this.$t('backend.customer.create-customers.titulo_loading_creando_persona_natural')
                        })
                        axios.post('/api/register/store-provider-person-natural', data).then(res => {
                            resp.$vs.loading.close()
                            this.$toast.success({
                                title: this.$t('backend.customer.create-customers.title_muy_bien_toast'),
                                message: this.$t('backend.customer.create-customers.title_mensaje_success_toast_register_persona_natural'),
                                showDuration: 1000,
                                hideDuration: 5000,
                                position: 'top right',
                            })
                            // console.log('/'+this.language+"/profile")
                            window.location = '/' + this.language + "/new-providers";
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
                });
            }, 200)
        },

        dataSendRepresentavie(data) {
            data.append('nameRepresent', this.userName);
            data.append('lastNameRepresent', this.user.last_name);
            data.append('emailRepresent', this.email);
            data.append('addressRepresent', this.user.address);
            data.append('phoneRepresent', this.user.phoneI);
            data.append('typeIdentRepresent', JSON.stringify(this.user.valueIdentificationType))
            data.append('typePositionRepresent', JSON.stringify(this.user.valueTypePosition))
            data.append('identificationRepresent', this.user.identification);
            data.append('typeCompany', JSON.stringify(this.user.typeCompany))
            data.append('typeEntity', JSON.stringify(this.type_client))
            if (this.user.valueCityUser) {
                data.append('userCity', JSON.stringify(this.user.valueCityUser));
            }
            data.append('userCountry', JSON.stringify(this.user.valueCountryUser));
            data.append('url_youtube', this.urlYoutube);
            data.append('url_instagram', this.urlInstagram);
            data.append('url_applemusic', this.urlAppleMusic);
            data.append('url_facebook', this.urlFacebook);
            data.append('url_spotify', this.urlSpotify);
            data.append('url_tiktok', this.urlTiktok);
            data.append('url_twitch', this.urlTwitch);
            data.append('url_twitter', this.urlTwitter);
            data.append('url_website', this.urlWebSite);
            data.append('archives',JSON.stringify(this.urlsArchivePersonNatural));
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

        cambioPagina(prevIndex, nextIndex) {
            this.currentTab = nextIndex;
        },
        getCities(iddepartamento) {
            console.log(iddepartamento);
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
                    })
            }
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
            });
        },
        getTypeCompany() {
            axios.get('/api/get-type-company').then(resp => {
                this.optionsTypeCompanies = resp.data.data
            }).catch(err => {
                this.$toast.error({
                    title: this.$t('backend.customer.create-customers.title_error_toast'),
                    message: this.$t('backend.customer.create-customers.title_mensaje_error_toast'),
                    showDuration: 1000,
                    hideDuration: 5000,
                    position: 'top right',
                })
            })
        },
        getTypePosition() {
            axios.get('/api/get-type-position').then(resp => {
                this.optionsTypePosition = resp.data.data
            }).catch(err => {
                this.$toast.error({
                    title: this.$t('backend.customer.create-customers.title_error_toast'),
                    message: this.$t('backend.customer.create-customers.title_mensaje_error_toast'),
                    showDuration: 1000,
                    hideDuration: 5000,
                    position: 'top right',
                })
            })
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
            });
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
        addFileUpload(file, response) {
            this.company.picture = response;
            console.log(file);
            this.company.picturePreview = file.dataURL;
            setTimeout(() => {
                this.$toast.success({
                    title: this.$t('backend.customer.create-customers.title_muy_bien_toast'),
                    message: this.$t('backend.customer.create-customers.title_mensaje_success_toast'),
                    showDuration: 1000,
                    hideDuration: 5000,
                    position: 'top right',
                })
            }, 1000);
        },
        removedImage() {
            let imageCompany = this.company.picture.data;
            this.company.picturePreview = null;
            this.company.picture = null;
            const data = new FormData();
            data.append("pictureCompany", imageCompany);
            axios.post('/api/removed-picture-company', data)
                .then(resp => {
                    this.$toast.success({
                        title: this.$t('backend.customer.create-customers.title_muy_bien_toast'),
                        message: this.$t('backend.customer.create-customers.title_mensaje_success_toast_remove_image'),
                        showDuration: 1000,
                        hideDuration: 5000,
                        position: 'top right',
                    })
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
        errorMessage(file, message, xhr) {
            this.$toast.error({
                title: this.$t('backend.customer.create-customers.title_atención_toast'),
                message: message,
                showDuration: 1000,
                hideDuration: 8000,
            })
        },
        addTagSocialInputs(newTag) {
            const tag = {
                name: newTag,
                code: newTag.substring(0, 2) + Math.floor(Math.random() * 10000000)
            };
            this.options.push(tag);
            this.value.push(tag);
        },
        btnCancelSocialNetworksNatural() {
            this.addSocialNetworksNatural = false
            this.objectSocialNetworks = null
        },
        btnCancelBiography() {
            this.addBiography = false
            this.biography = ''
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
                this.eventSelectScroll('#add-archive-dropzone-provider-natural')
            } else {
                this.$toast.error({
                    title: this.$t('backend.customer.create-customers.title_atención_toast'),
                    message: this.$t('backend.customer.create-customers.title_mensaje_para_agregar_archivos_person_natural'),
                    showDuration: 1000,
                    hideDuration: 8000,
                })
            }

        },
        btnCancelAddArchives() {
            this.addArchive = false

            for (let i = 0; i < this.urlsArchivePersonNatural.length; i++) {
                const data = new FormData();
                data.append("archiveCompany", this.urlsArchivePersonNatural[i].urlArchive);
                setTimeout(() => {
                    axios.post('/api/removed-archive-company', data)
                        .then(resp => {
                            this.$toast.success({
                                title: this.$t('backend.customer.create-customers.title_muy_bien_toast'),
                                message: this.$t('backend.customer.create-customers.title_mensaje_success_toast_remove_image'),
                                showDuration: 1000,
                                hideDuration: 5000,
                                position: 'top right',
                            })
                            this.urlsArchivePersonNatural.splice(i, 1);
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

            this.urlsArchivePersonNatural = [];
            this.textValidaNameAddArchive = false
        },
    },
    watch: {
        userName: function (val) {
            if (!val && this.addArchive === true) {
                this.addArchive = false
                this.$toast.error({
                    title: this.$t('backend.customer.create-customers.title_atención_toast'),
                    message: this.$t('backend.customer.create-customers.title_mensaje_para_agregar_archivos_person_natural'),
                    showDuration: 1000,
                    hideDuration: 8000,
                })
                for (let i = 0; i < this.urlsArchivePersonNatural.length; i++) {
                    const data = new FormData();
                    data.append("archiveCompany", this.urlsArchivePersonNatural[i].urlArchive);
                    setTimeout(() => {
                        axios.post('/api/removed-archive-company', data)
                            .then(resp => {
                                this.$toast.success({
                                    title: this.$t('backend.customer.create-customers.title_muy_bien_toast'),
                                    message: this.$t('backend.customer.create-customers.title_mensaje_success_toast_remove_image'),
                                    showDuration: 1000,
                                    hideDuration: 5000,
                                    position: 'top right',
                                })
                                this.urlsArchivePersonNatural.splice(i, 1);
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
                this.urlsArchivePersonNatural = [];
                this.textValidaNameAddArchive = false
            }
        },
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
        emailCompany: function (val) {
            let data = this
            if (val) {
                axios.get('/api/verify-email-company/' + val)
                    .then(resp => {
                        if (resp.data) {
                            $("#txtCompanyEmail").addClass("is-invalid");
                            $("#text-verify-email-company").css("display", "block");
                        } else {
                            data.emailverifyCompany = ''
                            $("#txtCompanyEmail").removeClass("is-invalid");
                            $("#text-verify-email-company").css("display", "none");
                        }
                    }).catch(err => {
                });
            }
        },
        urlsArchivePersonNatural: function (val) {
            if (!val.length) {
                document.getElementById('txtNameUserCustomer').disabled = false;
                this.textValidaNameAddArchive = false
            }
        }
    },
    props: ['type_client'],
    mounted() {
        this.getCountries();
        this.getIdentificationType();
        this.getTypeCompany();
        this.getTypePosition();
    }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
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


