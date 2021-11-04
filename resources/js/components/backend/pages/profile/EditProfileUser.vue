<template>
    <div class="content-wrapper">
        <div class="content-body">
            <!-- users edit start -->
            <section class="app-user-edit">
                <div class="card">
                    <div class="card-body">

                        <div class="media mb-2">
                            <img :src="photoUrl" alt="users avatar" class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer" height="90" width="90" />
                            <div class="media-body mt-50">
                                <h4>{{ user.name }} {{ user.last_name }}</h4>
                                <h4>{{ user.email }}</h4>
                                <div class="col-12 d-flex mt-1 px-0">
                                    <button @click="onChangePhoto" class="btn btn-primary mr-75 mb-0">Cambiar Foto</button>
                                    <input @change="changePhoto" ref="fileInput" class="form-control" type="file" hidden accept="image/png, image/jpeg, image/jpg" />

                                    <button @click="cancelChangePhoto" class="btn btn-outline-secondary d-none d-sm-block">Cancelar</button>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="row">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <input-form
                                        id="txtNameUserTeam"
                                        :label="$t('backend.customer.create-customers.titulo_nombre_cliente')"
                                        pattern="alf"
                                        :errorMsg="$t('backend.customer.create-customers.titulo_error_nombre_cliente')"
                                        :requiredMsg="$t('backend.customer.create-customers.titulo_obligatrio_nombre_cliente')"
                                        :modelo.sync="user.name"
                                        :required="true"
                                        :msgServer.sync="errors.name"/>
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
                                        :msgServer.sync="errors.last_name"/>
                                </div>

                                <div class="col-12 col-md-4 col-lg-4">
                                    <input-form
                                        id="txtUserEmail"
                                        :label="$t('backend.customer.create-customers.titulo_email')"
                                        pattern="email"
                                        :disabled="disabledFields"
                                        :errorMsg="$t('backend.customer.create-customers.titulo_error_email')"
                                        :requiredMsg="$t('backend.customer.create-customers.titulo_obligatrio_email')"
                                        :modelo.sync="user.email"
                                        :required="true"
                                        :msgServer.sync="errors.email"/>
                                </div>

                                <div class="col-12 col-md-4 col-lg-4">
                                    <input-form
                                        :label="$t('backend.customer.create-customers.titulo_tipo_documento')"
                                        id="txtIdentificationType"
                                        errorMsg
                                        :requiredMsg="$t('backend.customer.create-customers.titulo_obligatrio_tipo_documento')"
                                        :required="true"
                                        :modelo.sync="user.identificationType"
                                        :msgServer.sync="errors.identificationType"
                                        type="multiselect"
                                        :multiselect="{
                                            options: listIdentificationType,
                                            selectLabel:this.$t('backend.customer.create-customers.multiselect_seleccionar'),
                                            selectedLabel:this.$t('backend.customer.create-customers.multiselect_seleccionado'),
                                            deselectLabel:this.$t('backend.customer.create-customers.multiselect_desmarcar'),
                                            placeholder:this.$t('backend.customer.create-customers.titulo_seleccionar_tipo_documento'),
                                            'track-by':'id',
                                            label: 'name',
                                            'custom-label': identificationType => identificationType.name[language]
                                        }"/>
                                </div>

                                <div class="col-12 col-md-4 col-lg-4">
                                    <input-form
                                        id="txtIdentification"
                                        :label="$t('backend.customer.create-customers.titulo_identificacion_representante')"
                                        pattern="alf_num"
                                        :errorMsg="$t('backend.customer.create-customers.titulo_error_identificacion_representante')"
                                        :requiredMsg="$t('backend.customer.create-customers.titulo_obligatrio_identificacion_representante')"
                                        :modelo.sync="user.identification"
                                        :required="true"
                                        :msgServer.sync="errors.identification"/>
                                </div>

                                <div class="col-12 col-md-4 col-lg-4">
                                    <label class="form-control-label label-selects">{{ $t('backend.customer.create-customers.titulo_telefono') }}</label>
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
                                        :label="$t('backend.team.create-teams.titulo_fecha_nacimiento')"
                                        id="txtFechaNacimiento"
                                        pattern="all"
                                        :errorMsg="$t('backend.team.create-teams.titulo_fecha_valida')"
                                        :requiredMsg="$t('backend.team.create-teams.titulo_fecha_nacimiento_requerido')"
                                        :required="false"
                                        :modelo.sync="user.birthday"
                                        :msgServer.sync="errors.birthday"
                                        type="date"
                                        :datepicker="{
                                            'clear-button': false,
                                            'bootstrap-styling':true,
                                        }" />
                                </div>

                                <div class="col-12 col-md-4 col-lg-4">
                                    <input-form
                                        :label="$t('backend.customer.create-customers.titulo_seleccionar_pais')"
                                        id="txtCountryManagger"
                                        errorMsg
                                        :requiredMsg="$t('backend.customer.create-customers.titulo_obligatrio_selecciona_pais')"
                                        :required="true"
                                        :modelo.sync="user.country"
                                        :msgServer.sync="errors.country"
                                        type="multiselect"
                                        @updatedValue="getCities"
                                        :multiselect="{
                                            options: listCountries,
                                            selectLabel:this.$t('backend.customer.create-customers.multiselect_seleccionar'),
                                            selectedLabel:this.$t('backend.customer.create-customers.multiselect_seleccionado'),
                                            deselectLabel:this.$t('backend.customer.create-customers.multiselect_desmarcar'),
                                            placeholder:this.$t('backend.customer.create-customers.titulo_seleccionar_pais'),
                                            'track-by':'id',
                                            label: 'name',
                                            'custom-label': country => country.name
                                        }" />
                                </div>

                                <div class="col-12 col-md-4 col-lg-4" v-if="user.country">
                                    <input-form
                                        class="input-label-register"
                                        :label="$t('backend.customer.create-customers.titulo_seleccionar_ciudad')"
                                        id="txtCityUser"
                                        errorMsg
                                        :requiredMsg="$t('backend.customer.create-customers.titulo_obligatrio_selecciona_ciudad')"
                                        :required="false"
                                        :modelo.sync="user.city"
                                        :msgServer.sync="errors.city"
                                        type="multiselect"
                                        :multiselect="{ options: listCities,
                                            selectLabel:this.$t('backend.customer.create-customers.multiselect_seleccionar'),
                                            selectedLabel:this.$t('backend.customer.create-customers.multiselect_seleccionado'),
                                            deselectLabel:this.$t('backend.customer.create-customers.multiselect_desmarcar'),
                                            placeholder:this.$t('backend.customer.create-customers.titulo_seleccionar_ciudad'),
                                            'track-by':'id',
                                            label: 'name',
                                            'custom-label': city => city.name
                                        }" />
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
                                        :msgServer.sync="errors.address" />
                                </div>

                                <div class="col-8 col-md-8 col-lg-12">
                                    <input-form
                                        type="textarea"
                                        :label="$t('backend.customer.create-customers.titulo_company_biografia')"
                                        id="txtBudgetDescription"
                                        pattern="all"
                                        :errorMsg="$t('backend.customer.create-customers.titulo_company_error_biografia')"
                                        :requiredMsg="$t('backend.customer.create-customers.titulo_company_requerido_biografia')"
                                        :required="false"
                                        :modelo.sync="user.biography"
                                        :msgServer.sync="errors.biography"
                                        :options="{
                                        rows: 5
                                        }"/>
                                </div>
                            </div>

                            <hr class="my-3">

                            <div class="row">
                                <div class="col-12 col-lg-6 col-md-6 profiling">
                                    <input-form
                                        :label="$t('backend.customer.create-customers.titulo_seleccionar_redes_sociales')"
                                        id="txtSocialNetworks"
                                        :requiredMsg="$t('backend.customer.create-customers.titulo_requerido_selecciona_redes_sociales')"
                                        :required="false"
                                        :modelo.sync="inputsSocialNetwords"
                                        :msgServer.sync="errors.inputsSocialNetwords"
                                        type="multiselect"
                                        selectLabel=""
                                        @tag="addTagSocialInputs"
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
                                        }" />
                                </div>
                            </div>

                            <div class="row">
                                <div v-for="inputsSocial in inputsSocialNetwords"
                                    :key="inputsSocial.id" class="col-md-4">
                                    <input-form
                                        :label="'Url '+inputsSocial.social"
                                        :id="'txt' + inputsSocial.social"
                                        pattern="url"
                                        :placeholder="inputsSocial.social + 'url'"
                                        errorMsg="Ingrese una url valida"
                                        requiredMsg="La url es requerida"
                                        :required="true"
                                        :modelo.sync="inputsSocial.url" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12 d-flex flex-sm-row flex-column mt-2" style="justify-content: flex-end;">
                            <button @click="cancelUpdate" class="btn btn-outline-secondary mb-1 mb-sm-0 mr-0 mr-sm-1">Cancelar</button>
                            <button @click="updateUserProfile" class="btn btn-primary">Actualizar Perfil</button>
                        </div>
                    </div>
                </div>
            </section>
            <!-- users edit ends -->
        </div>
    </div>
