<template>
    <div>
        <div v-if="!loading">
            <div v-for="medicalNote in medicalNotes" :key="medicalNote.id"> 
                <div class="medicalNote" v-if="medicalNote.patients_id === patient_id">
                    <h5>{{ medicalNote.title }}</h5>
                    <p>{{ medicalNote.description }}</p>
                </div>
            </div>
        </div> 
        <div v-else>Loading...</div>
        <button class="btn btn-secondary btn-block mb-4">Dodaj dokumentację</button>
    </div>
</template>
<script>

export default {
    components: {
    },
    data() {
        return{
            loading: false,
            medicalNotes: [],
        }
    },
    computed: {
    },
    methods: {
        
    },
    created() {
        this.loading = true;
            const request_medical_notes = axios
                .get("/api/medical-notes").then(response => {
                this.medicalNotes = response.data.data;
                this.loading = false;
            });
    },
    props: ['patient_id']  
}
</script>
<style scoped>
.medicalNote{
    text-align: justify;   
}
</style>
