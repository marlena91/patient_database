<template>
    <div>
        <h5 class="text-uppercase text-secondary font-weight-bolder mt-3">Dodaj dokumentację medyczną: </h5>
        <form @submit.prevent="create">
            <div class="form-row mb-4">
                <div class="form-group col-md-6 mt-3">
                    <input type="text" v-model="title" class="form-control form-control-sm"
                           placeholder="Tytuł dokumentacji..." autofocus>
                </div>
                <div class="form-group col-md-6 mt-3">
                    <textarea type="text" rows="5" cols="33" v-model="description" class="form-control form-control-sm"
                              ></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-warining btn-block mb-4">Zapisz</button>
        </form>
    </div>
</template>
<script>

export default {
    components: {},
    props: ['patient_id'],
    data() {
        return {
            title: "",
            description: "",
        }
    },
    mounted() {
    },
    computed: {
        medicalNote() {
            return {
                title: this.title,
                description: this.description,
                patients_id: this.patient_id
            }
        }
    },
    methods: {
        async create() {
            await axios.post(`/api/medical-notes`, this.medicalNote).then(response => {
                // this.patients = this.patients.filter((item) => item.id !== id);

                this.$router.go();
            }).catch(error => {
                console.log(error)
            })
        }
    },
    created() {
    },

};
</script>

