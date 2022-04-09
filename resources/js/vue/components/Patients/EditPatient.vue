<template>
    <div>
        <h5 class="text-uppercase text-secondary font-weight-bolder mt-3">Aktualizuj dane pacjenta: </h5>
        <form @submit.prevent="update">
            <div class="form-row mb-4">
                <div class="form-group col-md-6 mt-3">
                    <input type="text" v-model="patient.name" class="form-control form-control-sm"
                           placeholder="Imię...">
                </div>
                <div class="form-group col-md-6 mt-3">
                    <input type="text" v-model="patient.lastname" class="form-control form-control-sm"
                           placeholder="Nazwisko...">
                </div>
                <div class="form-group col-md-6 mt-3">
                    <input type="text" v-model="patient.pesel" class="form-control form-control-sm"
                           placeholder="Pesel...">
                </div>
                <div class="form-group col-md-6 mt-3">
                    <input type="text" v-model="patient.birthday" class="form-control form-control-sm"
                           placeholder="Data urodzenia...">
                </div>
            </div>
            <div class="card border-danger w-50 mb-3" v-for="error in errors" :key="error">
                {{ error }}
            </div>
            <button type="submit" class="btn btn-secondary btn-block mb-4">Zapisz</button>
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
            },
            errors: []
        }
    },
    mounted() {
        this.showPatient();
    },
    computed: {},
    methods: {
        async showPatient() {
            await axios.get(`/api/patients/${this.$route.params.id}`).then(response => {
                this.patient = response.data.data
            }).catch(error => {
                console.log(error)
            })
        },
        async update() {
            try {
                await axios.put(`/api/patients/${this.$route.params.id}`, this.patient).then(response => {
                    this.$router.push({name: "patient"})
                })
            } catch(err) {
                this.errors = err.response.data.errors;
                console.log(this.error)
            }
        }
    },
    created() {
    },
    props: {},
};
</script>

