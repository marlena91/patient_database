<template>
  <div>
    <div class="row">
      <div class="col-md-12 mb-2">
        <v-select
          @input="loadDisease"
          v-model="selectedDisease"
          :options="diseases"
          label="name"
          placeholder="Dostępne choroby..."
        ></v-select>
      </div>
      <div class="mb-2">
        <div v-if="user.role === 'admin' || user.role === 'doctor'">
          <div class="col-md-12">
            <div v-if="selectedDisease">
              <div class="row"></div>
              <div class="row d-flex flex-row-reverse mb-2">
                <div @click="showHideEditDisease" class="col-md-5">
                  <a href="#" class="text-decoration-none text-primary">
                    Edytuj
                  </a>
                </div>

                <div class="col-md-5" v-if="user.role === 'admin'">
                  <div @click="deleteDisease(selectedDisease.id)">
                    <a href="#" class="text-decoration-none text-danger">
                      Usuń
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <button
            @click="showHideCreateDisease"
            class="btn btn-secondary btn-block col-md-12"
          >
            Wprowadź nową chorobę
          </button>
          <div v-if="createDisease" class="mb-2">
            <create-disease @newDisease="newDisease"></create-disease>
          </div>
          <div v-if="editDisease" class="mb-2">
            <edit-disease
              @changedDisease="changedDisease"
              v-bind:id="selectedDisease.id"
            ></edit-disease>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapState } from "vuex";
import CreateDisease from "./CreateDisease.vue";
import EditDisease from "./EditDisease.vue";

export default {
  components: {
    CreateDisease,
    EditDisease,
  },
  data() {
    return {
      selectedDisease: "",
      diseases: [],
      createDisease: false,
      editDisease: false,
    };
  },
  computed: {
    ...mapState({
      user: "user",
    }),
  },
  methods: {
    getDiseases() {
      const request = axios.get("/api/diseases").then((response) => {
        this.diseases = response.data.data;
      });
    },
    deleteDisease(id) {
      axios
        .delete(`/api/diseases/${id}}`)
        .then((response) => {
          console.log(response);
          this.diseases = this.diseases.filter((item) => item.id !== id);
          this.selectedDisease = "";
        })
        .catch((error) => {
          console.log(error);
        });
    },
    showHideCreateDisease() {
      this.selectedDisease = "";
      this.createDisease
        ? (this.createDisease = false)
        : (this.createDisease = true);
    },
    showHideEditDisease() {
      this.editDisease ? (this.editDisease = false) : (this.editDisease = true);
    },
    newDisease(diseaseName) {
      this.selectedDisease = diseaseName;
      this.getDiseases();
      this.createDisease = false;
    },
    loadDisease() {
      this.createDisease = false;
      this.editDisease = false;
    },
    changedDisease(diseaseName) {
      this.selectedDisease = diseaseName;
      this.getDiseases();
      this.editDisease = false;
    },
  },
  created() {
    this.getDiseases();
  },
  props: {},
};
</script>
<style scoped>
</style>
