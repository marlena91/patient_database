<template>
  <div class="row">
    <div class="col-md-3 border-end">
      <div class="d-flex align-items-center justify-content-center h-100 w-100">
        <h6>{{ title }}</h6>
      </div>
    </div>
    <div class="col-md-7 border-end p-1">
      <div class="d-flex align-items-center h-100 w-100">
        <p class="justify">{{ description }}</p>
      </div>
    </div>
    <div class="col-md-2">
      <div class="row d-flex justify-content-around">
        <div
          class="col-md-5"
          v-if="user.role === 'admin' || user.role === 'doctor'"
        >
          <button
            @click="showEditMedicalNote"
            class="btn btn-outline-primary btn-sm m-3"
          >
            Edytuj
          </button>
        </div>
        <div class="col-md-5" v-if="user.role === 'admin'">
          <div @click="deleteMedicalNote(id)" class="">
            <button class="btn btn-outline-danger btn-sm m-3">Usuń</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapState } from "vuex";

export default {
  props: {
    id: Number,
    title: String,
    description: String,
    patients_id: Number,
  },
  data() {
    return {};
  },
  computed: {
    ...mapState({
      user: "user",
    }),
  },
  methods: {
    deleteMedicalNote(id) {
      axios
        .delete(`/api/medical-notes/${id}`)
        .then((response) => {
          console.log(response);
          this.$emit("id", id);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    showEditMedicalNote() {
      this.$emit("showEdit", this.id);
    },
  },
};
</script>
