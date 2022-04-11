<template>
    <div>
        <div v-if="!loading">
            <div v-for="medicalNote in medicalNotes" :key="medicalNote.id">
                <h5>{{ medicalNote.title }}</h5>
                <div v-if='(user.role==="admin") || (user.role==="doctor")'>
                    <router-link :to="{ name: 'medical-note-edit', params: {id: medicalNote.id}}">
                        <button class="btn btn-outline-dark btn-block m-1 btn-sm">Edytuj</button>
                    </router-link>
                </div>
                <div v-if='(user.role==="admin")'>
                    <button @click="deleteMedicalNote(medicalNote.id)" class="btn btn-outline-dark btn-block m-1 btn-sm">Usuń</button>
                </div>
                <p>{{ medicalNote.description }}</p>
            </div>
        </div>
        <div v-else>Loading...</div>
        <div v-if='(user.role==="admin") || (user.role==="doctor")'>
            <button class="btn btn-warning btn-block mb-4" @click="showCreateMedicalNote=true">Dodaj dokumentację</button>
        </div>
        <div>
            <create-medical-note v-if="showCreateMedicalNote" v-bind:patient_id="patient_id"></create-medical-note>
        </div>
    </div>
</template>
<script>
import CreateMedicalNote from './CreateMedicalNote.vue';
import {mapState} from "vuex";

export default {
    components: {
        CreateMedicalNote
    },
    props: ['patient_id'],
    data() {
        return{
            loading: false,
            medicalNotes: [],
            showCreateMedicalNote: false,
        }
    },
    computed: {
        ...mapState({
            user: "user",
        })
    },
    methods: {
        deleteMedicalNote(id) {
            axios.delete(`/api/medical-notes/${id}`)
            .then(response=>{
                    console.log(response);
                    this.medicalNotes = this.medicalNotes.filter((item) => item.id !== id);
                }).catch(error=>{
                    console.log(error)
                })
        }
    },
    created() {
        this.loading = true;
        axios
            .get(`/api/medical-note-patient/${this.$route.params.id}`)
            .then(response => {(this.medicalNotes = response.data.data);
                this.loading = false;});
    },
}
</script>
<style scoped>

</style>
