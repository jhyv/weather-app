require('./bootstrap');

window.Vue = require('vue');

Vue.component('app-header', require('./components/Header.vue').default);
Vue.component('landing-view', require('./views/Landing.vue').default);
Vue.component('cities-view', require('./views/Cities.vue').default);
Vue.component('city-profile', require('./views/CityProfile.vue').default);

const app = new Vue({
    el: '#app'
});
