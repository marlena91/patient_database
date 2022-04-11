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
            <!-- <div class="col-sm-5">
                <Select2 v-model="optionSelected" 
                    :options="myOptions"  
                    @change="myChangeEvent($event)" @select="mySelectEvent($event)" />
                    <p>Value: {{ optionSelected }}</p>
            </div> -->
        </div>
            <!-- <div class="card mt-3" v-for="disease in diseases" :key="disease.id">
                <div>
                    <disease-list-item v-bind="disease"></disease-list-item>

                    <div div v-if='(user.role==="admin")'>
                        <button @click="deleteDisease(disease.id)" class="btn btn-info btn-block m-1 btn-sm">Usuń</button>
                    </div>
                    
                    <div v-if='(user.role==="admin") || (user.role==="doctor")'>
                        <router-link class="text-decoration-none" :to="{ name: 'disease-edit', params: { id: disease.id } }">
                            <button class="btn btn-info btn-block m-1 btn-sm">Edytuj</button>
                        </router-link>
                    </div>
                </div>
            </div> -->

        <div v-else>Loading...</div>
    </div>
</template>
<script>
// import DiseaseListItem from './DiseaseListItem.vue';
import {mapState} from "vuex";
// import Select2 from "../Select/Select2";


export default {
    components: {
        // Select2,
        // DiseaseListItem,
    },
    data() {
        return {
            diseases: [],
            loading: false,
            myValue: '',
            myOptions: ['op1', 'op2', 'op3'],
            optionSelected: null
        };
    },
    computed: {
        ...mapState({
            user: "user",
        })
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
        myChangeEvent(val){
            console.log(val);
        },
        mySelectEvent({id, text}){
            console.log({id, text})
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
<style scoped>
</style>
