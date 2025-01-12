<template>
  <div class="login">
    <h2>Connexion</h2>
    <form @submit.prevent="login" class="login-form">
      <div class="form-group">
        <label for="email">Email</label>
        <input 
          type="email" 
          v-model="form.email" 
          required 
          class="form-input" 
          autocomplete="email" 
        />
      </div>
      <div class="form-group">
        <label for="password">Mot de passe</label>
        <input 
          type="password" 
          v-model="form.password" 
          required 
          class="form-input" 
          autocomplete="current-password"  
        />
      </div>
      <button type="submit" class="submit-button">Se connecter</button>
      <div v-if="errorMessage" class="error">{{ errorMessage }}</div>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      form: {
        email: "",
        password: "",
      },
      errorMessage: "",
    };
  },
  methods: {
    async login() {
      try {
        const response = await axios.post(
          "http://127.0.0.1:8000/api/login",
          this.form
        );
        console.log("Réponse complète de l'API:", response.data); // Affiche la réponse complète

        if (response.data[0] && response.data[0].token) {
          const token = response.data[0].token; // Accès à la clé '0.token'
          localStorage.setItem("token", token);
          console.log("Connexion réussie avec token :", token);
          this.$emit("login-success"); // Émettre un événement de connexion réussie
          this.$router.push("/dashboard"); // Redirection vers le tableau de bord
        } else {
          this.errorMessage =
            "Aucun token reçu. Veuillez réessayer.";
          console.error("Réponse inattendue :", response.data);
        }
      } catch (error) {
        // Affiche un message d'erreur plus clair
        if (error.response) {
          console.error("Erreur de l'API :", error.response.data);
          this.errorMessage =
            error.response.data.message || "Une erreur est survenue.";
        } else {
          console.error("Erreur réseau ou autre :", error);
          this.errorMessage =
            "Une erreur est survenue. Veuillez réessayer.";
        }
      }
    },
  },
};
</script>

<style scoped>
.login {
  max-width: 400px;
  margin: auto;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 8px;
  background-color: #f9f9f9;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

h2 {
  text-align: center;
  color: #333;
}

.login-form {
  display: flex;
  flex-direction: column;
}

.form-group {
  margin-bottom: 15px;
}

.label {
  font-weight: bold;
  margin-bottom: 5px;
  color: #555;
}

.form-input {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
}

.form-input:focus {
  border-color: #007bff;
  outline: none;
  box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

.submit-button {
  padding: 10px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
}

.submit-button:hover {
  background-color: #0056b3;
}

.error {
  color: red;
  margin-top: 10px;
  text-align: center;
}
</style>
