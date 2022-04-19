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
        <medical-note-list-item
          v-if="!showEditMedicalNote"
          v-bind="medicalNote"
          @id="deleteMedicalNote"
          @showEdit="editMedicalNote"
        ></medical-note-list-item>
        <edit-medical-note
          v-bind="medicalNote"
          v-if="showEditMedicalNote"
          @hideEdit="hideEdit"
        >
        </edit-medical-note>
      </div>
    </div>
    <div v-else>Loading...</div>
    <div class="row p-3">
      <div v-if="user.role === 'admin' || user.role === 'doctor'">
        <button
          v-if="!showEditMedicalNote"
          class="btn btn-primary btn-block"
          @click="showCreateMedicalNote = true"
        >
          Dodaj nową dokumentację
        </button>
      </div>
    </div>

    <div class="row p-3">
      <div class="d-flex justify-content-center align-content-center">
        <create-medical-note
          v-if="showCreateMedicalNote"
          v-bind:patient_id="patient_id"
        ></create-medical-note>
      </div>
    </div>
  </div>
</template>
<script>
import CreateMedicalNote from "./CreateMedicalNote.vue";
import EditMedicalNote from "./EditMedicalNote.vue";
import { mapState } from "vuex";
import MedicalNoteListItem from "./MedicalNoteListItem.vue";

export default {
  components: {
    CreateMedicalNote,
    EditMedicalNote,
    MedicalNoteListItem,
  },
  props: ["patient_id"],
  data() {
    return {
      loading: false,
      medicalNotes: [],
      showCreateMedicalNote: false,
      showEditMedicalNote: false,
    };
  },
  computed: {
    ...mapState({
      user: "user",
    }),
  },
  methods: {
    getData() {
      this.loading = true;

      axios
        .get(`/api/medical-note-patient/${this.$route.params.id}`)
        .then((response) => {
          this.medicalNotes = response.data.data;
          this.loading = false;
        });
    },
    deleteMedicalNote(id) {
      this.medicalNotes = this.medicalNotes.filter((item) => item.id !== id);
    },
    editMedicalNote(id) {
      this.medicalNotes = this.medicalNotes.filter((item) => item.id === id);

      this.showEditMedicalNote = true;
    },
    hideEdit() {
      this.showEditMedicalNote = false;
      this.getData();
    },
  },
  created() {
    this.getData();
  },
};
</script>
<style scoped>
.justify {
  text-align: justify;
}
</style>
