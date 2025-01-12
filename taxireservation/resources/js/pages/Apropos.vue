<template>
  <div class="apropos">
    <h1>À propos de l'application</h1>
    <h4>Ines Saidi</h4>
    <h5>Fonctionnalités en tant qu'utilisateurs connecter:</h5>
    <ol>
      <li><strong>Accéder au Dashboard :</strong> Depuis la page d'accueil, vous pouvez visualiser les listes de chauffeurs, de courses et d'utilisateurs.</li>
      <li><strong>Ajouter un chauffeur :</strong> Cliquez sur le bouton "Ajouter un chauffeur" dans la section des chauffeurs. Un formulaire vous permet de saisir les informations du nouveau chauffeur et de téléverser une image.</li>
      <li><strong>Supprimer un chauffeur :</strong> Cliquez sur le bouton "Supprimer" dans la section des chauffeurs. Cela permet d'effacer un chauffeurs de la base de données.</li>

      <li><strong>Modifier l'image du chauffeur :</strong> Cliquez sur le chauffeur présent dans la liste du tableau de bord, téléversez une image, puis cliquez sur "Mettre à jour la photo".</li>
      <li><strong>Modifier le statut d'une course :</strong> Dans la section des courses, sélectionnez une course et cliquez sur "Modifier le statut". Vous pouvez changer le statut entre "en attente", "annulé", "en cours", "terminé" ou "reporté".</li>
      <li><strong>Ajout d'utilisateurs :</strong> Vous pouvez ajouter des utilisateurs dans la section inscription.</li>
    </ol>

    <!-- Bouton pour retourner au Dashboard avec la classe custom-btn -->
    <router-link to="/" class="btn btn-primary custom-btn">Retourner au Dashboard</router-link>
  </div>
</template>

<script>
export default {
  name: "Apropos",
};
</script>

<style scoped>
/* Style pour la page À propos */

.custom-btn {
  background-color: #2769b0;
  color: white;
  padding: 10px 20px;
  border-radius: 5px;
  font-size: 16px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  transition: background-color 0.3s ease;
}

.custom-btn:hover {
  background-color: #1a4a8c;
}

.apropos {
  text-align: center;
  margin-top: 20px;
}

.apropos h1 {
  color: #2769b0;
  margin-bottom: 20px;
}

.apropos ol {
  text-align: left;
  max-width: 800px;
  margin: 0 auto;
}

.apropos img {
  margin-top: 20px;
  border: 1px solid #ccc;
}

.apropos .btn {
  margin-top: 20px;
}
</style>
