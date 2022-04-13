<template>
  <div p-3>
    <div class="row border-bottom p-3">
      <div class="col-md-12">
        <h4>Dokumentacja medyczna pacjenta</h4>
      </div>
    </div>
    <div v-if="!loading">
      <div
        class="row border-bottom"
        v-for="medicalNote in medicalNotes"
        :key="medicalNote.id"
      >
        <div class="col-md-3 border-end">
          <div
            class="d-flex align-items-center justify-content-center h-100 w-100"
          >
            <h6>{{ medicalNote.title }}</h6>
          </div>
        </div>
        <div class="col-md-8 border-end p-1">
          <div class="d-flex align-items-center h-100 w-100">
            <p class="justify">{{ medicalNote.description }}</p>
          </div>
        </div>
        <div class="col-md-1">
          <div class="d-flex align-items-center h-100 w-100">
            <div>
              <div v-if="user.role === 'admin' || user.role === 'doctor'">
                <router-link
                  class="text-decoration-none"
                  :to="{
                    name: 'medical-note-edit',
                    params: { id: medicalNote.id },
                  }"
                >
                  Edytuj
                </router-link>
              </div>
              <div v-if="user.role === 'admin'">
                <div @click="deleteMedicalNote(medicalNote.id)" class="">
                  <a href="#" class="text-decoration-none text-danger">
                    Usuń
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-else>Loading...</div>
    <div class="row p-3">
      <div v-if="user.role === 'admin' || user.role === 'doctor'">
        <button
          class="btn btn-primary btn-block"
          @click="showCreateMedicalNote = true"
        >
          Dodaj nową dokumentację
        </button>
      </div>
    </div>

    <div>
      <create-medical-note
        v-if="showCreateMedicalNote"
        v-bind:patient_id="patient_id"
      ></create-medical-note>
    </div>
  </div>
</template>
<script>
import CreateMedicalNote from "./CreateMedicalNote.vue";
import { mapState } from "vuex";

export default {
  components: {
    CreateMedicalNote,
  },
  props: ["patient_id"],
  data() {
    return {
      loading: false,
      medicalNotes: [],
      showCreateMedicalNote: false,
    };
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
          this.medicalNotes = this.medicalNotes.filter(
            (item) => item.id !== id
          );
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  created() {
    this.loading = true;
    axios
      .get(`/api/medical-note-patient/${this.$route.params.id}`)
      .then((response) => {
        this.medicalNotes = response.data.data;
        this.loading = false;
      });
  },
};
</script>
<style scoped>
.justify {
  text-align: justify;
}
</style>
