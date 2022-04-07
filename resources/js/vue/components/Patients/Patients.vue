<template>
    <div >
        <div class="col-md-8">
            <search></search>
        </div>
        <router-link :to="{ name: 'patient-create'}">
            <div class="card-title">
                <button class="btn btn-light btn-block mb-4">Dodaj pacjenta</button>
            </div>
        </router-link>
        <div v-if="!loading">
                <div class="card w-50 mt-3" v-for="patient in patients" :key="patient.id">
                    <patient-list-item v-bind="patient"></patient-list-item>
                </div>
        </div>
        <div v-else>Loading...</div>

    </div>
</template>
<script>
import PatientListItem from './PatientListItem.vue';
import Search from './Search.vue';

    export default {
        components: {
            Search,
            PatientListItem
        },
        data() {
            return {
                patients: [],
                loading: false,
            };
        },
         mounted() {
    },
        computed: {
        },
        methods: {

        },
        created() {
            this.loading = true;
            const request_patients = axios
                .get("/api/patients").then(response => {
                this.patients = response.data.data;
                this.loading = false;
            });

        },
        props: {},
    };
</script>
<style scoped>
table {
    width: 800px;
    margin: 50px auto;
}
th, td {
    width: 150px;
    height: 50px;
    text-align: center;
}
</style>
