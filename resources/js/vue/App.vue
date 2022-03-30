<template>

    <div class="box">

        <!-- <patients-component 
            v-for="patient in patients"
            v-bind="patient"
            :key="patient.id"
        ></patients-component> -->

    <patients-component 
        :name = "firstPerson.name" 
        :last-name="firstPerson.lastName" 
        :pesel=firstPerson.pesel
        :birthday="firstPerson.birthday"
    ></patients-component>
    <patients-component 
        :name = secondPerson.name
        :last-name= secondPerson.lastName
        :pesel= secondPerson.pesel
        :birthday= secondPerson.birthday
    ></patients-component>
    </div>

</template>


<script>
import PatientsComponent from './components/PatientsComponent.vue'

    export default {
        data() {
            return {
                firstPerson: {
                    name: "Zbigniew", 
                    lastName: "Karłowski", 
                    pesel: 96041522254,
                    birthday: 19960415
                }, 
                secondPerson: {
                    name: "Luiza", 
                    lastName: "Ryba", 
                    pesel: 86060214958,
                    birthday: 19860602
                }
            }
        },
        methods: {
        },
        components: {
            PatientsComponent
        }
    }
</script>