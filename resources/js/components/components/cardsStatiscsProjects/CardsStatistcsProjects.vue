<template>
    <!-- Stats Horizontal Card -->
    <div class="row">
        <div class="col-lg-2 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="font-weight-bolder mb-0" v-text="revision"></h2>
                        <p class="card-text">{{ $t('titulo_estado_proyecto_revision') }}</p>
                    </div>
                    <div class="avatar bg-light-warning p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather='alert-triangle' class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="font-weight-bolder mb-0" v-text="approved"></h2>
                        <p class="card-text">{{ $t('titulo_estado_proyecto_aprobado') }}</p>
                    </div>
                    <div class="avatar bg-light-success p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather='check' class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="font-weight-bolder mb-0" v-text="developing"></h2>
                        <p class="card-text">{{ $t('titulo_estado_proyecto_desarrollo') }}</p>
                    </div>
                    <div class="avatar bg-light-info p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="activity" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="font-weight-bolder mb-0" v-text="borrador"></h2>
                        <p class="card-text">{{ $t('titulo_estado_proyecto_borrador') }}</p>
                    </div>
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="alert-octagon" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="font-weight-bolder mb-0" v-text="rejected"></h2>
                        <p class="card-text">{{ $t('titulo_estado_proyecto_rechazado') }}</p>
                    </div>
                    <div class="avatar bg-light-danger p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather='thumbs-down' class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="font-weight-bolder mb-0" v-text="finalized"></h2>
                        <p class="card-text">{{ $t('titulo_estado_proyecto_finalizado') }}</p>
                    </div>
                    <div class="avatar bg-light-success p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather='check-square' class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "CardsStatistcsProjects",
    data() {
        return {
            revision: null,
            borrador: null,
            rejected: null,
            approved: null,
            finalized: null,
            developing: null,
        }
    },
    methods:{
        getStatesProjects(){
            axios.get('/api/count-state-project')
            .then(resp =>{
                this.revision = resp.data.revision
                this.borrador = resp.data.borrador
                this.rejected = resp.data.rechazado
                this.approved = resp.data.aprobado
                this.finalized = resp.data.finalizado
                this.developing = resp.data.desarrollo
            })
        }
    },
    mounted() {
        this.getStatesProjects()
    }
}
</script>

<style scoped>

</style>
