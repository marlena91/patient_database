<template>
    <div>
        test
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
        .then(response => (this.patient = response.data))
    },
}
</script>
