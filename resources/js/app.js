import './bootstrap';
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';

import Index from './vue/Index';
import router from "./routes";

import storeDefinition from "./store";
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';


window.Vue = require('vue').default;

Vue.use(VueRouter);
Vue.use(Vuex);

const store = new Vuex.Store(storeDefinition);

window.axios.interceptors.response.use(
    response => {
        return response;
    },
    error => {
        if (401 === error.response.status) {
            store.dispatch("logout");
        }
        return Promise.reject(error);
    }
);

Vue.component('v-select', vSelect)

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
