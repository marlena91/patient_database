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
          <h3 class="mb-3">Wprowadź dane pacjenta:</h3>
          <form @submit.prevent="create">
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
            <div class="" v-for="error in errors" :key="error">
              {{ error }}
            </div>
            <button
              type
              submit
              class="btn btn-secondary btn-block col-md-12 my-3"
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
      errors: [],
    };
  },
  computed: {
    ...mapState({
      user: "user",
    }),
  },
  methods: {
    async create() {
      try {
        await axios.post(`/api/patients`, this.patient).then((response) => {
          this.$router.push({
            name: "patient",
            params: { id: response.data.patient.id },
          });
        });
      } catch (err) {
        this.errors = err.response.data.errors;
        console.log(this.errors);
      }
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

