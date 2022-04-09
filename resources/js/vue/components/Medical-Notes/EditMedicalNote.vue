<template>
    <div>
        <h5 class="text-uppercase text-secondary font-weight-bolder mt-3">Aktualizuj dokumentację medyczną: </h5>
        <form @submit.prevent="update">
            <div class="form-row mb-4">
                <div class="form-group col-md-6 mt-3">
                    <input type="text" v-model="medicalNote.title" class="form-control form-control-sm"
                           placeholder="Tytuł dokumentacji...">
                </div>
                <div class="form-group col-md-6 mt-3">
                    <textarea type="text" rows="5" cols="33" v-model="medicalNote.description"
                              class="form-control form-control-sm" autofocus></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-warining btn-block mb-4">Zapisz</button>
        </form>
    </div>
</template>
<script>

export default {
    components: {},
    data() {
        return {
            medicalNote: {
                title: "",
                description: "",
                patients_id: ""
            }
        }
    },
    mounted() {
        this.showMedicalNote();
    },
    computed: {},
    methods: {
        async showMedicalNote() {
            await axios.get(`/api/medical-notes/${this.$route.params.id}`).then(response => {
                this.medicalNote = response.data.data
            }).catch(error => {
                console.log(error)
            })
        },
        async update() {
            await axios.put(`/api/medical-notes/${this.$route.params.id}`, this.medicalNote).then(response => {
                this.$router.push({name: "patient", params: {id: this.medicalNote.patients_id}})
            }).catch(error => {
                console.log(error)
            })

        },

    },
    created() {
    },
    props: [],
};
</script>

