<template>
    <div>
        <div class="col-md-8">
            <search-engine></search-engine>
        </div>
        <div v-if="!loading">
            <div class="d-flex flex-column mb-4" v-for="row in rows" :key="row">
                <div class="card w-50 mt-3" v-for="patient in patients" :key="patient.id">
                    <patient-list-item v-bind="patient"></patient-list-item>
                </div>
            </div>
        </div>
        <div v-else>Loading...</div>

    </div>
</template>
<script>
import PatientListItem from './PatientListItem.vue';
import SearchEngine from './Search.vue';

    export default {
        components: {
            SearchEngine,
            PatientListItem
        },
        data() {
            return {
                patients: [],
                loading: false,
            };
        },
        computed: {
            rows() {
                return this.patients.length;
                }
        },
        methods: {
        },
        created() {
            this.loading = true;
            const request = axios
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
