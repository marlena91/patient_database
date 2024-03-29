import VueRouter from "vue-router";
import SinglePatient from './vue/components/Patients/SinglePatient';
import CreatePatient from './vue/components/Patients/CreatePatient';
import EditPatient from './vue/components/Patients/EditPatient';
import Patients from './vue/components/Patients/Patients';
import Diseases from './vue/components/Diseases/Diseases';
import EditMedicalNote from './vue/components/Medical-Notes/EditMedicalNote';
import CreateDisease from './vue/components/Diseases/CreateDisease';
import EditDisease from './vue/components/Diseases/EditDisease';
import AddDiseaseToPatient from "./vue/components/Patient-Disease/AddDiseaseToPatient";
import Login from "./vue/components/Auth/Login";

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
        path: '/patient/create',
        name: 'patient-create',
        component: CreatePatient,
    },
    {
        path: '/auth/login',
        name: 'login',
        component: Login,
    },

];

const router = new VueRouter({
    routes,
    mode: 'history',
});

export default router;
