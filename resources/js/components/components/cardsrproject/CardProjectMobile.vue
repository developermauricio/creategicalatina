<template>
    <div>
        <div class="row">
            <div class="col-12">
                <section id="component-swiper-centered-slides">
                    <div class="card bg-transparent shadow-none">
                        <div class="card-header">
                            <h4 class="card-title">{{ $t('frontend.register-client.selecciona_tipo_proyecto') }}</h4>
                        </div>
                        <div class="card-body" >
                            <div  class="swiper-centered-slides swiper-container p-1 swiper-container-initialized swiper-container-horizontal">
                                <div class="swiper-wrapper" id="swiper-wrapper-b5b27b4ba7b5720b" aria-live="polite"
                                     style="transition: 0ms; transform: translate3d(391.7109375px, 0px, 0px);">
                                    <div v-for="typeProject in optionsTypeProject" :key="typeProject.id" class="swiper-slide rounded swiper-shadow swiper-slide-active" role="group"
                                         :aria-label="`${typeProject.id}` / 5" style="margin-right: 30px;">
                                        <img width="160" :src="typeProject.picture">
                                        <div class="swiper-text pt-1">{{ typeProject.name[language] }}</div>
                                    </div>

                                </div>
                                <!-- Add Arrows -->
                                <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide"
                                     aria-controls="swiper-wrapper-b5b27b4ba7b5720b" aria-disabled="false"></div>
                                <div class="swiper-button-prev swiper-button-disabled" tabindex="-1" role="button"
                                     aria-label="Previous slide" aria-controls="swiper-wrapper-b5b27b4ba7b5720b"
                                     aria-disabled="true"></div>
                                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "CardProjectMobile",
    data() {
        return {
            language: window.lang, //Idioma actual de la aplicación
            colorCardLoading: window.cardsLoadingColor, //color de las tarjetas cargando segun el tema
            skeletonValue: 1,

            selectProjectType: null,
            selectProjectCategory: null,
            optionsTypeProject: [], //Arreglo con los tipos de proyectos
            optionsCategoriesProject: [], //Arreglo con las categorias de proyectos

        }
    },

    methods: {

        typeProjectSelected(typeProject) {
            this.selectProjectType = typeProject;
            this.$emit('selectTypeProject', this.selectProjectType)
            this.eventSelectScroll('#section-projects-categories') //Enviamos el tipo del projecto al componente padre
            console.log(typeProject.id)
            this.getCategoriesProjects(typeProject.id)
            this.$tours['myTour'].finish()

        },
        categoryProjectSelected(categoriesProjects){
            alert('Seleccionó', categoriesProjects.id)
        },
        getTypeProjects() {
            axios.get('/api/get-type-projects').then(resp => {
                this.optionsTypeProject = resp.data.data
            }).catch(err => {

            })
        },
        getCategoriesProjects(id){
            axios.get('/api/get-categories-projects/'+ id).then(resp => {
                this.optionsCategoriesProject = resp.data.data
            }).catch(err => {

            })
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
    },

    mounted() {
        this.getTypeProjects();
    },
}
</script>

<style scoped>

</style>
