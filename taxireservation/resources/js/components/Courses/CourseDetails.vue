<template>
  <div class="details-container">
    <h3>Détails de la Course</h3>
    <p v-if="course && course.utilisateur"><strong>Utilisateur :</strong> {{ course.utilisateur.name }}</p>
    <p v-if="course && course.chauffeur"><strong>Chauffeur :</strong> {{ course.chauffeur.nom }} {{ course.chauffeur.prenom }}</p>
    <p v-if="course"><strong>Date de la course :</strong> {{ course.date_course }}</p>
    <p v-if="course"><strong>Montant :</strong> {{ course.montant }} $CAD</p>
    <p v-if="course"><strong>Statut :</strong> {{ course.statut }}</p>
    <p v-if="course"><strong>Adresse de départ :</strong> {{ course.adresse_depart }}</p>
    <p v-if="course"><strong>Adresse de destination :</strong> {{ course.adresse_destination }}</p>

    <!-- Bouton "Modifier le statut" visible uniquement si l'utilisateur est connecté -->
    <router-link
      v-if="isAuthenticated"
      :to="{ name: 'coursesEdit', params: { id: course.id } }"
      class="btn btn-primary"
    >
      Modifier le statut
    </router-link>

    <br>
    <router-link to="/courses" class="btn btn-primary">Retour</router-link>
  </div>
</template>

<script>
export default {
  data() {
    return {
      course: {},
      isAuthenticated: false, // Vérifie si l'utilisateur est connecté
    };
  },
  mounted() {
    console.log("Paramètres de route:", this.$route.params);
    this.fetchCourseDetails();
    this.checkAuthentication(); // Vérifier si l'utilisateur est connecté
  },
  methods: {
    fetchCourseDetails() {
      const courseId = this.$route.params.id;
      console.log("Fetching course details for ID:", courseId);
      fetch(`/api/courses/${courseId}`)
        .then((response) => {
          if (!response.ok) {
            throw new Error("Erreur réseau");
          }
          return response.json();
        })
        .then((data) => {
          console.log("Fetched course data:", data);
          this.course = data;
        })
        .catch((error) => {
          console.error("Erreur lors de la récupération des détails de la course:", error);
        });
    },
    checkAuthentication() {
      // Vérifie si le token d'authentification existe dans le localStorage
      const token = localStorage.getItem("token");
      this.isAuthenticated = !!token; // Convertit en booléen
    },
  },
};
</script>


<style>
/* Styles inchangés */
.details-container {
  background-color: #ffffff;
  padding: 30px;
  margin: 20px auto;
  max-width: 800px;
  border-radius: 8px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

h1 {
  text-align: center;
  color: #343a40;
  margin-bottom: 30px;
  font-size: 2.2rem;
}

p {
  font-size: 1.2rem;
  line-height: 1.6;
  color: #495057;
}

strong {
  color: #007bff;
}

.btn-primary {
  display: inline-block;
  margin-top: 20px;
  padding: 12px 25px;
  background-color: #007bff;
  color: #ffffff;
  text-decoration: none;
  border-radius: 6px;
  text-align: center;
  font-size: 1.1rem;
  transition: background-color 0.3s, transform 0.2s;
  border: 1px solid transparent;
}

.btn-primary:hover {
  background-color: #0056b3;
  transform: translateY(-2px);
  border-color: #0056b3;
}

.btn-primary:active {
  transform: translateY(0);
}

.btn-primary:focus {
  outline: none;
  box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.5);
}
</style>
