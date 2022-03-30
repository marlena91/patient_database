import './bootstrap';
import Vue from 'vue';
import VueRouter from 'vue-router';

import Index from './vue/Index';
import App from './vue/App';
import Home from './vue/src/Home';
import Hello from './vue/src/Hello';
import PatientsComponent from './vue/components/PatientsComponent';

window.Vue = require('vue').default;

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        name: 'index',
        component: App,
    },
    {
        path: '/home',
        name: 'home',
        component: Home,
    },
    {
        path: '/hello',
        name: 'hello',
        component: Hello,
    },
    {
        path: '/patients',
        name: 'patients',
        component: PatientsComponent,
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