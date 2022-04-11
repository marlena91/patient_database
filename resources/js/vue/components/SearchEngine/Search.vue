<template>
    <div>
        <div>
            <h5 class="text-uppercase text-secondary font-weight-bolder mt-3">Wyszukiwarka:</h5>
            <div class="form-row mb-4">
                <div class="form-group col-md-10 mt-3">
                    <input type="text" v-model="name" class="form-control form-control-sm" placeholder="Imię...">
                </div>
                <div class="form-group col-md-10 mt-3">
                    <input type="text" v-model="lastname" class="form-control form-control-sm"
                           placeholder="Nazwisko...">
                </div>
                <div class="form-group col-md-10 mt-3">
                    <input type="text" v-model="pesel" class="form-control form-control-sm" placeholder="Pesel...">
                </div>
                <div class="form-group col-md-10 mt-3">
                    <input type="text" v-model="birthday" class="form-control form-control-sm"
                           placeholder="Data urodzenia...">
                </div>
            </div>
            <div class="card border-danger w-50 mb-3" v-for="error in errors" :key="error">
                {{ error }}
            </div>
            <button @click="search" class="btn col-md-10 btn-secondary btn-block mb-4">Szukaj</button>

        </div>
    </div>
</template>
<script>


export default {
    components: {},
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
    computed: {},
    methods: {
        async search() {
            this.errors = null;
            try {
                await axios.get(
                    `/api/search?name=${this.name}&lastname=${this.lastname}&pesel=${this.pesel}&birthday=${this.birthday}`
                ).then(response => {
                    this.searchingResults = response.data.data;
                    this.$emit('searchingResults', this.searchingResults)
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
