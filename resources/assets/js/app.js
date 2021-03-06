
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
import Router from 'vue-router';
import company from './components/Register/RegisterCompany';
import VueSweetalert2 from 'vue-sweetalert2';

Vue.use(VueSweetalert2);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('register', require('./components/Register/RegisterCreate.vue'));
Vue.component('login', require('./components/Login/UserLogin.vue'));
Vue.component('companyprofile', require('./components/Company/Profile.vue'));
Vue.component('companyindex', require('./components/Company/Index.vue'));
Vue.component('proceed', require('./components/Request/proceed.vue'));
Vue.component('requestlist', require('./components/Request/AcceptOrDecline.vue'));
Vue.component('companysettings', require('./components/Company/Settings.vue'));
Vue.component('calendarschedule', require('./components/Request/Calendar.vue'));
Vue.component('packagecreate', require('./components/Package/Create.vue'));
Vue.component('packageshow', require('./components/Package/Show.vue'));
Vue.component('accountsettings', require('./components/Account/Settings.vue'));
Vue.component('forgotpassview', require('./components/Account/Forgot.vue'));
Vue.component('passwordrecover', require('./components/Account/NewPasswordRecovered.vue'));

const app = new Vue({
    el: '#app',
});
