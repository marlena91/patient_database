<template>
    <div>
        <div>
            <h5 class="text-uppercase text-secondary font-weight-bolder mt-3">Wyszukiwarka:</h5>
                <div class="form-row mb-4">
                    <div class="form-group col-md-6 mt-3">
                        <input type="text" v-model="name" class="form-control form-control-sm" placeholder="Imię...">
                    </div>
                    <div class="form-group col-md-6 mt-3">
                        <input type="text" v-model="lastname" class="form-control form-control-sm" placeholder="Nazwisko...">
                    </div>
                    <div class="form-group col-md-6 mt-3">
                        <input type="text" v-model="pesel" class="form-control form-control-sm" placeholder="Pesel...">
                    </div>
                    <div class="form-group col-md-6 mt-3">
                        <input type="text" v-model="birthday" class="form-control form-control-sm" placeholder="Data urodzenia...">
                    </div>
                </div>
                <div class="card border-danger w-50 mb-3" v-for="error in errors" :key="error">
                {{ error }}
            </div>
            <button @click="search" class="btn btn-secondary btn-block mb-4">Szukaj</button>
            
        </div>

        <div class="card w-50 mt-3 bg-info" v-for="result in searchingResults" :key="result.id">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-decoration-none text-dark font-weight-bolder mt-3">{{ result.name }} {{ result.lastname }}</h3>
                </div>
                <div class="card-text">
                    <p>Pesel: {{ result.pesel }} | Data urodzenia: {{ result.birthday }} </p>
                    <button @click="deletePatient(id)" class="btn btn-outline-dark btn-block mb-4">Usuń</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>


export default {
    components: {
    },
    data() {
        return {
            searchingResults: [],
            name: '',
            lastname: '',
            pesel: '',
            birthday: '',
            errors: []
        };
    },
    computed: {
        hasErrors() {

        }
    },
    methods: {
        async search() {
            this.errors = null;
            try {
                await axios.get(
                `/api/search?name=${this.name}&lastname=${this.lastname}&pesel=${this.pesel}&birthday=${this.birthday}`
                ).then(response => {
                    this.searchingResults = response.data.data;
                });
            } catch (err) {
                this.errors = err.response.data.errors;
                console.log(this.errors)
                }
            }
    },
    created() {

    },
    props: {},
}
</script>
