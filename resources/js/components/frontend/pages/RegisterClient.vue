<template>
    <div>
        <div class="row pt-2 pb-4 justify-content-center">
            <div class="col-12">
                <h2 class="font-weight-bolder display-4 text-center" id="title-register-project">
                    {{ $t('frontend.register-client.Bienvenido') }}</h2>
                <blockquote class="blockquote">
                    <p class="text-center" id="text-usted-las-pinta">
                        <img style="padding-bottom: 0.7rem" width="11" src="/images/others/comi-ini.png" alt="">
                        {{ $t('frontend.register-client.Usted_no_las_pinta') }}
                        <img style="padding-bottom: 0.7rem" width="11" src="/images/others/comi-final.png" alt="">
                    </p>
                    <p class="text-center more-info-card-desktop" style="font-size: 1rem"><a @click="showTourDesktop"
                                                                                             style="color: #636b6f">{{
                            $t('frontend.register-client.mostrar_info')
                        }}</a></p>
                    <p class="text-center more-info-card-mobile" style="font-size: 1rem; display: none"><a
                        @click="showTourMobile" style="color: #636b6f">{{
                            $t('frontend.register-client.mostrar_info')
                        }}</a></p>
                </blockquote>
            </div>
        </div>
        <!-- Tarjetas con animación para el escritorio  -->
        <cards-projects @selectTypeProject="selectTypeProject"></cards-projects>
        <!-- Componente para mostrar el tour desktop -->
        <v-tour name="myTour" :steps="stepsDesktop" :options="myOptions" :callbacks="myCallbacks"></v-tour>
        <!-- Componente para mostrar el tour mobile -->
        <v-tour name="myTourMobile" :steps="stepsMobile" :options="myOptions" :callbacks="myCallbacks"></v-tour>

    </div>

</template>

<script>

import VueTour from 'vue-tour'
import 'vue-tour/dist/vue-tour.css'

export default {
    name: "RegisterClient",
    components: {
        VueTour
    },
    data() {
        return {
            selectedTypeProject: null,
            valueSessionTour: window.sessionTourRegisterProject,

            stepsDesktop: [
                {
                    target: '#title-register-project',
                    content: this.$t('frontend.register-client.text_paso_1') + `
                    <br><img class="pt-1" width="100" src="/images/others/think-box-dark.png" alt="">`,
                    params: {
                        enableScrolling: false
                    }
                },
                {
                    target: '#title-register-project',
                    content: this.$t('frontend.register-client.text_paso_2') + `
                    <br><img class="pt-1" width="100" src="/images/others/think-box-light.png" alt="">`,
                    params: {
                        enableScrolling: false
                    }
                },
                {
                    target: '#title-register-project',
                    content: this.$t('frontend.register-client.text_paso_3') + `
                             <br><img class="pt-1" width="100" src="/images/others/think-box-dark.png" alt="">`,
                    params: {
                        enableScrolling: false
                    }
                },
                {
                    target: '#title-register-project',
                    content: this.$t('frontend.register-client.text_paso_4') + `
                    <br><img class="pt-1" width="100" src="/images/others/think-box-light.png" alt="">`,
                    params: {
                        enableScrolling: false
                    }
                },
                {
                    target: '#text-usted-las-pinta',
                    content: this.$t('frontend.register-client.text_paso_5') + `
                    <br><img class="pt-1" width="100" src="/images/creategica-logo.png" alt="">`,
                    params: {
                        placement: 'top',
                        enableScrolling: false
                    }
                },
                {
                    target: '.card-info-animation',
                    content: this.$t('frontend.register-client.text_paso_6') + `
                    <br><img class="pt-1" width="100" src="/images/creategica-logo.png" alt="">`,
                    params: {
                        placement: 'top',
                        enableScrolling: false
                    }
                },
            ],
            stepsMobile: [
                {
                    target: '#title-register-project',
                    content: this.$t('frontend.register-client.text_paso_1') + `
                    <br><img class="pt-1" width="100" src="/images/others/think-box-dark.png" alt="">`,
                    params: {
                        enableScrolling: false
                    }
                },
                {
                    target: '#title-register-project',
                    content: this.$t('frontend.register-client.text_paso_2') + `
                    <br><img class="pt-1" width="100" src="/images/others/think-box-light.png" alt="">`,
                    params: {
                        enableScrolling: false
                    }
                },
                {
                    target: '#title-register-project',
                    content: this.$t('frontend.register-client.text_paso_3') + `
                             <br><img class="pt-1" width="100" src="/images/others/think-box-dark.png" alt="">`,
                    params: {
                        enableScrolling: false
                    }
                },
                {
                    target: '#title-register-project',
                    content: this.$t('frontend.register-client.text_paso_4') + `
                    <br><img class="pt-1" width="100" src="/images/others/think-box-light.png" alt="">`,
                    params: {
                        enableScrolling: false
                    }
                },
                {
                    target: '#text-usted-las-pinta',
                    content: this.$t('frontend.register-client.text_paso_5') + `
                    <br><img class="pt-1" width="100" src="/images/creategica-logo.png" alt="">`,
                    params: {
                        placement: 'top',
                        enableScrolling: false
                    }
                },
                {
                    target: '.card-info-animation-mobile',
                    content: this.$t('frontend.register-client.text_paso_6') + `
                    <br><img class="pt-1" width="100" src="/images/creategica-logo.png" alt="">`,
                    params: {
                        placement: 'top',
                        enableScrolling: false
                    }
                },
            ],
            myOptions: {
                useKeyboardNavigation: false,
                labels: {
                    buttonSkip: this.$t('frontend.register-client.boton_omitir_tour'),
                    buttonPrevious: this.$t('frontend.register-client.boton_anterior_tour'),
                    buttonNext: this.$t('frontend.register-client.boton_siguiente_tour'),
                    buttonStop: this.$t('frontend.register-client.boton_finalizar_tour')
                }
            },
            myCallbacks: {
                onSkip: this.saveSessionTour,
                onFinish: this.saveSessionTour
            }
        }
    },
    methods: {
        selectTypeProject(data) {
            this.selectedTypeProject = data;
        },
        saveSessionTour() {
            axios.post('/api/save-session-tour').then(resp => {

            });
        },
        showTourDesktop() {
            this.$tours['myTour'].start()
        },
        showTourMobile() {
            this.$tours['myTourMobile'].start()
        }
    },
    mounted() {
        if (this.valueSessionTour !== '1') {
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                this.$tours['myTourMobile'].start()
            } else {
                this.$tours['myTour'].start()
            }
        }
    },
}
</script>

<style>

@media (max-width: 1024px)  and (min-width: 320px) {
    .more-info-card-desktop {
        display: none !important;
    }

    .more-info-card-mobile {
        display: block !important;
    }
}

.v-tour__target--highlighted {
    box-shadow: 0 0 0 99999px rgba(0, 0, 0, .4);
}
</style>
