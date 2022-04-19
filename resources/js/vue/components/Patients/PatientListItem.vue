<template>
  <div class="card d-flex flex-row justify-content-between">
    <div class="card-body col-md-6">
      <div class="card-title">
        <router-link
          class="text-decoration-none"
          :to="{ name: 'patient', params: { id } }"
        >
          <h2
            class="text-decoration-none text-dark font-weight-bolder mt-3 pr-3"
          >
            {{ name }} {{ lastname }}
          </h2>
        </router-link>
      </div>
      <div class="card-subtitle mb-2 text-muted">
        <p>Pesel: {{ pesel }} | Data urodzenia: {{ birthday }}</p>
      </div>
    </div>
    <div class="card-body btn-group justify-content-center mr-2 col-md-6">
      <div v-if="user.role === 'admin' || user.role === 'doctor'">
        <router-link :to="{ name: 'patient-edit', params: { id } }">
          <button class="btn btn-outline-dark m-3">Edytuj</button>
        </router-link>
      </div>

      <div v-if="user.role === 'admin'">
        <button @click="deletePatient(id)" class="btn btn-outline-dark m-3">
          Usuń
        </button>
      </div>
    </div>
  </div>
</template>
<script>
import { mapState } from "vuex";

export default {
  props: {
    id: Number,
    name: String,
    lastname: String,
    pesel: String,
    birthday: String,
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
    deletePatient(id) {
      axios
        .delete(`/api/patients/${id}`)
        .then((response) => {
          this.$emit("id", id);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
