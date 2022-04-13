<template>
  <div>
    <h5 class="text-uppercase text-secondary font-weight-bolder mt-3">
      Dodaj nową chorobę:
    </h5>
    <form @submit.prevent="update">
      <div class="form-row mb-4">
        <div class="form-group col-md-6 mt-3">
          <textarea
            type="text"
            rows="5"
            cols="33"
            v-model="disease.name"
            class="form-control form-control-sm"
            autofocus
          ></textarea>
        </div>
      </div>
      <button type="submit" class="btn btn-warining btn-block mb-4">
        Zapisz
      </button>
    </form>
  </div>
</template>
<script>
import { mapState } from "vuex";

export default {
  components: {},
  data() {
    return {
      disease: {
        name: "",
      },
    };
  },
  mounted() {
    this.showDisease();
  },
  computed: {
    ...mapState({
      user: "user",
    }),
  },
  methods: {
    async showDisease() {
      await axios
        .get(`/api/diseases/${this.$route.params.id}`)
        .then((response) => {
          this.disease = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async update() {
      await axios
        .put(`/api/diseases/${this.$route.params.id}`, this.disease)
        .then((response) => {
          this.$router.push({ name: "patients" });
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  created() {
    if (this.user.role !== "admin" && this.user.role !== "doctor") {
      this.$router.push({ name: "login" });
    }
  },
  props: [],
};
</script>

