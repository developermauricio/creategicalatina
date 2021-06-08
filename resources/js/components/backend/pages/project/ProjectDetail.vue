<template>
    <div id="user-profile">
        <!-- profile header -->
        <div class="row">
            <div class="col-12">
                <div class="card profile-header mb-2">
                    <!-- profile cover photo -->
                    <img class="card-img-top h-25" :src="bannerProject" alt="User Profile Image" />
                    <!--/ profile cover photo -->

                    <div class="position-relative">
                        <!-- profile picture -->
                        <div class="profile-img-container d-flex align-items-center mb-3">
                            <!-- profile title -->
                            <div class="profile-title ml-3">
                                <h1 class="text-white" v-text="project.name"></h1>
                                <p class="text-white" v-text="project.type_project.name[language]"></p>
                            </div>
                        </div>
                    </div>
                    <div  class="badge float-right badge-pill badge-glow badge-warning" v-if="project.state === '1'">Revisión</div>
                    <div  class="badge float-right badge-pill badge-glow badge-primary" v-else-if="project.state === '2'">Borrador</div>
                    <div  class="badge float-right badge-pill badge-glow badge-success" v-else-if="project.state === '3'">Aprobado</div>
                    <div  class="badge float-right badge-pill badge-glow badge-info" v-else-if="project.state === '4'">En Desarrollo</div>
                    <div  class="badge float-right badge-pill badge-glow badge-danger" v-else-if="project.state === '5'">Rechazado</div>
                    <div  class="badge float-right badge-pill badge-glow badge-success" v-else-if="project.state === '6'">Finalizado</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- navbar -->
                <vs-tabs alignment="fixed" color="#F05E7D">
                    <vs-tab label="Información">
                        <div>
                            <project-detail-information :projectInfo="project"></project-detail-information>
                        </div>
                    </vs-tab>
                    <vs-tab label="Facturación">
                        <div>
                            <invoice-project :projectInfo="project"></invoice-project>
                        </div>
                    </vs-tab>
                    <vs-tab label="Flujo de Trabajo">
                        <div>
                            <h1>Flujo de Traba </h1>
                        </div>
                    </vs-tab>
                    <vs-tab label="Archivos">
                        <div>
                            <h1>Archivos </h1>
                        </div>
                    </vs-tab>
                </vs-tabs>
                <!--/ navbar -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
name: "ProjectDetail",
    data(){
        return{
            bannerTeam: window.banner_team,
            bannerProject: window.banner_project,
            language: window.lang,
        }
    },
    props:['project', 'answerBrief']
}
</script>

<style scoped>

</style>
