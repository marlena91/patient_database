<template>
    <div >
        <div class="col-md-8">
            <search @searchingResults="onSearchingResultsChanged"></search>
            <button @click="reset" class="btn btn-secondary btn-block mb-4">Wyzeruj filtrowanie</button>
            <p v-if="info" class="text-info">Brak dopasowań.</p>
        </div>
        <router-link :to="{ name: 'patient-create'}">
            <div class="card-title">
                <button class="btn btn-light btn-block mb-4">Dodaj pacjenta</button>
            </div>
        </router-link>
        <div v-if="!loading">
                <div class="card w-50 mt-3" v-for="patient in patients" :key="patient.id">
                    <patient-list-item v-bind="patient" @id="patientDelete"></patient-list-item>
                </div>
        </div>
        <div v-else>Loading...</div>

    </div>
</template>
<script>
import PatientListItem from './PatientListItem.vue';
import Search from '../SearchEngine/Search.vue';

    export default {
        components: {
            Search,
            PatientListItem
        },
        data() {
            return {
                patients: [],
                loading: false,
                searchingArr:[],
                info: false,
            };
        },
         mounted() {
    },
        computed: {
        },
        methods: {
            onSearchingResultsChanged(searchingResults){
                this.patients = searchingResults;
                if(this.patients.length === 0){
                    this.info = true;
                }
            },
            reset(){
                this.$router.go();
            },
            patientDelete(id){
                this.patients = this.patients.filter((item) => item.id !== id);

            }
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
