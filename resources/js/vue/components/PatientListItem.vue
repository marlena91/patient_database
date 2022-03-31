<template>
    <div>
     <div class="card-body mb-4">
                    <div class="card-title"> 
                        <p>{{ name }} {{ lastname }}</p>
                    </div>
                     <div class="card-text">
                         <p>Pesel: {{ pesel }} | Data urodzenia: {{ birthday }} 
                         <p>edit delete</p>
                     </div>
     </div>
    </div>
</template>
<script>

export default{
    props: { id: Number, name: String, lastname: String, pesel: Number, birthday: String }
}
</script>
