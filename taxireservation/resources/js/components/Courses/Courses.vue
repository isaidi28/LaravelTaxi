<template>
  <div>
    <h1>Liste des Courses</h1>
    <ul>
      <li v-for="course in courses" :key="course.id">
        <router-link :to="{ name: 'courses.show', params: { id: course.id } }">
          <div class="course-details">
            <strong>Course #</strong>{{ course.id }}<br />
            <strong>Chauffeur:</strong> {{ course.chauffeur.nom }} {{ course.chauffeur.prenom }}<br />
            <strong>Client:</strong> {{ course.utilisateur.name }}<br />
            <strong>Statut:</strong> {{ course.statut }}<br />
          </div>
        </router-link>
      </li>
    </ul>

    <!-- //yasminesaidi@kont.com Supprimez ou commentez ce lien si vous ne souhaitez pas ajouter de cours -->
    <!-- <router-link :to="{ name: 'courses.create' }" class="button">Ajouter une Course</router-link> -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      search: '',
      courses: [],
      chauffeurs: [],
    };
  },
  mounted() {
    // Récupérer les données des courses et des chauffeurs
    this.fetchCourses();
    this.fetchChauffeurs();
  },
  computed: {
    filteredChauffeurs() {
      return this.chauffeurs.filter(chauffeur => {
        return (
          chauffeur.nom.toLowerCase().includes(this.search.toLowerCase()) ||
          chauffeur.prenom.toLowerCase().includes(this.search.toLowerCase())
        );
      });
    },
  },
  methods: {
    fetchCourses() {
      fetch('/api/courses')
        .then((response) => response.json())
        .then((data) => {
          console.log('Données des courses:', data); // Ajoutez cette ligne
          this.courses = data;
        })
        .catch((error) => {
          console.error('Erreur lors de la récupération des courses:', error);
        });
    },
    fetchChauffeurs() { // Correction de la méthode ici
      fetch('/api/chauffeurs')
        .then((response) => response.json())
        .then((data) => {
          this.chauffeurs = data;
        })
        .catch((error) => {
          console.error('Erreur lors de la récupération des chauffeurs:', error);
        });
    },
  },
};
</script>

<style>
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background-color: #e9ecef;
  margin: 0;
  padding: 20px;
}

h1 {
  color: #343a40;
  text-align: center;
  font-size: 2.5rem;
  margin-bottom: 20px;
}

h2 {
  color: #495057;
  font-size: 1.8rem;
  border-bottom: 2px solid #6c757d;
  padding-bottom: 10px;
  margin-top: 30px;
}

ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

li {
  background: #ffffff;
  margin: 15px 0;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s, box-shadow 0.3s;
}

li:hover {
  transform: scale(1.03);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

a {
  text-decoration: none;
  color: #007bff;
  font-weight: bold;
}

a:hover {
  text-decoration: underline;
}

.button {
  display: inline-block;
  padding: 12px 25px;
  background-color: #28a745;
  color: #ffffff;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 1rem;
  transition: background-color 0.3s;
  margin-top: 15px;
}

.button:hover {
  background-color: #218838;
}

.course-details {
  font-size: 1rem;
  line-height: 1.6;
}

#search {
  padding: 8px 12px;
  font-size: 1rem;
  border-radius: 6px;
  border: 1px solid #ccc;
  margin-bottom: 20px;
}
</style>
