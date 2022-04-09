<template>
    <div>
        <div class="col-md-8">
            <search @searchingResults="onSearchingResultsChanged"></search>
            <button @click="reset" class="btn btn-secondary btn-block mb-4">Wyzeruj filtrowanie</button>
            <hr>
            <select @click="sortData" v-model="sortSelect">
                <option disabled value="">--Posortuj dane--</option>
                <option value="nameAsc">A-Z imiona</option>
                <option value="nameDesc">Z-A imiona</option>
                <option value="lastnameAsc">A-Z nazwiska</option>
                <option value="lastnameDesc">Z-A nazwiska</option>
                <option value="birthdayAsc">Data urodzenia od najmlodszego</option>
                <option value="birthdayDesc">Data urodzenia od najstarszego</option>
            </select>
            <p v-if="info" class="text-info">Brak dopasowań.</p>
        </div>
        <hr>
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
            searchingArr: [],
            info: false,
            sortSelect: '',
        };
    },
    mounted() {
    },
    computed: {},
    methods: {
        getData() {
            this.loading = true;
            axios
                .get("/api/patients").then(response => {
                this.patients = response.data.data;
                this.loading = false;
            });
        },
        onSearchingResultsChanged(searchingResults) {
            this.patients = searchingResults;
            if (this.patients.length === 0) {
                this.info = true;
            }
        },
        reset() {
            this.getData();
        },
        patientDelete(id) {
            this.patients = this.patients.filter((item) => item.id !== id);
        },
        sortData() {
            switch (this.sortSelect) {
                case "nameAsc":
                    return this.patients.sort(function (a, b) {
                        return (a.name > b.name) ? 1 : -1;
                    });
                    break;
                case "nameDesc":
                    return this.patients.sort(function (a, b) {
                        return (a.name < b.name) ? 1 : -1;
                    });
                    break;
                case "lastnameAsc":
                    return this.patients.sort(function (a, b) {
                        return (a.lastname > b.lastname) ? 1 : -1;
                    });
                    break;
                case "lastnameDesc":
                    return this.patients.sort(function (a, b) {
                        return (a.lastname < b.lastname) ? 1 : -1;
                    });
                    break;
                case "birthdayAsc":
                    return this.patients.sort(function (a, b) {
                        return (a.birthday > b.birthday) ? 1 : -1;
                    });
                    break;
                case "birthdayDesc":
                    return this.patients.sort(function (a, b) {
                        return (a.birthday < b.birthday) ? 1 : -1;
                    });
                    break;
            }
        }
    },
    created() {
        this.getData();

    },
    props: {},
};
</script>
