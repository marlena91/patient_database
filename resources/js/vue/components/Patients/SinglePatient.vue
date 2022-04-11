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
                    <div v-if='(user.role==="admin") || (user.role==="doctor")'>
                        <router-link :to="{ name: 'patient-edit', params: patient.id}">
                            <button class="btn btn-outline-dark btn-block m-4">Edytuj</button>
                        </router-link>
                    </div>
                    <div v-if='user.role==="admin"'>
                        <button @click="deletePatient(patient.id)" class="btn btn-outline-dark btn-block m-4">Usuń</button>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-8 mt-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Dokumentacja medyczna i choroby pacjenta:</h3>
                    <hr>

                    <h5>Rozpoznane choroby:</h5>
                    <div v-for="disease in patient.diseases" :key="disease.id">
                        <li>{{disease.name}}
                            <div v-if='(user.role==="admin")'>
                                <button @click="deleteDisease(disease.id, patient.id)" class="delbtn btn btn-danger btn-block m-1 btn-sm">Usuń</button>
                            </div>
                        </li>
                    </div>
                    <div v-if='(user.role==="admin") || (user.role==="doctor")'>
                        <button @click="addDiseaseToPatient()" class="btn btn-info btn-block m-1 btn-sm">
                            Nowa choroba
                        </button>
                    </div>
                    <hr>
                    <div class="card-text">
                        <medical-note v-bind:patient_id="patient.id"></medical-note>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import MedicalNote from '../Medical-Notes/MedicalNote.vue';
import {mapState} from "vuex";

export default {
    components: {
        MedicalNote
    },
    data() {
        return{
          patient: []
        }
    },
   computed: {
        ...mapState({
            user: "user",
        })
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
                    console.log(response);
                }).catch(error=>{
                    console.log(error)
                });
            this.$router.push({name: "patients"})
        },
        deleteDisease(disease_id, patient_id){
            axios.delete(`/api/diseasespatients/${disease_id}/${patient_id}`)
            .then(response=>{
                    this.patient.diseases = this.patient.diseases.filter((item) => {console.log(item.id); return item.id !== disease_id});
                }).catch(error=>{
                    console.log(error)
                })
        },
        addDiseaseToPatient(){
            this.$router.push({name:"disease-patient.show", params: { patient_id: this.patient.id }})
        }
    }
}

</script>
<style scoped>

</style>
