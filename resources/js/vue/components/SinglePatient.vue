<template>
    <div class="column ">
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-body">
                    <h2>{{ patient.name }} {{ patient.lastname }}</h2>
                    <hr>
                    <article>
                        <p>Pesel: {{ patient.pesel}}</p>
                        <p>Data urodzenia: {{ patient.birthday}}</p>
                    </article>
                </div>
                <div class="pt-3">
                     <router-link :to="{ name: 'patient-edit', params: patient.id}">
                        <button class="btn btn-outline-dark btn-block m-4">Edytuj</button>
                    </router-link>
                    <button @click="deletePatient(patient.id)" class="btn btn-outline-dark btn-block m-4">Usuń</button>
                </div>
            </div>
                    
        </div>

        <div class="col-md-8 mt-3">
            <div class="card">
                <div class="card-title">
                    <h3>Dokumentacja medyczna i choroby pacjenta:</h3>
                </div>
                <div class="card-body">
                    <div>
                        <medical-note v-bind:patient_id="patient.id"></medical-note>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import MedicalNote from './MedicalNote.vue';

export default {
    components: {
        MedicalNote
    },
    data() {
        return{
          patient: []
        }
    },
    mounted() {    },
    created() {
        axios
        .get(`/api/patients/${this.$route.params.id}`)
        .then(response => (this.patient = response.data.data))
    },
    methods: {
        deletePatient(id) {
            axios.delete(`/api/patients/${id}`)
            .then(response=>{
                    console.log(response)
                }).catch(error=>{
                    console.log(error)
                })
        }
    }
}
</script>
