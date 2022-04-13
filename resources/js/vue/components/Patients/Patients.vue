<template>
  <div>
    <div class="row">
      <div class="col-md-4">
        <div class="mb-2">
          <search @searchingResults="onSearchingResultsChanged"></search>
        </div>
        <div class="mb-2">
          <div @click="reset" class="btn btn-secondary col-md-10 btn-block">
            Wyzeruj filtrowanie
          </div>
        </div>
        <div class="mb-2">
          <div v-if="user.role === 'admin' || user.role === 'doctor'">
            <router-link :to="{ name: 'patient-create' }">
              <button class="btn btn-secondary btn-block col-md-10">
                Dodaj pacjenta
              </button>
            </router-link>
          </div>
        </div>
        <div class="col-md-10 mb-2">
          <v-select
            @input="sortData"
            @close="console.log('test')"
            v-model="sortSelect"
            :options="sortingOptions"
            placeholder="Filtrowanie..."
          >
          </v-select>
          <p v-if="info" class="text-info">Brak dopasowań.</p>
        </div>
        <div class="col-md-10">
          <diseases></diseases>
        </div>
      </div>
      <div class="col-md-6">
        <div v-if="!loading">
          <div class="card mt-3" v-for="patient in patients" :key="patient.id">
            <patient-list-item
              v-bind="patient"
              @id="patientDelete"
            ></patient-list-item>
          </div>
        </div>
        <div v-else>Loading...</div>
      </div>
    </div>
  </div>
</template>
<script>
import PatientListItem from "./PatientListItem.vue";
import Search from "../SearchEngine/Search.vue";
import Diseases from "../Diseases/Diseases.vue";
import { mapState } from "vuex";

export default {
  components: {
    Search,
    PatientListItem,
    Diseases,
  },
  data() {
    return {
      patients: [],
      loading: false,
      searchingArr: [],
      info: false,
      sortSelect: "",
      sortingOptions: [
        { label: "Imiona A-Z", id: 1 },
        { label: "Imiona Z-A", id: 2 },
        { label: "Nazwiska A-Z", id: 3 },
        { label: "Nazwiska Z-A", id: 4 },
        { label: "Data urodzenia od najstarszego", id: 5 },
        { label: "Data urodzenia od najmłodszego", id: 6 },
      ],
    };
  },
  mounted() {},
  computed: {
    ...mapState({
      user: "user",
    }),
  },
  methods: {
    getData() {
      this.loading = true;
      axios.get("/api/patients").then((response) => {
        this.patients = response.data.data;
        this.loading = false;
      });
    },
    onSearchingResultsChanged(searchingResults) {
      this.patients = searchingResults;
      if (this.patients.length === 0) {
        this.info = true;
      }
    },
    reset() {
      this.getData();
    },
    patientDelete(id) {
      this.patients = this.patients.filter((item) => item.id !== id);
    },
    loadDisease() {},
    sortData() {
      switch (this.sortSelect.id) {
        case 1:
          return this.patients.sort(function (a, b) {
            return a.name > b.name ? 1 : -1;
          });
          break;
        case 2:
          return this.patients.sort(function (a, b) {
            return a.name < b.name ? 1 : -1;
          });
          break;
        case 3:
          return this.patients.sort(function (a, b) {
            return a.lastname > b.lastname ? 1 : -1;
          });
          break;
        case 4:
          return this.patients.sort(function (a, b) {
            return a.lastname < b.lastname ? 1 : -1;
          });
          break;
        case 5:
          return this.patients.sort(function (a, b) {
            return a.birthday > b.birthday ? 1 : -1;
          });
          break;
        case 6:
          return this.patients.sort(function (a, b) {
            return a.birthday < b.birthday ? 1 : -1;
          });
          break;
      }
    },
  },
  created() {
    this.getData();
  },
  props: {},
};
</script>
