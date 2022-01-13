/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Gate from './components/permissions/Gate';
// Vue.prototype.$gate = new Gate(window.user, roles);

Vue.prototype.$gate = new Gate(window.user, roles);

import { EchoPrivate } from './bootstrap';
window.EchoPrivate = EchoPrivate;
window.Vue = require('vue');
import SkeletonCards from 'vue-ultimate-skeleton-cards'


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
Vue.use(CKEditor);

import VueSocialChat from 'vue-social-chat'
Vue.use(VueSocialChat)

// import AudioRecorder from '../js/components/components/vue-audio-recorder'
// Vue.use(AudioRecorder)


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
Vue.component('chat-floating', require('./components/components/chat/ChatFloatingCustomer.vue').default);
Vue.component('audio-recorder', require('./components/components/vue-audio-recorder/src/components/recorder.vue').default);
Vue.component('audio-player', require('./components/components/vue-audio-recorder/src/components/player.vue').default);
Vue.component('input-form', require('./components/InputFormComponent.vue').default);
Vue.component('brief-software', require('./components/components/briefs/BriefSoftware.vue').default);
Vue.component('cards-projects', require('./components/components/cardsrproject/CardProject.vue').default); //Tarjetas dinamicas con animación para escritorio
Vue.component('cards-projects-mobile', require('./components/components/cardsrproject/CardProjectMobile.vue').default); //Tarjetas dinamicas para la versión mobile
Vue.component('cards-change-theme', require('./components/components/change-theme-frontend').default); //Tarjetas dinamicas para la versión mobile

/*=============================================
COMPONENTES PARA LAS NOTIFICACIONES
=============================================*/
Vue.component('notifications-backend', require('./components/backend/notifications/Notifications.vue').default)


Vue.component('register-client', require('./components/frontend/pages/RegisterClient').default);

/*=============================================
COMPONENTES PARA LAS EMPRESAS
=============================================*/
Vue.component('grid-lists-companies', require('./components/frontend/pages/company/GridListCompanies.vue').default);

Vue.component('show-customer-component', require('./components/components/customer/ShowCustomer.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import VueInternationalization from 'vue-i18n';
import Locale from './vue-i18n-locales.generated';
import Vue from "vue";
window.Vue.use(VueInternationalization);
const i18n = new VueInternationalization({
    locale: window.lang,
    messages: Locale
});
Vue.prototype.$eventBus = Vue.prototype.$eventBus || new Vue
window.eventBus = new Vue()
const appVue = new Vue({
    el: '#app-frontend',
    i18n
});
