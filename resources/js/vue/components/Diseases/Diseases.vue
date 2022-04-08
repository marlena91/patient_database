<template>
    <div>
        <router-link :to="{ name: 'disease-create'}">
            <div class="card-title">
                <button class="btn btn-light btn-block mb-4">Dodaj chorobę</button>
            </div>
        </router-link>
        <div v-if="!loading">
            <div class="card w-50 mt-3" v-for="disease in diseases" :key="disease.id">
                <div>
                <disease-list-item v-bind="disease"></disease-list-item>
                <button @click="deleteDisease(disease.id)" class="btn btn-info btn-block m-1 btn-sm">Usuń</button>
                <router-link class="text-decoration-none" :to="{ name: 'disease-edit', params: { id: disease.id } }">
                <button class="btn btn-info btn-block m-1 btn-sm">Edytuj</button>

                </router-link>

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
    computed: {},
    methods: {
        deleteDisease(id) {
            axios.delete(`/api/diseases/${id}}`)
            .then(response=>{
                    console.log(response);
                    this.$router.go();
                }).catch(error=>{
                    console.log(error)
                })
        }
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
