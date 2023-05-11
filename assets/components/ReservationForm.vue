<template>
  <div class="container" v-if="loaded == true">
    <div class="card p-3 custom-opacity">
        <div class="row mb-3">
          <div class="col">
            <input v-model="reservation.nbPersonnes" type="number" class="form-control" placeholder="Nombre de personnes">
          </div>
          <div class="col">
            <input v-model="reservation.dateDebut" type="text" class="form-control" placeholder="Début du séjour">
          </div>
        </div>
        <div class="row mb-3">
          <div class="col">
            <select class="form-select" v-model="selectedEtablissement">
              <option :value="null" disabled selected>Sélectionnez un établissement</option>
              <option v-for="(etablissement, index) in etablissements" :value="etablissement.id">{{ etablissement.nom }}</option>
            </select>
          </div>
          <div class="col">
            <input v-model="reservation.dateFin" type="text" class="form-control" placeholder="Fin du séjour">
          </div>
        </div>
        <div class="row">
          <div class="col">

            <select class="form-select" v-model="reservation.idSuite">
              <option v-for="(suite, index) in suitesFiltered" :value="suite.id">{{ suite.titre + ' (' + suite.prix + '€)'}}</option>
            </select>
          </div>
          <div class="col">
            <button @click="postReservation()" class="form-control btn btn-success">Réserver</button>
          </div>
        </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  name: 'ReservationForm',
  data() {
    return {
      selectedEtablissement: null,
      etablissements: [],
      suites: [],
      reservation: {
        nbPersonnes: null,
        dateDebut: null,
        dateFin: null,
        idSuite: null,
      },
      loaded: false,
    }
  },
  computed: {
    suitesFiltered() {
      if (!this.selectedEtablissement) {
        // Si aucun établissement n'est sélectionné, on retourne un tableau vide
        return [];
      }
      return this.suites.filter(suite => suite.idEtablissement === this.selectedEtablissement);
    }
  },

  methods: {
    getEtablissements() {
      axios.get('/api/liste-etablissements-axios')
          .then((response) => {
            this.etablissements = response.data;
          })
          .catch((error) => {
            console.log(error);
          })
    },
    getSuites() {
      axios.get('/api/liste-suites-axios')
          .then((response) => {
            this.suites = response.data;
          })
          .catch((error) => {
            console.log(error);
          })
    },
    postReservation() {
      axios.post('/api/reservation', {reservation: this.reservation})
          .then((response) => {
            console.log(response);
          })
          .catch((error) => {
            console.log(error);
          })
    }
  },
  mounted() {
    this.getEtablissements();
    this.getSuites();
    this.loaded = true;
  }
}
</script>