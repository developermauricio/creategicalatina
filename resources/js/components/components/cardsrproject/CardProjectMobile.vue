<template>
    <div>
        <div class="row">
            <div class="col-12">
                <splide :slides="optionsTypeProject" :options="options">
                    <splide-slide v-for="typeProject in optionsTypeProject" :key="typeProject.id">
                        <div class="card">
                            <img class="card-img-top pt-1 pr-1 pl-1" :src="typeProject.picture" alt="Card image cap">
                            <div class="card-body" style="padding-top: 1rem !important;">
                                <h6 class="card-title text-center text-title-card-mobile" style="font-size: 1.2rem; margin-bottom: 0.30rem !important;">{{ typeProject.name[language] }}</h6>
                                <p class="card-text text-center">
                                    Más info
                                </p>
                            </div>
                        </div>
                    </splide-slide>
                </splide>
            </div>
        </div>

    </div>
</template>

<script>
import {Splide, SplideSlide} from '@splidejs/vue-splide';
import '@splidejs/splide/dist/css/themes/splide-default.min.css';

export default {
    name: "CardProjectMobile",
    components: {
        Splide,
        SplideSlide,
    },
    data() {
        return {
            options: {
                gap: '1rem',
                focus : 'center',
                perPage: 2,
                pagination: false,
                trimSpace: false,
                breakpoints: {
                    height: '6rem',
                }
            },

            language: window.lang, //Idioma actual de la aplicación
            colorCardLoading: window.cardsLoadingColor, //color de las tarjetas cargando segun el tema
            skeletonValue: 1,

            selectProjectType: null,
            selectProjectCategory: null,
            optionsTypeProject: [], //Arreglo con los tipos de proyectos
            optionsCategoriesProject: [], //Arreglo con las categorias de proyectos
        };
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
                setTimeout(() => {
                    this.skeletonValue = 0
                }, 2000)
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

<style>

.card-title.text-title-card-mobile {
    /*display: block;*/
    /*width: 100px;*/
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
</style>
