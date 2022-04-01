<template>
    <div>
        <div v-if="!loading">
            <div class="d-flex flex-column mb-4" v-for="row in rows" :key="row">
                <div class="card w-50 mt-3" v-for="disease in diseases" :key="disease.id">
                    <disease-list-item v-bind="disease"></disease-list-item>
                </div>
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
    computed: {
        rows() {
                return this.diseases.length;
                }
    },
    methods: {
    },
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
