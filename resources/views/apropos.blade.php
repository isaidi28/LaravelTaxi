@extends('layouts.app')

@section('title', 'À propos de l\'application')

@section('content')
    <div class="container">
        <h1>À propos de taxi reservation....</h1>
        <p>     </p>

        
        <h2>Ines Saidi</h2>
        <p></p>

        
        <h2>Cours :</h2>
        <p>420-5H6 MO Applications Web transactionnelles</p>
        <p>Automne 2024, Collège Montmorency</p>

        
        <h2>fonctionnalités en tant que admin (personne connecter)</h2>
        <ol>
            <li>
                <strong>Accéder au Dashboard :</strong> (fonctionelle)Depuis la page d'accueil, vous pouvez visualiser les listes de chauffeurs, 
                de courses et d'utilisateurs.  
            </li>
            <li>
                <strong>Ajouter un chauffeur :</strong> Cliquez sur le bouton "Ajouter un chauffeurs" dans la section des chauffeurs. 
                Un formulaire vous permet de saisir les informations du nouveau chauffeur et  televerser une image 
            </li>
            <li>
                <strong>Modifier l'image du chauffeur :</strong> Cliquez sur le chauffeur present dans la liste du tableau de bord, televerser une image , puis,
                cliquez sur mettre a jour la photo
            </li>
            <li>
                <strong>Modifier le statut d'une course :</strong> Dans la section des courses, sélectionnez une course et cliquez sur "Modifier le statut".
                 Vous pouvez changer le statut de "en attente", "annulé". "en cours", "terminé", "reporté".
            <li>
                <strong>Ajout d'utilisateurs :</strong> Vous pouvez ajouter des utilisateurs dans la section correspondante.
                
            </li>
        </ol>

        <p>
        </p>

        <!-- Diagramme de la base de données -->
        <h2>Diagramme de la base de données :</h2>
        <img src="{{ asset('images/diagramme_bdd.png') }}" alt="Diagramme de la base de données" style="max-width:100%; height:auto;">


        <!-- Bouton pour retourner au Dashboard -->
        <a href="{{ url('/') }}" class="btn btn-primary">Retourner au Dashboard</a>
    </div>
@endsection
