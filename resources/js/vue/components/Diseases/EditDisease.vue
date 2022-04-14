<template>
  <div>
    <h5 class="text-uppercase text-secondary font-weight-bolder mt-3">
      Edytuj chorobę:
    </h5>
    <form @submit.prevent="update" class="form-row mb-4">
      <div class="form-group col-md-12 mt-3 mb-2">
        <input
          type="text"
          v-model="disease.name"
          class="form-control form-control-sm"
          required
        />
      </div>
      <button type="submit" class="btn col-md-12 btn-secondary btn-block">
        Zapisz
      </button>
    </form>
  </div>
</template>
<script>
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
  computed: {},
  methods: {
    async showDisease() {
      await axios
        .get(`/api/diseases/${this.id}`)
        .then((response) => {
          this.disease = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async update() {
      await axios
        .put(`/api/diseases/${this.id}`, this.disease)
        .then((response) => {
          this.$emit("changedDisease", response.data.disease.name);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  created() {},
  props: ["id"],
};
</script>

