<template>
    <div>
        <div class="row">
            <div class="col-md-4">
                <div>
                    <search @searchingResults="onSearchingResultsChanged"></search>
                    <button @click="reset" class="btn btn-secondary col-md-10 btn-block mb-4">Wyzeruj filtrowanie</button>
                    
                    <select @click="sortData" v-model="sortSelect" class="col-md-10 text-center">
                        <option disabled value="">--Posortuj dane--</option>
                        <option value="nameAsc">Imiona od A do Z</option>
                        <option value="nameDesc">Imiona od Z do A</option>
                        <option value="lastnameAsc">Nazwiska od A do Z</option>
                        <option value="lastnameDesc">Nazwiska od Z do A</option>
                        <option value="birthdayAsc">Data urodzenia rosnaco</option>
                        <option value="birthdayDesc">Data urodzenia malejaco</option>
                    </select>
                    <p v-if="info" class="text-info">Brak dopasowań.</p>
                </div>
                
                <div v-if='user.role==="admin" || user.role==="doctor"'>
                    <router-link :to="{ name: 'patient-create'}">
                        <div class="card-title">
                            <button class="btn btn-light btn-block mb-4 mt-4 col-md-10">Dodaj pacjenta</button>
                        </div>
                    </router-link>
                </div>
            </div>
            <div class="col-md-6">
                <div v-if="!loading">
                    <div class="card mt-3" v-for="patient in patients" :key="patient.id">
                        <patient-list-item v-bind="patient" @id="patientDelete"></patient-list-item>
                    </div>
                </div>
                <div v-else>Loading...</div>
            </div>
        </div>
    </div>
</template>
<script>
import PatientListItem from './PatientListItem.vue';
import Search from '../SearchEngine/Search.vue';
import {mapState} from "vuex";


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
    computed: {
        ...mapState({
            user: "user",
        })
    },
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
