require('./bootstrap');
window.Vue = require('vue');

Vue.component('example', require('./components/Example.vue'));
Vue.component('notification', require('./components/Request/Notifications.vue'));

const app = new Vue({
    el: '#notifyapp',
});
