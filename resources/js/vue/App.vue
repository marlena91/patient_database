<template>

    <div class="box">

        <patients-component 
            v-for="patient in patients"
            v-bind="patient"
            :key="patient.id"
        ></patients-component>

    </div>

</template>


<script>
function Patient({ id, name, lastname, pesel, birthday}) {
    this.id = id;
    this.name = name;
    this.lastname = lastname;
    this.pesel = pesel;
    this.birthday = birthday;
  }
import PatientsComponent from './PatientsComponent.vue'

    export default {
        data() {
            return {
                patients: []
            }
        },
        methods: {
            async read() {
            const { data } = window.axios.get('/api/patients');
            console.log(data)         
            }
        },
        components: {
            PatientsComponent
        }
    }
</script>