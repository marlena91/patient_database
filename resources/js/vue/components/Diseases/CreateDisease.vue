<template>
  <div>
    <h5 class="text-uppercase text-secondary font-weight-bolder mt-3">
      Nowa choroba:
    </h5>
    <form @submit.prevent="create" class="form-row mb-4">
      <div class="form-group col-md-12 mt-3 mb-2">
        <input
          type="text"
          v-model="disease.name"
          class="form-control form-control-sm"
          placeholder="Nazwa..."
        />
      </div>
      <button type="submit" class="btn col-md-12 btn-secondary btn-block">
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
          this.$emit("newDisease");
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
