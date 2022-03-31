<template>
    <div>
        <div>
            <div class="card-body">
                <router-link :to="{ name: 'patient', params: { id } }">
                    <div class="card-title"> 
                        <p>{{ name }} {{ lastname }}</p>
                    </div>
                </router-link>
                <div class="card-text">
                    <p>Pesel: {{ pesel }} | Data urodzenia: {{ birthday }} 
                    <p>edit delete</p>
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
