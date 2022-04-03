<template>
    <div>
        <div v-if="!loading">test
        </div>
        <div v-else>Loading...</div>
    </div>
</template>
<script>

export default {
    components: {
    },
    data() {
        return{
            loading: false,
        }
    },
    methods: {

    },
    created() {
        this.loading = true;
    },
    props: { id: Number }
}
</script>
