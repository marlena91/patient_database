<template>
  <div>
    <div class="row">
      <div class="col-md-12 mb-2">
        <v-select
          :options="diseases"
          label="name"
          v-model="selectedDisease"
          placeholder="Dostępne choroby..."
        ></v-select>
      </div>
    </div>
    <div class="row">
      <div class="d-flex justify-content-center">
        <button
          @click="diseasePatientCreate"
          class="btn btn-primary col-md-12 mb-2"
        >
          Dodaj
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  props: ["patient_id"],

  data() {
    return {
      diseases: [],
      selectedDisease: "",
    };
  },
  computed: {},
  mounted() {},
  created() {
    axios.get("/api/diseases").then((response) => {
      this.diseases = response.data.data;
    });
  },
  methods: {
    async diseasePatientCreate() {
      await axios
        .post(
          `/api/diseases-patients/${this.selectedDisease.id}/${this.patient_id}`
        )
        .then((response) => {
          this.$emit("newDisease", this.selectedDisease);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>

<style scoped>
</style>
