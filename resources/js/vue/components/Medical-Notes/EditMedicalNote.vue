<template>
  <div>
    <form @submit.prevent="update" class="row">
      <div class="col-md-3 border-end d-flex align-items-center">
        <input
          type="text"
          v-model="medicalNote.title"
          class="flex-fill mt-2"
          placeholder="Tytuł dokumentacji..."
          required
        />
      </div>

      <div class="col-md-7 border-end p-1 d-flex align-items-center">
        <textarea
          type="text"
          v-model="medicalNote.description"
          class="flex-fill mt-2"
          required
        ></textarea>
      </div>

      <div class="col-md-2 d-flex align-items-center justify-content-center">
        <div @click="update(id)" class="">
          <a href="#" class="text-decoration-none text-primary"> Zapisz </a>
        </div>
      </div>
    </form>
    <div class="row mb-2">
      <div class="d-flex col-md-12 justify-content-center mb-2 text-danger">
        {{ error }}
      </div>
    </div>
  </div>
</template>
<script>
export default {
  components: {},
  props: {
    id: Number,
    title: String,
    description: String,
    patients_id: Number,
  },
  data() {
    return {
      medicalNote: {
        title: this.title,
        description: this.description,
        patients_id: this.patients_id,
      },
      error: "",
    };
  },
  computed: {},
  mounted() {},
  methods: {
    async update(id) {
      try {
        await axios
          .put(`/api/medical-notes/${id}`, this.medicalNote)
          .then((response) => {
            this.$emit("hideEdit");
          });
      } catch (err) {
        this.error = err.response.data.message;

        console.log(this.error);
      }
    },
  },
  created() {},
};
</script>

