import './bootstrap';
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';

import Index from './vue/Index';
import router from "./routes";

import storeDefinition from "./store";

window.Vue = require('vue').default;

Vue.use(VueRouter);
Vue.use(Vuex);

const store = new Vuex.Store(storeDefinition);

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        "index": Index
    },
    async beforeCreate() {
        this.$store.dispatch("loadUser");
    }
});
