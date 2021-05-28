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
                            finishButtonText="Crear Entidad"
                            nextButtonText="Siguiente"
                            backButtonText="Atrás"
                            shape="tab"
                            error-color="#ff4949"
                            @on-change="cambioPagina"
                            @on-complete="createNewEntity()"
                            ref="wizard"
                        >
                            <!------------------------------
                              TAB DATOS DE LA ENTIDAD
                            -------------------------------->
                            <tab-content
                                :title="$t('backend.customer.create-customers.titulo_wizard_datos_empresa')"
                                :beforeChange="validarTab"
                            >
                                <section class="pb-5" style="width: 100%; height: 100%">
                                    <div class="justify-content-center d-flex pb-3" v-if="addLogo">
                                        <vue2Dropzone class="dropzone upload-logo dropzone-area dz-clickable"
                                                      ref="myVueDropzone"
                                                      @vdropzone-max-files-exceeded="maxFiles"
                                                      @vdropzone-error="erroMessage"
                                                      @vdropzone-success="addFileUpload"
                                                      @vdropzone-removed-file="removedImage"
                                                      id="dpz-single-file"
                                                      :options="dropzoneOptions">

                                        </vue2Dropzone>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <input-form
                                                id="txtNameCompany"
                                                :label="$t('backend.customer.create-customers.titulo_nombre_empresa')"
                                                pattern="alf"
                                                :errorMsg="$t('backend.customer.create-customers.titulo_error_nombre_empresa')"
                                                :requiredMsg="$t('backend.customer.create-customers.titulo_obligatrio_nombre_empresa')"
                                                :modelo.sync="companyName"
                                                :required="true"
                                                :msgServer.sync="errors.companyName"
                                            ></input-form>
                                            <p v-if="textValidaNameAddArchive">{{
                                                    $t('backend.customer.create-customers.title_estas_agregando_archivos_person_natural_customer')
                                                }}</p>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <input-form
                                                id="txtAddress"
                                                :label="$t('backend.customer.create-customers.titulo_direccion')"
                                                pattern="all"
                                                :errorMsg="$t('backend.customer.create-customers.titulo_error_direccion')"
                                                :requiredMsg="$t('backend.customer.create-customers.titulo_obligatrio_direccion')"
                                                :modelo.sync="company.address"
                                                :required="true"
                                                :msgServer.sync="errors.address"
                                            ></input-form>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <input-form
                                                id="txtCompnayEmail"
                                                :label="$t('backend.customer.create-customers.titulo_email')"
                                                pattern="email"
                                                :errorMsg="$t('backend.customer.create-customers.titulo_error_email')"
                                                :requiredMsg="$t('backend.customer.create-customers.titulo_obligatrio_email')"
                                                :modelo.sync="emailCompany"
                                                :required="true"
                                                :msgServer.sync="errors.emailCompany"
                                            ></input-form>
                                            <p style="margin-top: -1rem;font-size: 0.9rem; display: none"
                                               id="text-verify-email-company" class="text-danger">{{
                                                    $t('backend.customer.create-customers.titulo_msg_validar_email')
                                                }}</p>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <input-form
                                                id="txtNit"
                                                :label="$t('backend.customer.create-customers.titulo_nit')"
                                                pattern="all"
                                                :errorMsg="$t('backend.customer.create-customers.titulo_error_nit')"
                                                :requiredMsg="$t('backend.customer.create-customers.titulo_obligatrio_nit')"
                                                :modelo.sync="company.nit"
                                                :required="true"
                                                :msgServer.sync="errors.nit"
                                            ></input-form>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <input-form
                                                :label="$t('backend.customer.create-customers.titulo_seleccionar_tipo_empresa')"
                                                id="txtTypeCompany"
                                                errorMsg
                                                :requiredMsg="$t('backend.customer.create-customers.titulo_obligatrio_selecciona_tipo_empresa')"
                                                :required="true"
                                                :modelo.sync="company.typeCompany"
                                                :msgServer.sync="errors.typeCompany"
                                                type="multiselect"
                                                :selectLabel="$t('backend.customer.create-customers.titulo_buscar_selecciona_tipo_empresa')"
                                                :multiselect="{
                                           options: optionsTypeCompanies,
                                           selectLabel:this.$t('backend.customer.create-customers.multiselect_seleccionar'),
                                           selectedLabel:this.$t('backend.customer.create-customers.multiselect_seleccionado'),
                                           deselectLabel:this.$t('backend.customer.create-customers.multiselect_desmarcar'),
                                          placeholder:this.$t('backend.customer.create-customers.titulo_seleccionar_tipo_empresa'),
                                          taggable : true,
                                          'track-by':'id',
                                          label: 'name',
                                          'custom-label': typeCompany=>typeCompany.name[language]
                                        }"
                                            ></input-form>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <label class="form-control-label label-selects">{{
                                                    $t('backend.customer.create-customers.titulo_telefono')
                                                }}</label>
                                            <VuePhoneNumberInput
                                                v-model="company.phone"
                                                :required="true"
                                                :requiredMsg="$t('backend.customer.create-customers.titulo_obligatrio_telefono')"
                                                @update="company.phoneI=$event.formatInternational"
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
                                                :label="$t('backend.customer.create-customers.titulo_seleccionar_pais')"
                                                id="txtCategoryProfiling"
                                                errorMsg
                                                :requiredMsg="$t('backend.customer.create-customers.titulo_obligatrio_selecciona_pais')"
                                                :required="true"
                                                :modelo.sync="company.valueCountry"
                                                :msgServer.sync="errors.valueCountry"
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
                                          'custom-label': departaments=>departaments.name
                                        }"
                                            ></input-form>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4" v-if="company.valueCountry">
                                            <input-form
                                                class="input-label-register"
                                                :label="$t('backend.customer.create-customers.titulo_seleccionar_ciudad')"
                                                id="txtCity"
                                                errorMsg
                                                :requiredMsg="$t('backend.customer.create-customers.titulo_obligatrio_selecciona_ciudad')"
                                                :required="false"
                                                :modelo.sync="company.valueCity"
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
                                        <!-- Boton para agregar logo -->
                                        <div class="demo-inline-spacing">
                                            <button v-if="addLogo === false" @click="addLogo = true" type="button"
                                                    class="btn btn-primary waves-effect waves-float waves-light"
                                                    style="font-size: 0.92rem">
                                                {{ $t('backend.customer.create-customers.btn_agregar_logo') }}
                                            </button>
                                            <button v-if="addLogo === true" @click="btnCancelAddLogo" type="button"
                                                    class="btn btn-primary waves-effect waves-float waves-light"
                                                    style="font-size: 0.92rem">
                                                {{ $t('backend.customer.create-customers.btn_no_agregar_logo') }}
                                            </button>

                                            <!-- Boton para agregar redes sociales -->
                                            <button v-if="addSocialNetworks === false" @click="addSocialNetworks = true"
                                                    type="button"
                                                    class="btn btn-primary waves-effect waves-float waves-light"
                                                    style="font-size: 0.92rem">
                                                {{ $t('backend.customer.create-customers.btn_agregar_redes') }}
                                            </button>
                                            <button v-if="addSocialNetworks === true" @click="btnCancelSocialNetworks"
                                                    type="button"
                                                    class="btn btn-primary waves-effect waves-float waves-light"
                                                    style="font-size: 0.92rem">
                                                {{ $t('backend.customer.create-customers.btn_no_agregar_redes') }}
                                            </button>
                                            <!-- Boton para agregar redes sociales -->
                                            <button v-if="addBiography === false" @click="addBiography = true"
                                                    type="button"
                                                    class="btn btn-primary waves-effect waves-float waves-light"
                                                    style="font-size: 0.92rem">
                                                {{ $t('backend.customer.create-customers.btn_agregar_biografia') }}
                                            </button>
                                            <button v-if="addBiography === true" @click="btnCancelBiography"
                                                    type="button"
                                                    class="btn btn-primary waves-effect waves-float waves-light"
                                                    style="font-size: 0.92rem">
                                                {{ $t('backend.customer.create-customers.btn_no_agregar_biografia') }}
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
                                    <hr v-if="addSocialNetworks || addBiography || addArchive">
                                    <div class="row pt-2" v-if="addSocialNetworks">

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
                                    <div class="row" v-if="addBiography">
                                        <div class="col-12 col-md-12 col-lg-12">
                                            <input-form
                                                type="textarea"
                                                :label="$t('backend.customer.create-customers.titulo_company_biografia')"
                                                id="txtBudgetDescription"
                                                pattern="all"
                                                :errorMsg="$t('backend.customer.create-customers.titulo_company_error_biografia')"
                                                :requiredMsg="$t('backend.customer.create-customers.titulo_company_requerido_biografia')"
                                                :required="true"
                                                :modelo.sync="company.biography"
                                                :msgServer.sync="errors.biography"
                                                :options="{
                                                rows: 5
                                                }"
                                            >
                                            </input-form>
                                        </div>
                                    </div>
                                    <div class="row" v-if="addArchive">
                                        <div class="col-12">
                                            <label class="form-control-label">{{ $t('backend.customer.create-customers.title_label_agregar_archivos') }}</label>
                                            <vue2Dropzone class="dropzone upload-logo dropzone-area dz-clickable"
                                                          ref="myVueDropzone"
                                                          @vdropzone-sending="sendingEvent"
                                                          @vdropzone-max-files-exceeded="maxFiles"
                                                          @vdropzone-success="addArchiveCompanyCustomer"
                                                          @vdropzone-removed-file="removedArchiveDropzoneCompanyCustomer"
                                                          id="dpz-archives-customer-company"
                                                          :options="dropzoneOptionsCompanyArchive">

                                            </vue2Dropzone>
                                        </div>
                                    </div>
                                </section>
                            </tab-content>
                            <!------------------------------
                              TAB DATOS DEL REPRESENTANTE
                            -------------------------------->
                            <tab-content
                                :title="$t('backend.customer.create-customers.titulo_wizard_datos_representante')"
                                :beforeChange="validarTab"
                            >
                                <section style="width: 100%" v-if="currentTab===1">
                                    <div class="row">
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <input-form
                                                id="txtUserName"
                                                :label="$t('backend.customer.create-customers.titulo_nombre_representante')"
                                                pattern="alf"
                                                :errorMsg="$t('backend.customer.create-customers.titulo_error_nombre_representante')"
                                                :requiredMsg="$t('backend.customer.create-customers.titulo_obligatrio_nombre_representante')"
                                                :modelo.sync="user.name"
                                                :required="true"
                                                :msgServer.sync="errors.name"
                                            ></input-form>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <input-form
                                                id="txtUserLastName"
                                                :label="$t('backend.customer.create-customers.titulo_apellidos_representante')"
                                                pattern="alf"
                                                :errorMsg="$t('backend.customer.create-customers.titulo_error_apellidos_representante')"
                                                :requiredMsg="$t('backend.customer.create-customers.titulo_obligatrio_apellidos_representante')"
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

                                </section>
                            </tab-content>
                            <!------------------------------
                              TAB CONFIRMAR DATOS
                            -------------------------------->
                            <tab-content
                                :title="$t('backend.customer.create-customers.titulo_wizard_confirmar_datos')"
                                :beforeChange="validarTab"
                            >
                                <section style="width: 100%" v-if="currentTab===2">
                                    <div class="row pb-3" v-if="company.picturePreview">
                                        <div class="col-12 col-md-12 col-lg-12 d-flex justify-content-center">
                                            <div class="form-group mb-0">
                                                <img class="img-fluid img-thumbnail" width="200"
                                                     :src="company.picturePreview" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <h3 class="d-flex justify-content-center pb-2 pt-2">
                                        {{ $t('backend.customer.create-customers.titulo_wizard_datos_empresa') }}</h3>
                                    <div class="row">
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>{{
                                                        $t('backend.customer.create-customers.titulo_nombre_empresa')
                                                    }}:</label>
                                                <p v-text="companyName"></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>{{
                                                        $t('backend.customer.create-customers.titulo_direccion')
                                                    }}:</label>
                                                <p v-text="company.address"></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>{{
                                                        $t('backend.customer.create-customers.titulo_email')
                                                    }}:</label>
                                                <p v-text="emailCompany"></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>{{
                                                        $t('backend.customer.create-customers.titulo_telefono')
                                                    }}:</label>
                                                <p v-text="company.phoneI"></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>{{ $t('backend.customer.create-customers.titulo_nit') }}:</label>
                                                <p v-text="company.nit"></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>{{
                                                        $t('backend.customer.create-customers.titulo_tipo_empresa')
                                                    }}:</label>
                                                <p v-text="company.typeCompany.name[language]"></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>{{
                                                        $t('backend.customer.create-customers.titulo_pais')
                                                    }}:</label>
                                                <p v-text="company.valueCountry.name"></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4" v-if="company.valueCity">
                                            <div class="form-group">
                                                <label>{{
                                                        $t('backend.customer.create-customers.titulo_ciudad')
                                                    }}:</label>
                                                <p v-text="company.valueCity.name"></p>
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
                                    <hr>
                                    <h3 class="d-flex justify-content-center pb-2">
                                        {{
                                            $t('backend.customer.create-customers.titulo_wizard_datos_representante')
                                        }}</h3>
                                    <div class="row">
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>{{
                                                        $t('backend.customer.create-customers.titulo_nombre')
                                                    }}:</label>
                                                <p v-text="user.name"></p>
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
                                    </div>
                                    <div class="row"  v-if="urlsArchiveCompany.length > 0">
                                        <div class="col-12">
                                            <label>Archivos:</label>
                                        </div>
                                    </div>
                                    <div class="content-body" v-if="urlsArchiveCompany.length > 0 ">
                                        <div class="row">
                                            <div class="col-12 col-lg-3 col-md-3" v-for="archives in urlsArchiveCompany" :key="archives.uuid">
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
                                                            <small class="text-muted">Vista Previa</small>
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

                                    <wizard-button v-else @click.native="createNewEntity()"
                                                   class="wizard-footer-right finish-button"
                                                   :style="props.fillButtonStyle">
                                        {{
                                            props.isLastStep ? $t('backend.customer.create-customers.btn_titulo_wizard_create_empresa') : $t('backend.customer.create-customers.btn_titulo_wizard_siguiente')
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
    name: "TypeCompany",
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
            languageEmail: null,
            addLogo: false,
            addSocialNetworks: false,
            textValidaNameAddArchive: false,
            addBiography: false,
            addArchive: false,
            colorLoading: '#3f4f6e',
            popupPreviewActivo: false,
            urlsArchiveCompany: [],
            companyName:'',
            dataArchive:[
                {
                    urlArchive:null
                },
                {
                    extension:null
                }
            ],
            company: {
                address: '',
                phone: '',
                email: '',
                biography: '',
                nit: null,
                valueCountry: null,
                typeCompany: null,
                valueCity: null,
                picture: null,
                picturePreview: null,
                urlPicture: null,
            },
            user: {
                name: '',
                last_name: '',
                email: '',
                phone: '',
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
            dropzoneOptions: {
                url: '/api/upload-picture-company',
                // thumbnailWidth: 200,
                maxFilesize: 1,
                maxFiles: 20,
                paramName: 'picture',
                acceptedFiles: 'image/jpeg,image/png,image/gif',
                addRemoveLinks: true,
                dictDefaultMessage: this.$t('backend.customer.create-customers.titulo_mensaje_dropzone'),
                dictMaxFilesExceeded: this.$t('backend.customer.create-customers.msg_dropzone_no_puede_subir_mas_archivos'),
                dictFileTooBig: this.$t('backend.customer.create-customers.msg_uno_el_archivo_demasiado') + " ({{filesize}}MiB). " + this.$t('backend.customer.create-customers.msg_dos_tamaño_maximo') + " {{maxFilesize}}MiB.",
                dictRemoveFile: this.$t('backend.customer.create-customers.msg_tres_remover_archivo'),
                dictInvalidFileType: this.$t('backend.customer.create-customers.msg_error_tipo_archivo'),
                headers: {
                    'X-CSRF-TOKEN': this.csrf_token //Este token lo pasamos por los props
                },
                // params: {id: this.entity_get_data.id}  //Para enviar parametros
            },
            dropzoneOptionsCompanyArchive: {
                url: '/api/upload-archive-company',
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
        openModalArchivePopup(data, nameArchive) {
            this.dataArchive = data
            this.popupPreviewActivo = true
            this.titleNameArchive = nameArchive
            // this.infoModalRecording = question
        },
        sendingEvent(file, xhr, formData) {
            console.log('upload file', file.upload);
            formData.append('nameCompany', this.companyName);
            formData.append('nameId', file.upload.uuid);
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
        createNewEntity() {
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
                /***  DATOS DE LA EMPRESA  ***/
                this.dataSendCompany(data);
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
                            text: this.$t('backend.customer.create-customers.titulo_loading_creando_empresa')
                        })
                        axios.post('/api/register/store-company', data).then(res => {
                            resp.$vs.loading.close()
                            this.$toast.success({
                                title: this.$t('backend.customer.create-customers.title_muy_bien_toast'),
                                message: this.$t('backend.customer.create-customers.title_mensaje_success_toast_register'),
                                showDuration: 1000,
                                hideDuration: 5000,
                                position: 'top right',
                            })
                            // console.log('/'+this.language+"/profile")
                            window.location = '/' + this.language + "/new-customers";
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
            data.append('nameRepresent', this.user.name);
            data.append('lastNameRepresent', this.user.last_name);
            data.append('emailRepresent', this.email);
            data.append('phoneRepresent', this.user.phoneI);
            data.append('typeIdentRepresent', JSON.stringify(this.user.valueIdentificationType))
            data.append('typePositionRepresent', JSON.stringify(this.user.valueTypePosition))
            data.append('identificationRepresent', this.user.identification);
            if (this.user.valueCityUser) {
                data.append('userCity', JSON.stringify(this.user.valueCityUser));
            }
            data.append('userCountry', JSON.stringify(this.user.valueCountryUser));
        },
        dataSendCompany(data) {
            data.append('nameCompany', this.companyName)
            data.append('addressCompany', this.company.address)
            data.append('emailCompany', this.emailCompany)
            data.append('nitCompany', this.company.nit)
            data.append('typeCompany', JSON.stringify(this.company.typeCompany))
            data.append('typeEntity', JSON.stringify(this.type_client))
            data.append('phoneCompany', this.company.phoneI)
            data.append('pictureCompany', JSON.stringify(this.company.picture))
            data.append('biographyCompany', this.company.biography)
            data.append('countryCompany', JSON.stringify(this.company.valueCountry))
            if (this.company.valueCity){
                data.append('cityCompany', JSON.stringify(this.company.valueCity))
            }
            data.append('url_youtube', this.urlYoutube);
            data.append('url_instagram', this.urlInstagram);
            data.append('url_applemusic', this.urlAppleMusic);
            data.append('url_facebook', this.urlFacebook);
            data.append('url_spotify', this.urlSpotify);
            data.append('url_tiktok', this.urlTiktok);
            data.append('url_twitch', this.urlTwitch);
            data.append('url_twitter', this.urlTwitter);
            data.append('url_website', this.urlWebSite);
            data.append('archives',JSON.stringify(this.urlsArchiveCompany));
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
        addArchiveCompanyCustomer(file, response) {
            this.urlsArchiveCompany.push({
                nameArchive: file.name,
                urlArchive: response.data,
                uuid: response.uuid,
                extension: response.extension
            })
            console.log(this.urlsArchiveCompany);
            if (this.urlsArchiveCompany) {
                console.log('entro')
                this.textValidaNameAddArchive = true
                setTimeout(()=>{
                    document.getElementById('txtNameCompany').disabled = true;
                },500)
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
        removedArchiveDropzoneCompanyCustomer(file, error, xhr) {
            console.log('remove file ', file.upload.uuid);
            let uuid = file.upload.uuid

            for (let i = 0; i < this.urlsArchiveCompany.length; i++)
                if (this.urlsArchiveCompany[i].uuid === uuid) {
                    const data = new FormData();
                    data.append("archiveCompany", this.urlsArchiveCompany[i].urlArchive);
                    axios.post('/api/removed-archive-company', data)
                        .then(resp => {
                            this.$toast.success({
                                title: this.$t('backend.customer.create-customers.title_muy_bien_toast'),
                                message: this.$t('backend.customer.create-customers.title_mensaje_success_toast_remove_image'),
                                showDuration: 1000,
                                hideDuration: 5000,
                                position: 'top right',
                            })
                            this.urlsArchiveCompany.splice(i, 1);
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
        addFileUpload(file, response) {
            this.company.picture = response;
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
        btnCancelSocialNetworks() {
            this.addSocialNetworks = false
            this.objectSocialNetworks = null
        },
        btnCancelBiography() {
            this.addBiography = false
            this.biography = ''
        },
        btnAddArchivesCompany(){
            if (this.companyName){
                this.addArchive = true
            }else{
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

            for (let i = 0; i < this.urlsArchiveCompany.length; i++) {
                const data = new FormData();
                data.append("archiveCompany", this.urlsArchiveCompany[i].urlArchive);
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
                            this.urlsArchiveCompany.splice(i, 1);
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

            this.urlsArchiveCompany = [];
            this.textValidaNameAddArchive = false
        },
        btnCancelAddLogo() {
            this.addLogo = false;
            this.removedImage();
        }
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
        companyName: function (val){
          if (!val && this.addArchive === true){
              this.addArchive = false
              this.$toast.error({
                  title: this.$t('backend.customer.create-customers.title_atención_toast'),
                  message: this.$t('backend.customer.create-customers.title_mensaje_para_agregar_archivos'),
                  showDuration: 1000,
                  hideDuration: 8000,
              })

              for (let i = 0; i < this.urlsArchiveCompany.length; i++) {
                  const data = new FormData();
                  data.append("archiveCompany", this.urlsArchiveCompany[i].urlArchive);
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
                              this.urlsArchiveCompany.splice(i, 1);
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
              this.urlsArchiveCompany = [];
              this.textValidaNameAddArchive = false
          }
        },
        urlsArchiveCompany: function (val) {
            if (!val.length) {
                document.getElementById('txtNameCompany').disabled = false;
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
