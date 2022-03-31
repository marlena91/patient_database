<template>
    <div>
        
        <div class="d-flex flex-column mb-4" v-for="row in rows" :key="row">
            <div class="card w-50 mt-3" v-for="patient in patients" :key="patient.id">
                <patient-list-item v-bind="patient"></patient-list-item>
            </div>

        </div>
    </div>
</template>
<script>
import PatientListItem from './PatientListItem.vue';

    export default {
        components: {
            PatientListItem
        },
        data() {
            return {
                patients: []
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
        const request = axios
                .get("/api/patients")
                .then(response => (this.patients = response.data));
        },
        props: {},

                // filters: {
                //     properCase(string) {
                //         return string.charAt(0).toUpperCase() + string.slice(1);
                //     }
                // }
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