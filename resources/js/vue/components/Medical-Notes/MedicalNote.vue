<template>
    <div>
        <div v-if="!loading">
            <div v-for="medicalNote in medicalNotes" :key="medicalNote.id"> 
                <div class="medicalNote" v-if="medicalNote.patients_id === patient_id">
                    <h5>{{ medicalNote.title }}</h5>
                     <router-link :to="{ name: 'medical-note-edit', params: {id: medicalNote.id}}">
                        <button class="btn btn-outline-dark btn-block m-1 btn-sm">Edytuj</button>
                    </router-link>
                    <button @click="deleteMedicalNote(medicalNote.id)" class="btn btn-outline-dark btn-block m-1 btn-sm">Usuń</button>
                    <p>{{ medicalNote.description }}</p>
                    
                </div>
            </div>
        </div> 
        <div v-else>Loading...</div>
        <button class="btn btn-warning btn-block mb-4" @click="showCreateMedicalNote=true">Dodaj dokumentację</button>
        <div>
            <create-medical-note v-show="showCreateMedicalNote" v-bind:patient_id="patient_id"></create-medical-note>
        </div>
    </div>
</template>
<script>
import CreateMedicalNote from './CreateMedicalNote.vue';

export default {
    components: {
        CreateMedicalNote
    },
    data() {
        return{
            loading: false,
            medicalNotes: [],
            showCreateMedicalNote: false
        }
    },
    computed: {
    },
    methods: {
        deleteMedicalNote(id) {
            axios.delete(`/api/medical-notes/${id}`)
            .then(response=>{
                    console.log(response);
                    this.$router.go();
                }).catch(error=>{
                    console.log(error)
                })
        }
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
