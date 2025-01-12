<template>
  <div class="chauffeurs-list">
    <h1>Liste des Chauffeurs</h1>
    <input
      type="text"
      v-model="search"
      placeholder="Rechercher un chauffeur"
      id="search"
    />
    <ul class="chauffeurs">
      <li
        v-for="chauffeur in filteredChauffeurs"
        :key="chauffeur.id"
        class="chauffeur-item"
      >
        <!-- Lien vers les détails -->
        <router-link
          :to="{ name: 'chauffeurDetails', params: { id: chauffeur.id } }"
          class="chauffeur-info"
        >
          {{ chauffeur.nom }} {{ chauffeur.prenom }} - {{ chauffeur.modele_taxi }}
        </router-link>
        <!-- Bouton pour modifier (uniquement si connecté) -->
        <button
          v-if="isLoggedIn"
          class="edit-button"
          @click="editChauffeur(chauffeur.id)"
        >
          Modifier
        </button>
      </li>
    </ul>
    <!-- Bouton pour ajouter un chauffeur (uniquement si connecté) -->
    <router-link
      v-if="isLoggedIn"
      :to="{ name: 'addChauffeur' }"
      class="add-button"
    >
      Ajouter un Chauffeur
    </router-link>
  </div>
</template>

<script>
export default {
  data() {
    return {
      chauffeurs: [],
      search: "",
      isLoggedIn: false, // Vérifie l'état de connexion
    };
  },
  computed: {
    filteredChauffeurs() {
      // Filtre les chauffeurs selon la recherche
      return this.chauffeurs.filter((chauffeur) =>
        `${chauffeur.nom} ${chauffeur.prenom} ${chauffeur.modele_taxi}`
          .toLowerCase()
          .includes(this.search.toLowerCase())
      );
    },
  },
  mounted() {
    // Appel API pour récupérer la liste des chauffeurs
    fetch("/api/chauffeurs")
      .then((response) => response.json())
      .then((data) => {
        this.chauffeurs = data;
      })
      .catch((error) => {
        console.error("Erreur lors de la récupération des chauffeurs:", error);
      });

    // Vérifie si l'utilisateur est connecté
    const token = localStorage.getItem("token");
    this.isLoggedIn = !!token; // Convertit en booléen
  },
  methods: {
    editChauffeur(id) {
      // Redirige vers la page d'édition
      this.$router.push({ name: "chauffeursEdit", params: { id } });
    },
  },
};
</script>

<style scoped>
.chauffeurs-list {
  max-width: 600px;
  margin: auto;
  padding: 20px;
  background-color: #f9f9f9;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

h1 {
  text-align: center;
  color: #333;
}

.chauffeurs {
  list-style-type: none;
  padding: 0;
}

.chauffeur-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px;
  margin-bottom: 10px;
  background-color: #ffffff;
  border: 1px solid #ddd;
  border-radius: 4px;
  transition: background-color 0.3s;
}

.chauffeur-item:hover {
  background-color: #f1f1f1;
}

.chauffeur-info {
  font-size: 16px;
  color: #007bff;
  text-decoration: none;
  cursor: pointer;
}

.edit-button {
  padding: 8px 12px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.edit-button:hover {
  background-color: #0056b3;
}

.add-button {
  display: inline-block;
  margin-top: 20px;
  padding: 10px 15px;
  background-color: #28a745;
  color: white;
  text-decoration: none;
  border-radius: 4px;
  text-align: center;
  transition: background-color 0.3s;
}

.add-button:hover {
  background-color: #218838;
}
</style>
