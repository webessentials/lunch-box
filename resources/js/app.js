require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import axios from 'axios';

import ExampleComponent from './components/ExampleComponent';
import router from './routers/router';

Vue.use(VueRouter);
const app = new Vue({
    router,
    components: {
      ExampleComponent
    },
    el: '#app',
});
