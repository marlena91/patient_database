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
                    <button class="btn btn-outline-dark btn-block mb-4">Edytuj</button>
                    <button class="btn btn-outline-dark btn-block mb-4">Usuń</button>
                </div>   
            </div>
        </div>
        
    </div>
</template>
<script>

export default{
    props: { id: Number, name: String, lastname: String, pesel: Number, birthday: String }
}
</script>
