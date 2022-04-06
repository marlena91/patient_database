<template>
    <div>
        <h5 class="text-uppercase text-secondary font-weight-bolder mt-3">Dane pacjenta: </h5>
        <form @submit.prevent="create">
             <div class="form-row mb-4">
                <div class="form-group col-md-6 mt-3">
                    <input type="text" v-model="patient.name" class="form-control form-control-sm" placeholder="Imię...">
                </div>
                <div class="form-group col-md-6 mt-3">
                    <input type="text" v-model="patient.lastname" class="form-control form-control-sm" placeholder="Nazwisko...">
                </div>
                <div class="form-group col-md-6 mt-3">
                    <input type="text" v-model="patient.pesel" class="form-control form-control-sm" placeholder="Pesel...">
                </div>
                <div class="form-group col-md-6 mt-3">
                    <input type="text" v-model="patient.birthday" class="form-control form-control-sm" placeholder="Data urodzenia...">
                </div>
            </div>
            <button type="submit" class="btn btn-secondary btn-block mb-4">Utwórz</button>
        </form>       

    </div>
</template>
<script>

    export default {
        components: {},
        data() {
            return {
                patient: {
                    name: "",
                    lastname: "",
                    pesel: "", 
                    birthday: ""
                } 
            };
        },
        computed: {},
        methods: {
            async create(){
                await axios.post(`/api/patients`, this.patient).then(response=>{
                    this.$router.push({name:"patients"})
                }).catch(error=>{
                    console.log(error)
                })
            }
        },
        created() {},
        props: {},
    };
</script>

