<template>
    <div>
        <input type="hidden" @click="getDataCustomer" id="inputGetDataCustomer"/>
        <input type="hidden" @click="getDataCompany" id="inputGetDataCompany"/>
        <vs-popup class="showProjectModal"
                  title="Información del Cliente"
                  :active.sync="popupActiveShowCustomer"
                  fullscreen
                  @update:active="closeModalShowCustomer"
        >
            <!--=====================================
                SECCIÓN CLIENTE TIPO PERSONA NATURAL
            ======================================-->
            <div class="row" v-if="loadDataCustomer">
                <div class="col-12">
                    <div class="card card-shadow-none card-profile">
                        <img :src="bannerProject" class="img-fluid card-img-top" alt="Profile Cover Photo"/>
                        <div class="card-body">
                            <div class="profile-image-wrapper">
                                <div class="profile-image">
                                    <div class="avatar">
                                        <img :src="picture" alt="Profile Picture"/>
                                    </div>
                                </div>
                            </div>
                            <h3>{{ name }} {{ lastName }}</h3>
                            <h6 class="text-muted">{{ email }}</h6>
                            <div class="badge badge-light-primary profile-badge">{{ category }}</div>
                            <hr class="mb-2"/>
                            <!--                            <div class="d-flex justify-content-between align-items-center">-->
                            <!--                                <div>-->
                            <!--                                    <h6 class="text-muted font-weight-bolder">Estado</h6>-->
                            <!--                                    <h5 class="mb-0">10.3k</h5>-->
                            <!--                                </div>-->
                            <!--                                <div>-->
                            <!--                                    <h6 class="text-muted font-weight-bolder">Proyectos</h6>-->
                            <!--                                    <h5 class="mb-0">156</h5>-->
                            <!--                                </div>-->
                            <!--                                <div>-->
                            <!--                                    <h6 class="text-muted font-weight-bolder">Empresas</h6>-->
                            <!--                                    <h5 class="mb-0">23</h5>-->
                            <!--                                </div>-->
                            <!--                                <div>-->
                            <!--                                    <h6 class="text-muted font-weight-bolder">Fecha de Registro</h6>-->
                            <!--                                    <h5 class="mb-0">23</h5>-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <div class="row">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Cliente:</label>
                                        <p>{{ name }} {{ lastName }}</p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Categoría:</label>
                                        <p>{{ category }}</p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Correo Electrónico:</label>
                                        <p>{{ email }}</p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Teléfono:</label>
                                        <p>{{ phone }}</p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Dirección:</label>
                                        <p>{{ address }}</p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">País:</label>
                                        <p>{{ country.name }} <img style="margin-top: -0.25rem;"
                                                                   :src="country.flag"
                                                                   width="15" alt=""></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4" v-if="city">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Ciudad:</label>
                                        <p>{{ city.name }}</p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Número de Proyectos:</label>
                                        <p>{{ countProject }}</p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Estado:</label>
                                        <p>{{ state === '1' ? 'Activo' : 'Inactivo'}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-12 text-center">
                                    <a :href="'/'+language+'/customer/'+slug" class="btn btn-flat-primary waves-effect">Más Información</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--=====================================
                SECCIÓN CLIENTE TIPO EMPRESA
            ======================================-->
            <div class="row" v-if="loadDataCompany">
                <div class="col-12">
                    <div class="card card-shadow-none card-profile img-profile-company">
                        <img :src="bannerProject" class="img-fluid card-img-top" alt="Profile Cover Photo"/>
                        <div class="card-body">
                            <div class="profile-image-wrapper">
                                <img class="img-fluid img-thumbnail" width="200"
                                     :src="pictureCompany" alt="">
                            </div>
                            <h3>{{ nameCompany }}</h3>
                            <h6 class="text-muted">{{ emailCompany }}</h6>
                            <div class="badge badge-light-primary profile-badge">{{ categoryCompany }}</div>
                            <div class="design-group p-1">
                                <a class="avatar" style="margin-right: 0.5rem" v-if="urlFacebookCompany" :href="urlFacebookCompany" target="_blank">
                                    <vs-tooltip text="Facebook">
                                        <img src="/images/icons-social/facebook.png" width="34" height="34" alt="Facebook">
                                    </vs-tooltip>
                                </a>
                                <a class="avatar" style="margin-right: 0.5rem" v-if="urlInstagramCompany" :href="urlInstagramCompany" target="_blank">
                                    <vs-tooltip text="Instagram">
                                        <img src="/images/icons-social/instagram.png" width="34" height="34" alt="Instagram">
                                    </vs-tooltip>
                                </a>
                                <a class="avatar" style="margin-right: 0.5rem" v-if="urlSpotifyCompany" :href="urlSpotifyCompany" target="_blank">
                                    <vs-tooltip text="Spotify">
                                        <img src="/images/icons-social/spotify.png" width="34" height="34" alt="Spotify">
                                    </vs-tooltip>
                                </a>
                                <a class="avatar" style="margin-right: 0.5rem" v-if="urlAppleMusicCompany" :href="urlAppleMusicCompany" target="_blank">
                                    <vs-tooltip text="Apple Music">
                                        <img src="/images/icons-social/apple-music.png" width="34" height="34" alt="Apple Music">
                                    </vs-tooltip>
                                </a>
                                <a class="avatar" style="margin-right: 0.5rem" v-if="urlTiktokCompany"  :href="urlTiktokCompany" target="_blank">
                                    <vs-tooltip text="TikTok">
                                        <img src="/images/icons-social/tiktok.png" width="34" height="34" alt="Tiktok">
                                    </vs-tooltip>
                                </a>
                                <a class="avatar" style="margin-right: 0.5rem" v-if="urlTwitchCompany"  :href="urlTwitchCompany" target="_blank">
                                    <vs-tooltip text="Twitch">
                                        <img src="/images/icons-social/twitch.png" width="34" height="34" alt="Twitch">
                                    </vs-tooltip>
                                </a>
                                <a class="avatar" style="margin-right: 0.5rem" v-if="urlTwitterCompany" :href="urlTwitterCompany" target="_blank">
                                    <vs-tooltip text="Twitter">
                                        <img src="/images/icons-social/twitter.png" width="34" height="34" alt="Twitter">
                                    </vs-tooltip>
                                </a>
                                <a class="avatar" style="margin-right: 0.5rem" v-if="urlYoutubeCompany" :href="urlYoutubeCompany" target="_blank">
                                    <vs-tooltip text="YouTube">
                                        <img src="/images/icons-social/youtube.png" width="34" height="34" alt="Youtube" >
                                    </vs-tooltip>
                                </a>
                                <a class="avatar" style="margin-right: 0.5rem" v-if="urlWebSiteCompany" :href="urlWebSiteCompany" target="_blank">
                                    <vs-tooltip text="Web Site">
                                        <img src="/images/icons-social/web-site.png" width="34" height="34" alt="Web Site">
                                    </vs-tooltip>
                                </a>
                            </div>
                            <hr class="mb-2"/>
                            <!--                            <div class="d-flex justify-content-between align-items-center">-->
                            <!--                                <div>-->
                            <!--                                    <h6 class="text-muted font-weight-bolder">Estado</h6>-->
                            <!--                                    <h5 class="mb-0">{{ stateCompany === '1' ? 'Activo': 'Inactivo'}}</h5>-->
                            <!--                                </div>-->
                            <!--                                <div v-if="projectCount">-->
                            <!--                                    <h6 class="text-muted font-weight-bolder">Proyectos</h6>-->
                            <!--                                    <h5 class="mb-0">{{ projectCount }}</h5>-->
                            <!--                                </div>-->
                            <!--                                <div>-->
                            <!--                                    <h6 class="text-muted font-weight-bolder">Fecha de Registro</h6>-->
                            <!--                                    <h5 class="mb-0">{{ moment(createdAtCompany).locale(language).format("dddd, Do MMMM YYYY") }}</h5>-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <div class="row">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Empresa:</label>
                                        <p v-text="nameCompany"></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Categoría:</label>
                                        <p v-text="categoryCompany"></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Correo Electrónico:</label>
                                        <p v-text="emailCompany"></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Teléfono:</label>
                                        <p v-text="phoneCompany"></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Dirección:</label>
                                        <p v-text="addressCompany"></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">País:</label>
                                        <p>{{ countryCompany.name }} <img style="margin-top: -0.25rem;"
                                                                                    :src="countryCompany.flag"
                                                                                    width="15" alt=""></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4" v-if="cityCompany">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Ciudad:</label>
                                        <p v-text="cityCompany"></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4" v-if="cityCompany">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Cantidad de Proyectos:</label>
                                        <p v-text="projectCount"></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4" v-if="stateCompany">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Estado:</label>
                                        <p>{{ stateCompany === '1' ? 'Activo' : 'Inactivo'}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-12 text-center">
                                    <a :href="'/'+language+'/customer/'+slugCompany" class="btn btn-flat-primary waves-effect">Más Información</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </vs-popup>
    </div>
</template>

<script>
import moment from 'moment';

export default {
    name: "ShowCustomer",
    components: {},

    data() {
        return {
            popupActiveShowCustomer: false,
            moment: moment,

            bannerProject: window.banner_project,
            //Datos del cliente tipo persona natural
            idCustomer: null,
            name: '',
            lastName: '',
            email: '',
            phone: '',
            birthday: null,
            address: '',
            slug:null,
            country: null,
            city: null,
            position: null,
            category: null,
            picture: null,
            company: null,
            countProject: null,
            state: null,

            //Datos del cliente tipo empresa
            idCompany: null,
            nameCompany: '',
            emailCompany: '',
            categoryCompany: null,
            cityCompany: null,
            countryCompany: {
                canonical_name: null,
                flag: null
            },
            managerCompany: null,
            phoneCompany: null,
            addressCompany: null,
            pictureCompany: null,
            slugCompany: null,
            stateCompany: null,
            projectCount: null,
            createdAtCompany: null,
            urlFacebookCompany:null,
            urlInstagramCompany:null,
            urlSpotifyCompany:null,
            urlTiktokCompany:null,
            urlTwitchCompany:null,
            urlTwitterCompany:null,
            urlYoutubeCompany:null,
            urlAppleMusicCompany:null,
            urlWebSiteCompany:null,

            loadDataCustomer: false,
            loadDataCompany: false,


            language: window.lang
        }
    },

    methods: {
        getDataCustomer(e) {
            e.preventDefault();
            this.idCustomer = e.target.value;

            this.$vs.loading({
                color: '#3f4f6e',
                text: 'Espere un momento por favor...'
            })

            setTimeout(() => {
                axios.get('/api/get-data-customer/' + this.idCustomer).then(resp => {
                    console.log('CLIENTE', resp.data.data)
                    this.popupActiveShowCustomer = true
                    this.name = resp.data.data.user.name;
                    this.lastName = resp.data.data.user.last_name;
                    this.picture = resp.data.data.user.picture;
                    this.email = resp.data.data.user.email;
                    this.phone = resp.data.data.user.phone;
                    this.address = resp.data.data.user.address;
                    this.country = resp.data.data.user.country;
                    this.city = resp.data.data.user.city;
                    this.state = resp.data.data.user.state;
                    this.slug = resp.data.data.user.slug;
                    this.countProject = resp.data.data.projects_count;
                    this.category = resp.data.data.company_category.name[this.language]
                    //Guardano las empresas asociadas, si es que tiene.
                    // resp.data.data.company.map((data)=>{
                    //     this.company = data
                    // })
                    this.loadDataCustomer = true
                });
                this.$vs.loading.close()
            }, 500)
        },

        getDataCompany(e) {
            e.preventDefault()

            this.idCompany = e.target.value;
            this.$vs.loading({
                color: '#3f4f6e',
                text: 'Espere un momento por favor...'
            })

            setTimeout(() => {
                axios.get('/api/get-data-company/' + this.idCompany).then(resp => {
                    console.log('EMPRESA', resp.data.data)
                    this.popupActiveShowCustomer = true
                    this.nameCompany = resp.data.data.name
                    this.pictureCompany = resp.data.data.picture
                    this.emailCompany = resp.data.data.email
                    this.phoneCompany = resp.data.data.phone
                    this.addressCompany = resp.data.data.address
                    this.categoryCompany = resp.data.data.category.name[this.language]
                    this.stateCompany = resp.data.data.state
                    this.projectCount = resp.data.data.project_count
                    this.createdAtCompany = resp.data.data.created_at
                    this.countryCompany = resp.data.data.country
                    this.cityCompany = resp.data.data.city.name
                    this.slugCompany = resp.data.data.slug

                    //Redes Sociales o links
                    this.urlAppleMusicCompany= resp.data.data.url_apple_music
                    this.urlFacebookCompany = resp.data.data.url_facebook
                    this.urlInstagramCompany = resp.data.data.url_instagram
                    this.urlSpotifyCompany = resp.data.data.url_spotify
                    this.urlTiktokCompany = resp.data.data.url_tiktok
                    this.urlTwitchCompany = resp.data.data.url_twitch
                    this.urlTwitterCompany = resp.data.data.url_twitter
                    this.urlYoutubeCompany = resp.data.data.url_youtube
                    this.urlWebSiteCompany = resp.data.data.web_site

                    this.loadDataCompany = true
                });
                this.$vs.loading.close()
            }, 500);
        },

        closeModalShowCustomer() {
            this.loadDataCustomer = false
            this.loadDataCompany = false
            this.popupActiveShowCustomer = false
        }

    }
}
</script>

<style scoped>
.showProjectModal >>> .vs-popup {
    max-width: 1024px !important;
    height: auto;
}

.card-profile.img-profile-company .card-body {
    padding: 0rem 2.3rem 1.5rem 2.3rem !important;
    margin-top: -2rem !important;
}

.card.card-shadow-none {
    box-shadow: 0 0px 0px 0 rgb(34 41 47 / 10%) !important;
}
</style>
