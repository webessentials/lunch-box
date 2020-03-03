require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';

import router from './routers/router';

Vue.use(VueRouter);
const app = new Vue({
    router,
    el: '#app',
});
