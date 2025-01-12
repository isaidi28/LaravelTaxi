<template>
  <div class="details-container">
    <h1>Détails du Chauffeur</h1>
    <div v-if="chauffeur">
      <p><strong>Nom :</strong> {{ chauffeur.nom }}</p>
      <p><strong>Prénom :</strong> {{ chauffeur.prenom }}</p>
      <p><strong>Pocket Number :</strong> {{ chauffeur.pocket_number }}</p>
      <p><strong>Modèle de Taxi :</strong> {{ chauffeur.modele_taxi }}</p>
      <p><strong>Année du Modèle :</strong> {{ chauffeur.annee_modele }}</p>
      <p><strong>Nombre de courses :</strong> {{ chauffeur.nombre_course }}</p>
      <p><strong>Disponibilité :</strong> {{ chauffeur.disponibilite ? 'Disponible' : 'Non disponible' }}</p>
      
      <div v-if="chauffeur.photo">
        <strong>Photo :</strong>
        <img :src="chauffeur.photo" alt="Photo du Chauffeur" />
      </div>
      
    </div>
    <div v-else>
      <p>Chargement des informations...</p>
    </div>
    <router-link to="/chauffeurs" class="btn-primary">Retour</router-link>
  </div>
</template>

<script>
export default {
  data() {
    return {
      chauffeur: null,
    };
  },
  mounted() {
    const id = this.$route.params.id;

    fetch(`/api/chauffeurs/${id}`)
      .then((response) => {
        if (!response.ok) {
          throw new Error(`Erreur HTTP ${response.status}: ${response.statusText}`);
        }
        return response.json();
      })
      .then((data) => {
        if (data.photo) {
          data.photo = `/storage/${data.photo}`; // Transforme le chemin de la photo
        }
        this.chauffeur = data;
      })
      .catch((error) => {
        console.error("Erreur lors de la récupération du chauffeur :", error);
      });
  },
};
</script>

<style scoped>
img {
  max-width: 100%;
  height: auto;
  border-radius: 8px;
  margin-top: 10px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}
</style>
