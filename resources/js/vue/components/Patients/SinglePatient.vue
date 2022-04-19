<template>
  <div class="container-md p-3 my-3">
    <div class="row pb-3">
      <router-link
        class="text-decoration-none text-muted"
        :to="{ name: 'patients' }"
        >Powrót do strony głównej</router-link
      >
    </div>
    <div class="row">
      <div class="col-md-12 text-center">
        <h1 class="display-2">{{ patient.name }} {{ patient.lastname }}</h1>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3 text-right bg-light pb-3 rounded-2">
        <h3 class="mt-3 mb-3">Dane pacjenta:</h3>
        <h5>Pesel:</h5>
        <p class="text-muted">{{ patient.pesel }}</p>
        <h5>Data urodzenia:</h5>
        <p class="text-muted">{{ patient.birthday }}</p>
        <h5>Rozpoznane choroby:</h5>
        <div
          class="row pe-2 pb-1 bg-color-primary"
          v-for="disease in patient.diseases"
          :key="disease.id"
        >
          <div class="col-md-9 border-bottom">{{ disease.name }}</div>
          <div class="col-md-3 d-flex justify-content-end">
            <button
              @click="deleteDisease(disease.id, patient.id)"
              class="btn btn-outline-danger btn-sm"
              v-if="user.role === 'admin'"
            >
              Usuń
            </button>
          </div>
        </div>

        <div v-if="user.role === 'admin' || user.role === 'doctor'">
          <div
            v-if="!showAddDisease"
            @click="addDiseaseToPatient()"
            class="text-primary"
          >
            <a href="#" class="text-decoration-none"> Dodaj chorobę </a>
          </div>
          <add-disease-to-patient
            v-if="showAddDisease"
            v-bind:patient_id="patient.id"
            @newDisease="newDisease"
          ></add-disease-to-patient>
        </div>
      </div>
      <div class="col-md-8 text-center bg-light p-3 rounded-2 ms-3">
        <div class="">
          <medical-note v-bind:patient_id="patient.id"></medical-note>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import MedicalNote from "../Medical-Notes/MedicalNote.vue";
import AddDiseaseToPatient from "../Patient-Disease/AddDiseaseToPatient.vue";
import { mapState } from "vuex";

export default {
  components: {
    MedicalNote,
    AddDiseaseToPatient,
  },
  data() {
    return {
      patient: [],
      showAddDisease: false,
    };
  },
  computed: {
    ...mapState({
      user: "user",
    }),
  },
  mounted() {},
  created() {
    axios
      .get(`/api/patients/${this.$route.params.id}`)
      .then((response) => (this.patient = response.data.data));
  },
  methods: {
    deletePatient(id) {
      axios
        .delete(`/api/patients/${id}`)
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
      this.$router.push({ name: "patients" });
    },
    deleteDisease(disease_id, patient_id) {
      axios
        .delete(`/api/diseases-patients/${disease_id}/${patient_id}`)
        .then((response) => {
          this.patient.diseases = this.patient.diseases.filter((item) => {
            return item.id !== disease_id;
          });
        })
        .catch((error) => {
          console.log(error);
        });
    },
    addDiseaseToPatient() {
      this.showAddDisease = true;
    },
    newDisease(selectedDisease) {
      this.patient.diseases.push(selectedDisease);
      this.showAddDisease = false;
    },
  },
};
</script>
<style scoped>
</style>
