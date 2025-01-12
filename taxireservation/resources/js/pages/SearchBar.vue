<template>
  <div class="search-bar">
    <input
      type="text"
      v-model="query"
      @input="fetchSuggestions"
      placeholder="Qu'est ce que vous cherchez?"
      autocomplete="off"  
    />
    <ul v-if="suggestions.length">
      <li v-for="(suggestion, index) in suggestions" :key="index" @click="selectSuggestion(suggestion)">
        {{ suggestion.nom }} <!-- Utilisez 'nom' au lieu de 'title' -->
      </li>
    </ul>
  </div>
</template>


<script>
import axios from 'axios';

export default {
  data() {
    return {
      query: '',
      suggestions: [],
    };
  },
  methods: {
    fetchSuggestions() {
      if (this.query.length < 2) {
        this.suggestions = [];
        return;
      }

      // Appeler l'API Laravel
      axios
        .get('/api/chauffeurs/autocomplete', { params: { query: this.query} })
        .then((response) => {
          this.suggestions = response.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },
    selectSuggestion(suggestion) {
  this.query = suggestion.nom; // Utilisez 'nom' au lieu de 'title'
  this.suggestions = []; // Vider les suggestions
  // Redirection ou autre action
  console.log('Chauffeur sélectionné:', suggestion);
  this.$router.push({
    name: "showchauffeur", // Assurez-vous que cette route existe dans votre application
    params: { id: suggestion.id }, // Passez l'ID du chauffeur
  });
},
  },
};
</script>

<style scoped>
.search-bar {
  position: relative;
  width: 300px;
}

input {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  border: 1px solid #ccc;
  border-radius: 4px;
  position: absolute;
  background: rgb(11, 113, 230);
  width: 100%;
  max-height: 200px;
  overflow-y: auto;
  z-index: 1000;
}

li {
  padding: 8px;
  cursor: pointer;
}

li:hover {
  background: #f0f0f0;
}
</style>
