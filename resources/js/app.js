import './bootstrap';
import Vue from 'vue';
import VueRouter from 'vue-router';

import Index from './vue/Index';
import SinglePatient from './vue/components/SinglePatient';
import Patients from './vue/components/Patients';
import Diseases from './vue/components/Diseases';


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
    {
        path: '/diseases',
        name: 'diseases',
        component: Diseases,
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