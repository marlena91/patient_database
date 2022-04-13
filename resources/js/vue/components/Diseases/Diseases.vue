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
          <router-link :to="{ name: 'disease-create' }">
            <button class="btn btn-secondary btn-block col-md-12">
              Wprowadź nową chorobę
            </button>
          </router-link>
        </div>
      </div>

      <div
        class="col-md-10"
        v-if="user.role === 'admin' || user.role === 'doctor'"
      >
        <div v-if="selectedDisease">
          <div class="row">
            <div class="col">Wybrano: {{ selectedDisease.name }}</div>
          </div>
          <div class="row d-flex flex-row-reverse">
            <div class="col-md-2">
              <router-link
                class="text-decoration-none text-primary"
                :to="{
                  name: 'disease-edit',
                  params: { id: selectedDisease.id },
                }"
              >
                Edytuj
              </router-link>
            </div>

            <div class="col-md-2" v-if="user.role === 'admin'">
              <div @click="deleteDisease(selectedDisease.id)">
                <a href="#" class="text-decoration-none text-danger"> Usuń </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapState } from "vuex";

export default {
  components: {},
  data() {
    return {
      selectedDisease: "",
      diseases: [],
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
        this.createArrayForSelect();
      });
    },
    loadDisease() {
      console.log(this.selectedDisease.id);
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
  },
  created() {
    this.getDiseases();
  },
  props: {},
};
</script>
<style scoped>
</style>
