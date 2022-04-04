<template>
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
        <button @click="search" class="btn btn-secondary btn-block mb-4">Szukaj</button>
    </div>
</template>
<script>


export default {
    components: {
    },
    data() {
        return {
            name: null,
            lastname: null,
            pesel: null, 
            birthday: null
        };
    },
    computed: {

    },
    methods: {
        async search() {
        try {
            await axios.get(
            `/api/patients/search?name=${this.name}&lastname=${this.lastname}&pesel=${this.pasel}&birthday=${this.birthday}`
            );
        } catch (err) {
            this.errors = err.response.data.errors;
            }
        }
    },
    created() {

    },
    props: {},
}
</script>
