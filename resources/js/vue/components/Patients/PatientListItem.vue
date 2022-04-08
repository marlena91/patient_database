<template>
    <div>
        <div>
            <div class="card-body">
                <router-link class="text-decoration-none" :to="{ name: 'patient', params: { id } }">
                    <div class="card-title">
                        <h3 class="text-decoration-none text-dark font-weight-bolder mt-3">{{ name }} {{ lastname }}</h3>
                    </div>
                </router-link>
                <div class="card-text">
                    <p>Pesel: {{ pesel }} | Data urodzenia: {{ birthday }} </p>
                    <router-link :to="{ name: 'patient-edit', params: { id }}">
                        <button class="btn btn-outline-dark btn-block mb-4">Edytuj</button>
                    </router-link>

                    <button @click="deletePatient(id)" class="btn btn-outline-dark btn-block mb-4">Usuń</button>
                </div>
            </div>
        </div>

    </div>
</template>
<script>

export default{
    props: { id: Number, name: String, lastname: String, pesel: String, birthday: String },
    data() {
        return {

        }
    },
    methods: {
        deletePatient(id) {
            axios.delete(`/api/patients/${id}`)
            .then(response=>{
                    console.log(response.data.data);
                    // this.$router.go();
                    this.$emit('id', id)
                }).catch(error=>{
                    console.log(error)
                });
        }
    }
}
</script>
