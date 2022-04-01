<template>
    <div>
        <h5 class="text-uppercase text-secondary font-weight-bolder mt-3">Dane pacjenta: </h5>
        <div class="form-row mb-4">
            <div class="form-group col-md-6 mt-3">
                <input type="text" name="name" v-model="name" class="form-control form-control-sm" placeholder="Imię...">
            </div>
            <div class="form-group col-md-6 mt-3">
                <input type="text" name="lastname" v-model="lastname" class="form-control form-control-sm" placeholder="Nazwisko...">
            </div>
            <div class="form-group col-md-6 mt-3">
                <input type="text" name="pesel" v-model="pesel" class="form-control form-control-sm" placeholder="Pesel...">
            </div>
            <div class="form-group col-md-6 mt-3">
                <input type="text" name="birthday" v-model="birthday" class="form-control form-control-sm" placeholder="Data urodzenia...">
            </div>
        </div>
        <button class="btn btn-warning btn-block mb-4">Dodaj dokumentację</button>
        <button class="btn btn-secondary btn-block mb-4">Utwórz</button>

    </div>
</template>
<script>

    export default {
        components: {},
        data() {
            return {
            name: null,
            lastname: null,
            pesel: null, 
            birthday: null
            };
        },
        computed: {},
        methods: {},
        created() {},
        props: {},
    };
</script>

