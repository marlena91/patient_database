<template>
    <div>
        <router-link :to="{ name: 'disease-create'}">
            <div class="card-title">
                <button class="btn btn-light btn-block mb-4">Dodaj chorobę</button>
            </div>
        </router-link>
        <div v-if="!loading">
            <div class="card w-50 mt-3" v-for="disease in diseases" :key="disease.id">
                <disease-list-item v-bind="disease"></disease-list-item>
            </div>
        </div>
        <div v-else>Loading...</div>
    </div>
</template>
<script>
import DiseaseListItem from './DiseaseListItem.vue';

export default {
    components: {
        DiseaseListItem,
    },
    data() {
        return {
            diseases: [],
            loading: false,
        };
    },
    computed: {},
    methods: {},
    created() {
        this.loading = true;
        const request = axios
            .get("/api/diseases").then(response => {
                this.diseases = response.data.data;
                this.loading = false;
            });
    },
    props: {},
};
</script>
