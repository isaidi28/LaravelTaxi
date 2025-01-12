<template>
  <div class="edit-chauffeur">
    <h1>Modifier le Chauffeur</h1>
    <form @submit.prevent="updateChauffeur" class="chauffeur-form">
      <input type="text" v-model="nom" placeholder="Nom" required class="form-input" />
      <input type="text" v-model="prenom" placeholder="Prénom" required class="form-input" />
      <input type="text" v-model="pocket_number" placeholder="Pocket Number" required class="form-input" />
      <input type="text" v-model="modele_taxi" placeholder="Modèle de Taxi" required class="form-input" />
      <input type="number" v-model="annee_modele" placeholder="Année du Modèle" required class="form-input" />
      <select v-model="disponibilite" class="form-select">
        <option value="1">Disponible</option>
        <option value="0">Non Disponible</option>
      </select>
      
      <!-- Affichage de la photo actuelle -->
      <div v-if="photoUrl">
        <strong>Photo actuelle :</strong>
        <img :src="photoUrl" alt="Photo du Chauffeur" class="preview-image" />
      </div>
      
      <input type="file" @change="onFileChange" class="form-file" />
      <button type="submit" class="submit-button">Modifier</button>
      <button type="button" @click="deleteChauffeur" class="delete-button">Supprimer le Chauffeur</button>

    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      id: null,
      nom: '',
      prenom: '',
      pocket_number: '',
      modele_taxi: '',
      annee_modele: '',
      disponibilite: 1,
      photo: null,
      photoUrl: '', // Pour afficher la photo actuelle
    };
  },
  mounted() {
    const id = this.$route.params.id;
    fetch(`/api/chauffeurs/${id}`)
      .then((response) => response.json())
      .then((data) => {
        this.id = data.id;
        this.nom = data.nom;
        this.prenom = data.prenom;
        this.pocket_number = data.pocket_number;
        this.modele_taxi = data.modele_taxi;
        this.annee_modele = data.annee_modele;
        this.disponibilite = data.disponibilite;
        this.photoUrl = data.photo ? `/storage/${data.photo}` : ''; // Chemin de la photo actuelle
      })
      .catch((error) => {
        console.error('Erreur lors de la récupération du chauffeur:', error);
      });
  },
  methods: {
    onFileChange(event) {
      const file = event.target.files[0];
      if (file) {
        this.photo = file;
        const reader = new FileReader();
        reader.onload = (e) => {
          this.photoUrl = e.target.result; // Affiche l'aperçu de la nouvelle photo
        };
        reader.readAsDataURL(file);
      }
    },

    deleteChauffeur() {
        if (confirm('Êtes-vous sûr de vouloir supprimer ce chauffeur ?')) {
            fetch(`/api/chauffeurs/${this.id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${localStorage.getItem('token')}` // Remplacez cela par la méthode d'authentification que vous utilisez
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erreur lors de la suppression du chauffeur');
                }
                alert('Chauffeur supprimé avec succès');
                this.$router.push('/chauffeurs'); // Redirige vers la liste des chauffeurs
            })
            .catch(error => {
                console.error('Erreur lors de la suppression du chauffeur:', error);
                alert('Une erreur s\'est produite lors de la suppression du chauffeur');
            });
        }
    },
    updateChauffeur() {
      const formData = new FormData();
      formData.append('_method', 'PUT');
      formData.append('nom', this.nom);
      formData.append('prenom', this.prenom);
      formData.append('pocket_number', this.pocket_number);
      formData.append('modele_taxi', this.modele_taxi);
      formData.append('annee_modele', this.annee_modele);
      formData.append('disponibilite', this.disponibilite);
      if (this.photo) {
        formData.append('photo', this.photo);
      }

      fetch(`/api/chauffeurs/${this.id}`, {
        method: 'POST',
        body: formData,
      })
        .then(() => {
          alert('Chauffeur modifié avec succès');
          this.$router.push('/chauffeurs');
        })
        .catch((error) => {
          console.error('Erreur lors de la mise à jour du chauffeur:', error);
        });
    },
  },
};
</script>

<style scoped>
.edit-chauffeur {
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
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.submit-button:hover {
  background-color: #0056b3;
}

.preview-image {
  max-width: 100%;
  height: auto;
  border-radius: 8px;
  margin-top: 10px;
}
</style>
