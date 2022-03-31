<template>
    <div class="column">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2>{{ patient.name }} {{ patient.lastname }}</h2>
                    <hr>
                    <article>
                        <p>Pesel: {{ patient.pesel}}</p>
                        <p>Data urodzenia: {{ patient.birthday}}</p>
                    </article>
                </div>
            </div>
        </div>
        <div class="col-md-8 mt-3">
            <div class="card">
                <div class="card-title">
                    <h3>Dokumentacja medyczna i choroby pacjenta:</h3>
                </div>
                <div class="card-body">
                    <div>
                        Lorem ipsum
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return{
          patient: []
        }
    },
    created() {
        axios
        .get(`/api/patients/${this.$route.params.id}`)
        .then(response => (this.patient = response.data.data))
    },
}
</script>
