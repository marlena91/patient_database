import './bootstrap';
import Vue from 'vue';
import VueRouter from 'vue-router';

import App from './vue/App';
import Home from './vue/Home';
import Hello from './vue/Hello';


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

];

const router = new VueRouter({
    routes,
    mode: 'history',
    

})

const app = new Vue({
    el: '#app',
    router
});