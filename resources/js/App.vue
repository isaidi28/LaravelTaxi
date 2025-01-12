<template>
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color:#3485dc; color: #FFFF;">
      <div class="collapse navbar-collapse" style="background-color:#3485dc; color: #FFFF;">
        <!-- pour utilisateur connecté -->
        <div class="navbar-nav" v-if="isLoggedIn">
          <router-link to="/dashboard" class="nav-item nav-link">Dashboard</router-link>
          <router-link to="/chauffeurs" class="nav-item nav-link">Chauffeurs</router-link>
          <router-link to="/courses" class="nav-item nav-link">Courses</router-link>
          <router-link to="/apropos" class="nav-item nav-link">A Propos</router-link>
          <a class="nav-item nav-link" style="cursor: pointer;" @click="logout">Déconnexion</a>
        </div>
        <!-- pour utilisateur non connecté -->
        <div class="navbar-nav" v-else>
          <router-link to="/" class="nav-item nav-link">Home</router-link>
          <router-link to="/chauffeurs" class="nav-item nav-link">Chauffeurs</router-link>
          <router-link to="/courses" class="nav-item nav-link">Courses</router-link>
          <router-link to="/login" class="nav-item nav-link">Connexion</router-link>
          <router-link to="/register" class="nav-item nav-link">Inscription</router-link>
          <router-link to="/apropos" class="nav-item nav-link">A Propos</router-link>
        </div>
      </div>
    </nav>
    <router-view @login-success="handleLoginSuccess" />
  </div>
</template>

<script>
export default {
  data() {
    return {
      isLoggedIn: false, // Gérer la connexion ici
    };
  },
  methods: {
    logout() {
      localStorage.removeItem("token"); // Supprimer le token
      this.isLoggedIn = false; // Déconnexion
      alert("Vous avez été déconnecté !");
      this.$router.push("/"); // Redirection vers l'accueil
    },
    handleLoginSuccess() {
      this.isLoggedIn = true; // Mise à jour de l'état après connexion
    },
  },
  created() {
    const token = localStorage.getItem("token");
    if (token) {
      this.isLoggedIn = true; // Considérer l'utilisateur comme connecté si un token est présent
    }
  },
};
</script>
