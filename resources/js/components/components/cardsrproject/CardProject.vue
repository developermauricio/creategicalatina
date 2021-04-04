<template>
    <div>
        <div v-if="skeletonValue == 1">
            <div class="row">
                <div class="col-12 col-md-3 col-lg-3 pt-3" v-for="skele in 6">
                    <SkeletonScaffold
                        :primary="colorCardLoading"
                        borderRadius="0px"
                        animTimingFunction="ease-in">
                        <div v-mBox v-mDark style="height: 1.5em"></div>
                        <br/>
                        <div v-mCardImg></div>
                    </SkeletonScaffold>
                </div>
            </div>
        </div>
        <div v-if="skeletonValue === 0">
            <p class="pb-1">{{ $t('frontend.register-client.selecciona_tipo_proyecto') }}</p>
            <div class="row" >
                <div class="col-6 col-lg-3 col-md-3" v-for="typeProject in optionsTypeProject" :key="typeProject.id">
                    <div :class="typeProject.id === ( selectProjectType ? selectProjectType.id : 0 ) ? 'active': ''"
                         @click="typeProjectSelected( typeProject )"
                    >
                        <div class="card-container" id="card-info-animation" style="cursor:pointer">
                            <div class="card-flip">
                                <div class="front">
                                    <div class="card no-b">
                                        <div class="card-body text-center">
                                            <h3 class="p-t-10  font-weight-bold">{{ typeProject.name[language] }}</h3>
                                            <img style="margin-top: 0.5rem" width="170"
                                                 :src="typeProject.picture" alt="">
                                        </div>
                                    </div>
                                </div>

                                <div class="back">
                                    <div class="card" style="border: 2px solid #79ebdf; !important">
                                        <div class="card-body cardPatterType">
                                            <i class="fa fa-check-circle text-success checkPatterType"></i>
                                            <h3 class="p-t-10  font-weight-bold">{{ typeProject.name[language] }}</h3>
                                            <p class="mt-1 text-justify" style="line-height: 1.3rem !important"> Lorem
                                                ipsum
                                                dolor sit amet,
                                                consectetur adipisicing elit. Accusantium ad aliquam asperiores aut
                                                dolorum
                                                esse,
                                                fuga ipsum itaque natus nesciunt pariatur perferendis perspiciatis
                                                provident
                                                recusandae repudiandae saepe tempore veniam voluptatum.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="selectProjectType" style="height: 35rem">
            <div class="divider" id="section-projects-categories">
                <div class="divider-text">{{ $t('frontend.register-client.siguiente_paso') }}</div>
            </div>
            <div class="row pt-2 pb-1 justify-content-center">
                <div class="col-12">
                    <h2 class="font-weight-bolder display-4 text-center">
                        {{ selectProjectType.name[language] }}</h2>
                </div>
            </div>
            <p class="pt-1">{{ $t('frontend.register-client.selecciona_categoria_proyecto') }}</p>
            <div class="row" >
                <div class="col-6 col-lg-3 col-md-3" v-for="categoryProject in optionsCategoriesProject" :key="categoryProject.id">
                    <div :class="categoryProject.id === ( selectProjectCategory ? selectProjectCategory.id : 0 ) ? 'active': ''"
                         @click="categoryProjectSelected( categoryProject )"
                    >
                        <div class="card-container" id="card-info-animation-category" style="cursor:pointer">
                            <div class="card-flip">
                                <div class="front">
                                    <div class="card no-b">
                                        <div class="card-body text-center">
                                            <h3 class="p-t-10  font-weight-bold">{{ categoryProject.name[language] }}</h3>
                                            <img style="margin-top: 0.5rem" width="170"
                                                 :src="categoryProject.picture" alt="">
                                        </div>
                                    </div>
                                </div>

                                <div class="back">
                                    <div class="card" style="border: 2px solid #79ebdf; !important">
                                        <div class="card-body cardPatterType">
                                            <i class="fa fa-check-circle text-success checkPatterType"></i>
                                            <h3 class="p-t-10  font-weight-bold">{{ categoryProject.name[language] }}</h3>
                                            <p class="mt-1 text-justify" style="line-height: 1.3rem !important"> Lorem
                                                ipsum
                                                dolor sit amet,
                                                consectetur adipisicing elit. Accusantium ad aliquam asperiores aut
                                                dolorum
                                                esse,
                                                fuga ipsum itaque natus nesciunt pariatur perferendis perspiciatis
                                                provident
                                                recusandae repudiandae saepe tempore veniam voluptatum.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import InfoCard from 'vue-info-card';

export default {
    name: "CardProject",
    components: {
        InfoCard,
    },
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
.card-container {
    perspective: 700px;
}

.card-flip, .card-container {
    transform-style: preserve-3d;
    transition: all 0.7s ease;
}

.card-flip div {
    backface-visibility: hidden;
    transform-style: preserve-3d;
}

.card-container:hover .card-flip, .active .card-flip {
    transform: rotateY(180deg);
}

.card-flip {
    display: grid;
    grid-template: 1fr / 1fr;
    grid-template-areas: "frontAndBack";
    transform-style: preserve-3d;
    transition: all 0.7s ease;
}

.front {
    grid-area: frontAndBack;
}

.back {
    grid-area: frontAndBack;
    transform: rotateY(-180deg);
}

.front .title.grey-background {
    display: none !important;
}

.back .title.grey-background {
    display: none !important;
}
</style>
