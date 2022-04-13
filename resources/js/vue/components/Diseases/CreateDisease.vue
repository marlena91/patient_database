<template>
  <div>
    <h5 class="text-uppercase text-secondary font-weight-bolder mt-3">
      Nowa choroba:
    </h5>
    <form @submit.prevent="create">
      <div class="form-row mb-4">
        <div class="form-group col-md-6 mt-3">
          <input
            type="text"
            v-model="disease.name"
            class="form-control form-control-sm"
            placeholder="Nazwa..."
          />
        </div>
      </div>
      <button type="submit" class="btn btn-secondary btn-block mb-4">
        Utwórz
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
  computed: {
    ...mapState({
      user: "user",
    }),
  },
  methods: {
    async create() {
      await axios
        .post(`/api/diseases`, this.disease)
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
  props: {},
};
</script>
