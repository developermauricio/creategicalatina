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

import SmartTable from 'vuejs-smart-table'
Vue.use(SmartTable)

var VueScrollTo = require('vue-scrollto');
Vue.use(VueScrollTo)

import VueTheMask from 'vue-the-mask'
Vue.use(VueTheMask)


import money from 'v-money'
Vue.use(money, {precision: 3})


const numberFormat =  new Intl.NumberFormat('es-co', {
    style: 'currency',
    currency: 'COP',
    minimumFractionDigits: 2
});

window.currency = function (number) {
    return numberFormat.format(number);
};

Vue.filter('currency', currency);

/*COMPONENTES EXTERNOS*/
Vue.component('input-form', require('./components/InputFormComponent.vue').default);
Vue.component('changued-password', require('./components/components/user/ChangedPassword.vue').default)
Vue.component('preview-doc', require('./components/components/previewdoc/PreviewDoc.vue').default)

/*=============================================
COMPONENTES PARA LAS NOTIFICACIONES
=============================================*/
Vue.component('notifications-backend', require('./components/backend/notifications/Notifications.vue').default)
/*=============================================
COMPONENTES PARA LOS CLIENTES
=============================================*/
Vue.component('customer-type-company', require('./components/backend/pages/customer/components/TypeCompany.vue').default);
Vue.component('customer-type-person-natural', require('./components/backend/pages/customer/components/TypePersonaNatural.vue').default);
Vue.component('create-new-customer', require('./components/backend/pages/customer/CreateNewCustomer').default);
Vue.component('profile-customer', require('./components/backend/pages/customer/ProfileCustomer').default);
/*=============================================
COMPONENTES PARA LOS PROVEEDORES
=============================================*/
Vue.component('provider-type-company', require('./components/backend/pages/provider/components/TypeCompanyProvider.vue').default);
Vue.component('provider-type-personal-natural', require('./components/backend/pages/provider/components/TypePersonaNaturalProvider.vue').default);
Vue.component('create-new-provider', require('./components/backend/pages/provider/CreateNewProvider.vue').default);
/*=============================================
COMPONENTES PARA EL TEAM
=============================================*/
Vue.component('create-new-member', require('./components/backend/pages/team/CreateNewTeam.vue').default);


Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// BEGIN: view Payment Platform
Vue.component('home-payment', require('./components/payment/HomePayment.vue').default);
Vue.component('paypal-component', require('./components/payment/componentsPayment/PayPalComponent.vue').default);
Vue.component('stripe-component', require('./components/payment/componentsPayment/StripeComponent.vue').default);
Vue.component('secure-stripe-component', require('./components/payment/stripe/SecureComponent.vue').default);
Vue.component('mercadopago-component', require('./components/payment/componentsPayment/MercadoPagoComponent.vue').default);
Vue.component('payu-component', require('./components/payment/componentsPayment/PayUComponent.vue').default);
// END: view Payment Platform

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
