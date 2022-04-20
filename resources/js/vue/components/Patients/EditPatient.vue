<template>
  <div>
    <div class="row pb-3">
      <router-link
        class="text-decoration-none text-muted"
        :to="{ name: 'patients' }"
        >Powrót do strony głównej</router-link
      >
    </div>

    <div class="d-flex justify-content-center align-content-center">
      <div class="row">
        <div class="bg-light rounded-2 p-5">
          <h3 class="mb-3">Aktualizuj dane pacjenta:</h3>
          <form @submit.prevent="update">
            <label for="patientName" class="form-label mt-1">Imię:</label>
            <input
              type="text"
              name="patientName"
              v-model="patient.name"
              class="form-control mb-2"
              required
            />
            <label for="patientLastname" class="form-label mt-1">
              Nazwisko:</label
            >
            <input
              type="text"
              name="patientLastname"
              v-model="patient.lastname"
              class="form-control mb-2"
              required
            />
            <label for="patientPesel" class="form-label mt-1">Pesel:</label>
            <input
              type="text"
              name="patientPesel"
              v-model="patient.pesel"
              class="form-control mb-2"
              required
            />
            <label for="patientBirthday" class="form-label mt-1"
              >Data urodzenia:</label
            >
            <input
              type="date"
              name="patientBirthday"
              v-model="patient.birthday"
              class="form-control mb-2"
              required
            />
            <div class="row mb-2">
              <div
                class="d-flex col-md-12 justify-content-center mb-2 text-danger"
              >
                {{ error }}
              </div>
            </div>
            <button
              type
              submit
              class="btn btn-secondary btn-block col-md-12 mb-3"
            >
              Zapisz
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapState } from "vuex";
export default {
  components: {},
  data() {
    return {
      patient: {
        name: "",
        lastname: "",
        pesel: "",
        birthday: "",
      },
      error: "",
    };
  },
  mounted() {
    this.showPatient();
  },
  computed: {
    ...mapState({
      user: "user",
    }),
  },
  methods: {
    async showPatient() {
      await axios
        .get(`/api/patients/${this.$route.params.id}/edit`)
        .then((response) => {
          this.patient = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async update() {
      try {
        this.patient.name = this.capitalizeFirstLetter(this.patient.name);
        this.patient.lastname = this.capitalizeFirstLetter(
          this.patient.lastname
        );
        await axios
          .put(`/api/patients/${this.$route.params.id}`, this.patient)
          .then((response) => {
            this.$router.push({ name: "patient" });
          });
      } catch (err) {
        this.error = err.response.data.message;
      }
    },
    capitalizeFirstLetter(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
    },
  },
  created() {
    if (this.user.role !== "admin" && this.user.role !== "doctor") {
      this.$router.push({ name: "login" });
    }
  },
  props: {},
};
</script>

