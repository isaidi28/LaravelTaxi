<template>
  <div class="edit-container">
    <h1>Modifier le Statut de la Course</h1>
    <form @submit.prevent="updateStatus">
      <label for="statut">Statut :</label>
      <select v-model="selectedStatut" id="statut" required>
        <option value="en attente">En attente</option>
        <option value="annulé">Annulé</option>
        <option value="en cours">En cours</option>
        <option value="terminé">Terminé</option>
        <option value="reporté">Reporté</option>
      </select>
      <button type="submit" class="btn-primary">Mettre à jour le Statut</button>
    </form>
    <router-link to="/" class="btn btn-primary">Retour</router-link>
  </div>
</template>

<script>
export default {
  data() {
    return {
      selectedStatut: '',
      course: {},
    };
  },
  mounted() {
    this.fetchCourseDetails();
  },
  methods: {
    fetchCourseDetails() {
      const courseId = this.$route.params.id;
      fetch(`/api/courses/${courseId}`)
        .then((response) => response.json())
        .then((data) => {
          this.course = data;
          this.selectedStatut = data.statut; // Préremplir le statut actuel
        })
        .catch((error) => {
          console.error('Erreur lors de la récupération des détails de la course:', error);
        });
    },
    updateStatus() {
      const courseId = this.course.id;
      fetch(`/api/courses/${courseId}/status`, { // Modifier l'URL ici
        method: 'PUT', // Garder la méthode PUT
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ statut: this.selectedStatut }),
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error('Erreur réseau');
          }
          return response.json();
        })
        .then(() => {
          alert('Statut mis à jour avec succès!');
          this.$router.push({ name: 'courses.show', params: { id: courseId } }); // Rediriger vers les détails de la course
        })
        .catch((error) => {
          console.error('Erreur lors de la mise à jour du statut:', error);
        });
    },
  },
};
</script>

<style>
/* Ajoutez ici vos styles si nécessaire */
</style>
