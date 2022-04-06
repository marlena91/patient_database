<template>
    <div>
        <div v-if="!loading">

            <div class="card w-50 mt-3" v-for="disease in diseases" :key="disease.id">
                <disease-list-item v-bind="disease"></disease-list-item>
                <button @click="diseasePatientCreate(disease.id, test)" class="btn btn-outline-dark btn-block m-4">Dodaj
                    pacjentowi
                </button>
            </div>
        </div>
        <div v-else>Loading...</div>
    </div>
</template>

<script>
import DiseaseListItem from '../Diseases/DiseaseListItem';

export default {
    name: "AddDiseaseToPatient",
    components: {
        DiseaseListItem
    },
    data() {
        return {
            diseases: [],
            loading: false,
            test: this.$route.params.patient_id,
        }
    },
    mounted() {
    },
    created() {
        this.loading = true;
        axios.get("/api/diseases").then(response => {
            this.diseases = response.data.data;
            this.loading = false;
        });
    },
    methods: {
        async diseasePatientCreate(disease_id, patient_id) {
            await axios.post(`/api/diseasespatients/${disease_id}/${patient_id}`).then(response => {
                this.$router.push({name: "patient", params: {id: patient_id}})
            }).catch(error => {
                console.log(error)
            })
        }
    }
}
</script>

<style scoped>

</style>
