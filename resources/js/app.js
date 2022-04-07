import './bootstrap';
import Vue from 'vue';
import VueRouter from 'vue-router';

import Index from './vue/Index';
import router from "./routes";
import axios from 'axios';

window.Vue = require('vue').default;

Vue.use(VueRouter);



const app = new Vue({
    el: '#app',
    router,
    components: {
        "index": Index
    }, 
    async beforeCreate() {
       
    }
});
