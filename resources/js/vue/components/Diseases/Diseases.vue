<template>
    <div>
        <div v-if='(user.role==="admin") || (user.role==="doctor")'>
            <router-link :to="{ name: 'disease-create'}">
                <div class="card-title">
                    <button class="btn btn-light btn-block mb-4">Dodaj chorobę</button>
                </div>
            </router-link>
        </div>
        <div v-if="!loading">
            <v-select class="col-md-8" :options="diseasesForSelect" placeholder="Dostępne choroby..."></v-select>
            

                    <!-- <div div v-if='(user.role==="admin")'> -->
                    <!-- <div>
                        <button @click="deleteDisease(disease.id)" class="btn btn-info btn-block m-1 btn-sm">Usuń</button>
                    </div>
                    
                    <div>
                    <div v-if='(user.role==="admin") || (user.role==="doctor")'>
                        <router-link class="text-decoration-none" :to="{ name: 'disease-edit', params: { id: disease.id } }">
                            <button class="btn btn-info btn-block m-1 btn-sm">Edytuj</button>
                        </router-link>
                    </div> -->
        </div>
        <div v-else>Loading...</div>
    </div>
</template>
<script>
import {mapState} from "vuex";


export default {
    components: {
    },
    data() {
        return {
            diseases: [],
            loading: false,
            diseasesForSelect: []
        };
    },
    computed: {
        ...mapState({
            user: "user",
        }),
        test(){
            this.diseases.forEach(element => {
                this.diseasesForSelect.push(element.name)
            });
        }
    },
    methods: {
        deleteDisease(id) {
            axios.delete(`/api/diseases/${id}}`)
            .then(response=>{
                    console.log(response);
                    this.diseases = this.diseases.filter((item) => item.id !== id)

                }).catch(error=>{
                    console.log(error)
                })
        }, 

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
<style scoped>
</style>
