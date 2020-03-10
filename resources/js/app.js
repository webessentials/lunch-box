require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';

import router from './routers/router';

Vue.use(VueRouter);

axios.interceptors.response.use((response) => {
    return response
}, function (error) {
    if (error.response.status === 403) {
        window.location.href = '/';
        return
    }
    return Promise.reject(error)
});

const app = new Vue({
    router,
    el: '#app',
});
