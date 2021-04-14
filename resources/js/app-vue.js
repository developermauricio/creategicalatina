/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

import VueFormWizard from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
Vue.use(VueFormWizard)

import CxltToastr from 'cxlt-vue2-toastr'
Vue.use(CxltToastr)
import 'cxlt-vue2-toastr/dist/css/cxlt-vue2-toastr.css';

import Vuesax from 'vuesax';
import 'vuesax/dist/vuesax.css';
import 'material-icons/iconfont/material-icons.css';
Vue.use(Vuesax);

/*COMPONENTES EXTERNOS*/
Vue.component('input-form', require('./components/InputFormComponent.vue').default);

Vue.component('create-new-customer', require('./components/backend/pages/customer/CreateNewCustomer').default);
Vue.component('profile-customer', require('./components/backend/pages/customer/ProfileCustomer').default);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

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
window.eventBus = new Vue();
const appVue = new Vue({
    el: '#app',
    i18n
});
