<template>
    <div>
        <div class="row">
            <div class="col-12">
                <splide :options="options">
                    <splide-slide>
                        <div class="card card-info-animation">
                            <img class="card-img-top pt-1 pr-1 pl-1" src="/images/theme/img-light-mode.png" alt="Card image cap">
                            <div class="card-body" style="padding-top: 1rem !important;">
                                <h6 class="card-title text-center text-title-card-mobile" style="font-size: 1.2rem; margin-bottom: 0.30rem !important;">Light Mode</h6>
                            </div>
                        </div>
                    </splide-slide>
                    <splide-slide>
                        <div class="card card-info-animation">
                            <img class="card-img-top pt-1 pr-1 pl-1" src="/images/theme/img-dark-mode.png" alt="Card image cap">
                            <div class="card-body" style="padding-top: 1rem !important;">
                                <h6 class="card-title text-center text-title-card-mobile" style="font-size: 1.2rem; margin-bottom: 0.30rem !important;">Dark Mode</h6>
                            </div>
                        </div>
                    </splide-slide>
                    <splide-slide>
                        <div class="card card-info-animation">
                            <img class="card-img-top pt-1 pr-1 pl-1" src="/images/theme/img-system-theme.png" alt="Card image cap">
                            <div class="card-body" style="padding-top: 1rem !important;">
                                <h6 class="card-title text-center text-title-card-mobile" style="font-size: 1.2rem; margin-bottom: 0.30rem !important;">Según el sistema</h6>
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
name: "modal-theme-frontend",
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
        };
    },
}
</script>

<style scoped>

</style>
