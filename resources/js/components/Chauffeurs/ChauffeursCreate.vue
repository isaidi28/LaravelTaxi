<template>
  <div class="add-chauffeur">
    <h1>Ajouter un Chauffeur</h1>
    <form @submit.prevent="createChauffeur" class="chauffeur-form">
      <input type="text" v-model="nom" placeholder="Nom" required class="form-input" />
      <input type="text" v-model="prenom" placeholder="Prénom" required class="form-input" />
      <input type="text" v-model="pocket_number" placeholder="Pocket Number" required class="form-input" />
      <input type="text" v-model="modele_taxi" placeholder="Modèle de Taxi" required class="form-input" />
      <input type="number" v-model="annee_modele" placeholder="Année du Modèle" required class="form-input" />
      <select v-model="disponibilite" class="form-select">
        <option value="1">Disponible</option>
        <option value="0">Non Disponible</option>
      </select>
      <input type="file" @change="onFileChange" required class="form-file" />
      <button type="submit" class="submit-button">Créer</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      nom: '',
      prenom: '',
      pocket_number: '',
      modele_taxi: '',
      annee_modele: '',
      disponibilite: 1,
      photo: null,
    };
  },
  methods: {
    onFileChange(event) {
      this.photo = event.target.files[0];
    },
    createChauffeur() {
      const formData = new FormData();
      formData.append('nom', this.nom);
      formData.append('prenom', this.prenom);
      formData.append('pocket_number', this.pocket_number);
      formData.append('modele_taxi', this.modele_taxi);
      formData.append('annee_modele', this.annee_modele);
      formData.append('disponibilite', this.disponibilite);
      formData.append('photo', this.photo);

      fetch('/api/chauffeurs', {
        method: 'POST',
        body: formData,
      })
        .then(() => {
          alert('Chauffeur créé avec succès');
          this.$router.push('/');
        })
        .catch((error) => {
          console.error('Erreur lors de la création du chauffeur:', error);
        });
    },
  },
};
</script>

<style scoped>
.add-chauffeur {
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
  margin-bottom: 20px;
}

.chauffeur-form {
  display: flex;
  flex-direction: column;
}

.form-input,
.form-select,
.form-file {
  margin-bottom: 15px;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 16px;
}

.form-input:focus,
.form-select:focus {
  border-color: #007bff;
  outline: none;
}

.submit-button {
  padding: 10px;
  background-color: #28a745;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.submit-button:hover {
  background-color: #218838;
}
</style>
