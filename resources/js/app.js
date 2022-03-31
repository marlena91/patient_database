import './bootstrap';
import Vue from 'vue';
import VueRouter from 'vue-router';

import Index from './vue/Index';
import SinglePatient from './vue/components/SinglePatient';

import Patients from './vue/components/Patients';


window.Vue = require('vue').default;

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        name: 'patients',
        component: Patients,
    },
    {
        path: '/patients/:id',
        name: 'patient',
        component: SinglePatient,
    },

];

const router = new VueRouter({
    routes,
    mode: 'history',
});

const app = new Vue({
    el: '#app',
    router,
    components: {
        "index": Index
    }
});