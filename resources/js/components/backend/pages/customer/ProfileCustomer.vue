<template>

    <!--=====================================
		SECCTION LOGO Y FONDO DE LA EMPRESA
    ======================================-->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="card card-profile">
                <img src="/images/bckground-profile.png" class="img-fluid card-img-top" alt="Profile Cover Photo"/>
                <div class="card-body">
                    <div class="profile-image-wrapper">
                        <div class="profile-image" style="border-radius: 0% !important;">
                            <img class="brand-logo" width="200" :src="company.picture" alt="">
                        </div>
                    </div>
                    <h3>{{ company.name }}</h3>
                    <h6 class="text-muted">{{ company.category.name[language] }}</h6>
                    <div v-if="company.state === '1'" class="badge badge-light-success profile-badge">Activo</div>
                    <div v-else class="badge badge-light-danger profile-badge">Inactivo</div>
                    <hr class="mb-2"/>
                    <div class="d-flex justify-content-between align-items-center"
                         style="justify-content: center !important;">
                        <div class="pr-5">
                            <h6 class="text-muted font-weight-bolder">En Marcha</h6>
                            <h3 class="mb-0">10.3k</h3>
                        </div>
                        <div>
                            <h6 class="text-muted font-weight-bolder">Fecha de Registro</h6>
                            <h3 class="mb-0">23</h3>
                        </div>
                        <div class="pl-5">
                            <h6 class="text-muted font-weight-bolder">Proyectos</h6>
                            <h3 class="mb-0">156</h3>
                        </div>

                    </div>
                    <!--=====================================
		                TABS CONTENT
                    ======================================-->
                    <div class="row pt-3 pb-3">
                        <div class="col-12">
                            <vs-tabs alignment="fixed" :color="colorx">
                                <!--=====================================
		                            INFORMACIÓN
                                ======================================-->
                                <vs-tab label="Información">
                                    <!--=====================================
		                                INFORMACIÓN DE LA EMPRESA
                                    ======================================-->
                                    <div class="p-2">
                                        <h3>Información de la empresa</h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-3 col-lg-3 text-justify">
                                            <label> Nombre de la empresa:</label>
                                            <p v-text="company.name"></p>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 text-justify">
                                            <div class="form-group">
                                                <label> Correo electrónico:</label>
                                                <p v-text="company.email"></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 text-justify">
                                            <div class="form-group">
                                                <label> Teléfono:</label>
                                                <p v-text="company.phone"></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 text-justify">
                                            <div class="form-group">
                                                <label> Dirección:</label>
                                                <p v-text="company.address"></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 text-justify">
                                            <div class="form-group">
                                                <label> Nit:</label>
                                                <p v-text="company.nit"></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 text-justify">
                                            <div class="form-group">
                                                <label> Tipo de empresa:</label>
                                                <p v-text="company.category.name[language]"></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 text-justify">
                                            <div class="form-group">
                                                <label> Pais:</label>
                                                <p>{{ company.country.name }}<img class="brand-logo ml-1" width="20"
                                                                                  :src="company.country.flag" alt="">
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 text-justify" v-if="company.city">
                                            <div class="form-group">
                                                <label> Ciudad:</label>
                                                <p v-text="company.city.name"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" v-if="company.biography">
                                        <div class="col-12 col-md-12 col-lg-12 text-justify">
                                            <label class="text-justify"> Biografia:</label>
                                            <p class="text-justify" v-text="company.biography"></p>
                                        </div>
                                    </div>

                                    <!--=====================================
		                                INFORMACIÓN DEL REPRESENTANTE
                                    ======================================-->
                                    <hr>
                                    <div class="p-2">
                                        <h3>Información del representante</h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-3 col-lg-3 text-justify">
                                            <label> Nombre:</label>
                                            <p v-text="company.manager.user.name"></p>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 text-justify">
                                            <label> Apellidos:</label>
                                            <p v-text="company.manager.user.last_name"></p>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 text-justify">
                                            <label> Correo electrónico:</label>
                                            <p v-text="company.manager.user.email"></p>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 text-justify">
                                            <label> Teléfono:</label>
                                            <p v-text="company.manager.user.phone"></p>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 text-justify">
                                            <label> Cargo:</label>
                                            <p v-text="company.manager.position.name[language]"></p>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 text-justify">
                                            <label> Tipo de documento:</label>
                                            <p v-text="company.manager.user.identification_type.name[language]"></p>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 text-justify">
                                            <label>Nº Documento:</label>
                                            <p v-text="company.manager.user.identification"></p>
                                        </div>
                                    </div>
                                </vs-tab>
                                <!--=====================================
		                            PROYECTOS
                                ======================================-->
                                <vs-tab label="Proyectos">
                                    <div class="row p-2">
                                        <h2>Proyectos</h2>
                                    </div>
                                </vs-tab>
                                <!--=====================================
		                            FACTURAS
                                ======================================-->
                                <vs-tab label="Facturas">
                                    <div class="row p-2">
                                        <h2>Facturas</h2>
                                    </div>
                                </vs-tab>
                                <!--=====================================
		                            CONTACTARME
                                ======================================-->
                                <vs-tab label="Contactarme">
                                    <div class="row p-2">
                                        <h2>Contactarme</h2>
                                    </div>
                                </vs-tab>
                            </vs-tabs>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ProfileCustomer",
    data() {
        return {
            colorx: '#F05E7D',
            language: window.lang
        }
    },
    props: ["company"]
}
</script>

<style scoped>

</style>
