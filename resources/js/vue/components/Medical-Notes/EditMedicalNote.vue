<template>
  <div>
    <form @submit.prevent="update" class="row">
      <div class="col-md-3 border-end d-flex align-items-center">
        <input
          type="text"
          v-model="medicalNote.title"
          class="flex-fill mt-2"
          placeholder="Tytuł dokumentacji..."
        />
      </div>

      <div class="col-md-7 border-end p-1 d-flex align-items-center">
        <textarea
          type="text"
          v-model="medicalNote.description"
          class="flex-fill mt-2"
          autofocus
        ></textarea>
      </div>
      <div class="col-md-2 d-flex align-items-center justify-content-center">
        <div @click="update(id)" class="">
          <a href="#" class="text-decoration-none text-primary"> Zapisz </a>
        </div>
      </div>
    </form>
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
    };
  },
  computed: {},
  mounted() {},
  methods: {
    async update(id) {
      await axios
        .put(`/api/medical-notes/${id}`, this.medicalNote)
        .then((response) => {
          this.$emit("hideEdit");
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  created() {},
};
</script>