</template>

<script>
    require("moment/min/locales.min");
    import moment from 'moment';
    import Multiselect from "vue-multiselect";
    import VuePhoneNumberInput from "vue-phone-number-input";
    import "vue-phone-number-input/dist/vue-phone-number-input.css";
    import vue2Dropzone from 'vue2-dropzone';
    import Datepicker from 'vuejs-datepicker';
    import {en, es} from 'vuejs-datepicker/dist/locale';

    export default {
        props: [ "current_user" ],
        components: {
            Multiselect,
            Datepicker,
            VuePhoneNumberInput,
            vue2Dropzone,
        },
        data() {
            return {
                language: window.lang,
                user: {},
                errors: {},
                listIdentificationType: [],
                listCountries: [],
                listCities: [],
                photoUrl: '',
                newPhoto: null,
                disabledFields: 1,
                listSocialNetworks: [],
                inputsSocialNetwords: [],
            }
        },
        methods: {
            onChangePhoto() {
                this.$refs.fileInput.click()
            },
            changePhoto( event ) {
                const files = event.target.files
                const fileReader = new FileReader()
                fileReader.addEventListener('load', () => {
                    this.photoUrl = fileReader.result;
                    // cambiar foto de perfil del menu
                    $('#photoProfile').attr('src', this.photoUrl);
                })
                fileReader.readAsDataURL(files[0])
                this.newPhoto = files[0]
                console.log('object: ', this.newPhoto)
            },
            cancelChangePhoto() {
                this.photoUrl = this.current_user.picture
                // cambiar foto de perfil del menu
                $('#photoProfile').attr('src', this.photoUrl);
                this.newPhoto = null
            },
            updateUserProfile() {
                console.log('user:: ', this.user)
                eventBus.$emit("validarFormulario");

                setTimeout( () => {
                    if ( document.querySelectorAll(".is-invalid").length > 0 ) {
                        this.$toast.error({
                            title: 'Error',
                            message: this.$t('backend.customer.create-customers.error_llenar_todos_campos'),
                            showDuration: 1000,
                            hideDuration: 6000,
                            position: 'top right',
                        })
                        return;
                    }

                    this.setNewUrlSocialNetword();

                    const data = new FormData()
                    data.append('user', JSON.stringify(this.user));
                    data.append('photo', this.newPhoto);

                    Swal.fire({
                        title: 'Confirmar Datos',
                        confirmButtonColor: "#F05E7D",
                        cancelButtonColor: "#79ebdf",
                        confirmButtonText: "Actualizar",
                        cancelButtonText: "Cancelar",
                        customClass: "swal-confirnt-data-profile",
                        showCancelButton: true,
                        reverseButtons: true,
                        allowOutsideClick: false,
                        html: this.previewInfoUpdateUser(),
                    }).then( result => {
                        if (result.value) {
                            axios.post('/api/update/user-profile', data)
                                .then( response => {
                                    console.log('success: ', response)
                                    if ( response.data.status === 200 ) {
                                        this.$toast.success({
                                            title: this.$t('backend.customer.create-customers.title_muy_bien_toast'),
                                            message: response.data.msg,
                                            showDuration: 1000,
                                            hideDuration: 5000,
                                            position: 'top right',
                                        })
                                        window.location = `/${this.language}/admin/profile/${response.data.user.slug}`
                                    }
                                })
                                .catch( error => {
                                    console.log('Error: ', error)
                                });
                        }
                    });
                }, 300);
            },
            previewInfoUpdateUser() {
                return `<div class="container-fluid overflow-auto" style="max-height: 65vh;">
                        <hr>
                        <div class="row">
                            <div class="col-12 text-center mb-2">
                                <h2>Datos Personales</h2>
                            </div>
                            ${ this.createColumnDataUser( 'Nombre:', this.user.name + ' ' + this.user.last_name ) }
                            ${ this.createColumnDataUser( 'Email:', this.user.email ) }
                            ${ this.createColumnDataUser( 'Tipo de Identificación:', this.user.identificationType.name[this.language] ) }
                            ${ this.createColumnDataUser( 'Identificación:', this.user.identification ) }
                            ${ this.createColumnDataUser( 'Teléfono:', this.user.phoneI ) }
                            ${ this.user.birthday ? this.createColumnDataUser( 'Fecha de Nacimiento:', this.user.birthday ) : '' }
                            ${ this.createColumnDataUser( 'País:', this.user.country.name ) }
                            ${ this.user.city ? this.createColumnDataUser( 'Ciudad o municipio:', this.user.city.name ) : '' }
                            ${ this.createColumnDataUser( 'Dirección:', this.user.address ) }
                            ${ this.user.biography ? this.createColumnDataUser( 'Biografía:', this.user.biography ) : '' }
                        </div>
                        <hr>
                        ${ this.inputsSocialNetwords ? this.previewInfoSocialNetword() : '' }
                    </div>`;
            },
            createColumnDataUser( title, field ) {
                return `<div class="col-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                <strong>${ title }</strong>
                                <br>
                                <label class="text-justify">${ field }</label>
                            </div>
                        </div>`;
            },
            previewInfoSocialNetword() {
                return `<div class="row">
                            <div class="col-12 text-center mb-2">
                                <h2>Redes Sociales</h2>
                            </div>
                            ${ this.inputsSocialNetwords.map( social => {
                                return this.createLinkSocialNetword( social.social, social.url );
                            }).join('') }
                        </div>
                        <hr>`;
            },
            createLinkSocialNetword(title, field) {
                return `<div class="col-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                <strong>${ title }</strong>
                                <br>
                                <a href="${ field }" class="url-social-netword">${ field }</a>
                            </div>
                        </div>`;
            },
            cancelUpdate() {
                Swal.fire({
                    title: '¿Está seguro?',
                    text: "¡Se perderán los cambios realizados!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: "#F05E7D",
                    cancelButtonColor: "#79ebdf",
                    confirmButtonText: "Ir al perfil",
                    cancelButtonText: "Cancelar",
                    reverseButtons: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = `/${this.language}/admin/profile/${this.current_user.slug}`
                    }
                })
            },
            addTagSocialInputs( newTag ) {
                const tag = {
                    name: newTag,
                    code:
                        newTag.substring(0, 2) +
                        Math.floor(Math.random() * 10000000)
                };
                this.options.push(tag);
                this.value.push(tag);
            },
            setDataSocialNetworks() {
                this.addDataListSocialNetworks(this.user.url_youtube, 'YouTube', 1)
                this.addDataListSocialNetworks(this.user.url_facebook, 'Facebook', 2)
                this.addDataListSocialNetworks(this.user.url_instagram, 'Instagram', 3)
                this.addDataListSocialNetworks(this.user.url_spotify, 'Spotify', 4)
                this.addDataListSocialNetworks(this.user.url_apple_music, 'Apple Music', 5)
                this.addDataListSocialNetworks(this.user.url_tiktok, 'TikTok', 6)
                this.addDataListSocialNetworks(this.user.url_twitch, 'Twitch', 7)
                this.addDataListSocialNetworks(this.user.url_twitch, 'Twitter', 8)
                this.addDataListSocialNetworks(this.user.web_site, 'Website', 9)
            },
            addDataListSocialNetworks(urlData, data, idData) {
                if (urlData == null || urlData == "null") {
                    this.listSocialNetworks.push({
                        social: data,
                        url: "",
                        id: idData
                    });
                } else {
                    this.listSocialNetworks.push({
                        social: data,
                        url: urlData,
                        id: idData
                    });
                    this.inputsSocialNetwords.push({
                        social: data,
                        url: urlData,
                        id: idData
                    });
                }
            },
            setNewUrlSocialNetword() {
                this.inputsSocialNetwords.map( social => {
                    switch (social.social) {
                        case "YouTube":
                            this.user.url_youtube = social.url;
                            break;
                        case "Facebook":
                            this.user.url_facebook = social.url;
                            break;
                        case "Instagram":
                            this.user.url_instagram = social.url;
                            break;
                        case "Spotify":
                            this.user.url_spotify = social.url;
                            break;
                        case "Apple Music":
                            this.user.url_apple_music = social.url;
                            break;
                        case "TikTok":
                            this.user.url_tiktok = social.url;
                            break;
                        case "Twitch":
                            this.user.url_twitch = social.url;
                            break;
                        case "Twitter":
                            this.user.url_twitch = social.url;
                            break;
                        case "Website":
                            this.user.web_site = social.url;
                            break;
                    }
                    return social;
                });
            },

            /*****************************
                Consultas al servidor
            ******************************/
            getIdentificationType() {
                axios.get('/api/get-identificationtype')
                    .then( response => {
                        this.listIdentificationType = response.data.data
                        this.listIdentificationType.map( identificactionType => {
                            if ( identificactionType.id === this.current_user.identification_type_id ) {
                                this.user.identificationType = identificactionType
                            }
                        });
                    }).catch( error => {
                        console.log('error: ', error)
                    });
            },
            getCountries() {
                axios.get('/api/get-countries')
                    .then( response => {
                        this.listCountries = response.data.data
                        this.listCountries.map( country => {
                            if ( country.id === this.current_user.country_id ) {
                                this.user.country = country
                                this.getCities( country, true )
                            }
                        });
                    }).catch( error => {
                        console.log('Error: ', error)
                    });
            },
            getCities( country, city = false ) {
                this.user.city = null

                axios.get('/api/get-cities/' + country.alpha2Code)
                    .then( response => {
                        this.listCities = response.data.data
                        if ( city ) {
                            this.listCities.map( city => {
                                if ( city.id === this.current_user.city_id ) {
                                    this.user.city = city
                                }
                            });
                        }
                    })
                    .catch( error => {
                        console.log('Error: ', error)
                    })
            },
        },
        created() {
            this.user = Object.assign( {}, this.current_user )
            this.photoUrl = this.user.picture
            this.getIdentificationType()
            this.getCountries()

            this.user.roles.map( role => {
                if ( role.name === 'Administrator' ) this.disabledFields = 0;
            });

            this.setDataSocialNetworks()

            console.log('user: ', this.user)
            // TODO: falta convertir la fecha de nacimiento
        },
        mounted() {
            console.log('Component mounted')
        }
    }
</script>

<style >
.url-social-netword {
    color: #6e6b7b;
}
</style>
