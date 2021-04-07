/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');import SkeletonCards from 'vue-ultimate-skeleton-cards'
Vue.use(SkeletonCards)

var VueScrollTo = require('vue-scrollto');
Vue.use(VueScrollTo)


import Vuesax from 'vuesax';
import 'vuesax/dist/vuesax.css';
import 'material-icons/iconfont/material-icons.css';
Vue.use(Vuesax);

import moment from 'moment';
import 'moment/locale/es';
window.moment = moment;

import CxltToastr from 'cxlt-vue2-toastr'
Vue.use(CxltToastr)
import 'cxlt-vue2-toastr/dist/css/cxlt-vue2-toastr.css';

import CKEditor from '@ckeditor/ckeditor5-vue2';
Vue.use( CKEditor );


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/*COMPONENTES*/
Vue.component('input-form', require('./components/InputFormComponent.vue').default);
Vue.component('brief-software', require('./components/components/briefs/BriefSoftware.vue').default);
Vue.component('cards-projects', require('./components/components/cardsrproject/CardProject.vue').default); //Tarjetas dinamicas con animación para escritorio
Vue.component('cards-projects-mobile', require('./components/components/cardsrproject/CardProjectMobile.vue').default); //Tarjetas dinamicas para la versión mobile
Vue.component('cards-change-theme', require('./components/components/change-theme-frontend').default); //Tarjetas dinamicas para la versión mobile


Vue.component('register-client', require('./components/frontend/pages/RegisterClient').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import VueInternationalization from 'vue-i18n';
import Locale from './vue-i18n-locales.generated';
window.Vue.use(VueInternationalization);
const i18n = new VueInternationalization({
    locale: window.lang,
    messages: Locale
});
window.eventBus = new Vue()
const appVue = new Vue({
    el: '#app-frontend',
    i18n
});
