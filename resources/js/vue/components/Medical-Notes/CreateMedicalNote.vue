<template>
  <div>
    <h5 class="text-uppercase text-secondary font-weight-bolder my-3">
      Dodaj dokumentację medyczną:
    </h5>
    <form @submit.prevent="create">
      <div class="form-row mb-4">
        <input
          type="text"
          v-model="title"
          class="form-group col-md-12 my-2"
          placeholder="Tytuł dokumentacji..."
          required
        />
        <div class="">
          <textarea
            type="text"
            rows="5"
            cols="33"
            v-model="description"
            class="form-group col-md-12 mt-3 mb-2"
            required
          ></textarea>
        </div>
      </div>
      <button type="submit" class="">Zapisz</button>
    </form>
  </div>
</template>
<script>
import { mapState } from "vuex";

export default {
  components: {},
  props: ["patient_id"],
  data() {
    return {
      title: "",
      description: "",
    };
  },
  mounted() {},
  computed: {
    ...mapState({
      user: "user",
    }),
    medicalNote() {
      return {
        title: this.title,
        description: this.description,
        patients_id: this.patient_id,
      };
    },
  },
  methods: {
    async create() {
      await axios
        .post(`/api/medical-notes`, this.medicalNote)
        .then((response) => {
          // this.patients = this.patients.filter((item) => item.id !== id);

          this.$router.go();
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  created() {},
};
</script>

