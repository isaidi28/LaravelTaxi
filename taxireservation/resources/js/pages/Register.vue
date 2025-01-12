<template>
  <div class="register">
    <h2>Inscription</h2>
    <form @submit.prevent="register" class="register-form">
      <div class="form-group">
        <label for="name">Nom</label>
        <input type="text" v-model="form.name" required class="form-input" />
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" v-model="form.email" required class="form-input" />
      </div>
      <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" v-model="form.password" required class="form-input" />
      </div>
      <div class="form-group">
        <label for="c_password">Confirmer le mot de passe</label>
        <input type="password" v-model="form.c_password" required class="form-input" />
      </div>
      <button type="submit" class="submit-button">S'inscrire</button>
      <div v-if="errorMessage" class="error">{{ errorMessage }}</div>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      form: {
        name: '',
        email: '',
        password: '',
        c_password: ''
      },
      errorMessage: ''
    };
  },
  methods: {
    async register() {
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/register', this.form);
        console.log(response.data); // Affiche les données de la réponse
        // Rediriger ou effectuer d'autres actions après l'inscription réussie
        this.$router.push('/');
      } catch (error) {
        if (error.response && error.response.data.errors) {
          this.errorMessage = Object.values(error.response.data.errors).flat().join(', ');
        } else {
          this.errorMessage = 'Une erreur est survenue. Veuillez réessayer.';
        }
      }
    }
  }
};
</script>

<style scoped>
.register {
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

.register-form {
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
