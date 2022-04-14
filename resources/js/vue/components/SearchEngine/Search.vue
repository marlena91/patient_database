<template>
  <div>
    <div>
      <h5 class="text-uppercase text-secondary font-weight-bolder mt-3">
        Wyszukiwarka:
      </h5>
      <div class="form-row mb-4">
        <div class="form-group col-md-10 mt-3">
          <input
            type="text"
            v-model="name"
            class="form-control form-control-sm"
            placeholder="Imię..."
            required
          />
        </div>
        <div class="form-group col-md-10 mt-3">
          <input
            type="text"
            v-model="lastname"
            class="form-control form-control-sm"
            placeholder="Nazwisko..."
          />
        </div>
        <div class="form-group col-md-10 mt-3">
          <input
            type="text"
            v-model="pesel"
            class="form-control form-control-sm"
            placeholder="Pesel..."
          />
        </div>
        <div class="form-group col-md-10 mt-3">
          <input
            type="date"
            v-model="birthday"
            class="form-control form-control-sm"
          />
        </div>
      </div>
      <div class="" v-for="error in errors" :key="error">
        {{ error }}
      </div>
      <div class="mb-2">
        <button @click="search" class="btn col-md-10 btn-secondary btn-block">
          Szukaj
        </button>
      </div>
      <div class="mb-2">
        <div @click="reset" class="btn btn-secondary col-md-10 btn-block">
          Wyzeruj filtrowanie
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  components: {},
  data() {
    return {
      searchingResults: [],
      name: "",
      lastname: "",
      pesel: "",
      birthday: "",
      errors: [],
    };
  },
  computed: {},
  methods: {
    async search() {
      this.errors = null;
      try {
        await axios
          .get(
            `/api/search?name=${this.name}&lastname=${this.lastname}&pesel=${this.pesel}&birthday=${this.birthday}`
          )
          .then((response) => {
            this.searchingResults = response.data.data;
            this.$emit("searchingResults", this.searchingResults);
          });
      } catch (err) {
        this.errors = err.response.data.errors;
        console.log(this.errors);
      }
    },
    reset() {
      this.name = "";
      this.lastname = "";
      this.pesel = "";
      this.birthday = "";
      this.search();
    },
  },
  created() {},
  props: {},
};
</script>
