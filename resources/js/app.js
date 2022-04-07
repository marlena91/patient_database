

import './bootstrap';
import Vue from 'vue';
import VueRouter from 'vue-router';

import Index from './vue/Index';
import SinglePatient from './vue/components/Patients/SinglePatient';
import CreatePatient from './vue/components/Patients/CreatePatient';
import EditPatient from './vue/components/Patients/EditPatient';
import Patients from './vue/components/Patients/Patients';
import Diseases from './vue/components/Diseases/Diseases';
import EditMedicalNote from './vue/components/Medical-Notes/EditMedicalNote';
import CreateDisease from './vue/components/Diseases/CreateDisease';
import AddDiseaseToPatient from "./vue/components/Patient-Disease/AddDiseaseToPatient";


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
        path: '/patients/:id/edit',
        name: 'patient-edit',
        component: EditPatient,
    },
    {
        path: '/patients/create',
        name: 'patient-create',
        component: CreatePatient,
    },
    {
        path: '/diseases',
        name: 'diseases',
        component: Diseases,
    },
    {
        path: '/medical-notes/:id/edit',
        name: 'medical-note-edit',
        component: EditMedicalNote,
    },
    {
        path: '/diseases/create',
        name: 'disease-create',
        component: CreateDisease,
    },
    {
        path: '/diseasespatients',
        name: 'disease-patient.show',
        component: AddDiseaseToPatient,
    },
    {
        path: '/diseasespatients/:id_disease/:id_patient/',
        name: 'disease-patient.create',
        component: AddDiseaseToPatient,
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
