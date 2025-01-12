@extends('layouts.app')

@section('styles')
<style>
    .details-container {
        background-color: #f8f9fa;
        padding: 30px;
        margin: 20px auto;
        max-width: 800px;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
    }

    .details-container:hover {
        transform: translateY(-5px);
    }

    h1 {
        text-align: center;
        color: #343a40;
        margin-bottom: 20px;
        font-size: 2.5rem;
        font-weight: bold;
    }

    p {
        font-size: 1.1rem;
        line-height: 1.6;
        color: #495057;
        margin: 8px 0;
    }

    strong {
        color: #007bff;
        font-weight: 600;
    }

    img {
        display: block;
        max-width: 100%;
        height: auto;
        margin: 20px 0;
        border-radius: 10px;
        border: 2px solid #007bff;
    }

    .btn-primary, .btn-danger {
        display: inline-block;
        margin-top: 15px;
        padding: 12px 20px;
        border-radius: 6px;
        text-align: center;
        font-size: 1rem;
        transition: background-color 0.3s, transform 0.3s;
        text-decoration: none;
    }

    .btn-primary {
        background-color: #007bff;
        color: #ffffff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    .btn-danger {
        background-color: #dc3545;
        color: #ffffff;
    }

    .btn-danger:hover {
        background-color: #c82333;
        transform: scale(1.05);
    }

    @media (max-width: 600px) {
        .details-container {
            padding: 20px;
        }

        h1 {
            font-size: 2rem;
        }

        p {
            font-size: 1rem;
        }

        .btn-primary, .btn-danger {
            padding: 10px 15px;
        }
    }
</style>
@endsection

@section('content')

<div class="details-container">
    <h1>Détails du Chauffeur</h1>

    <form action="{{ route('chauffeurs.update', $chauffeur->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <p><strong>Nom :</strong> {{ $chauffeur->nom }}</p>
            <p><strong>Prénom :</strong> {{ $chauffeur->prenom }}</p>
            <p><strong>Pocket Number :</strong> {{ $chauffeur->pocket_number }}</p>
            <p><strong>Modèle de Taxi :</strong> {{ $chauffeur->modele_taxi }}</p>
            <p><strong>Année du Modèle :</strong> {{ $chauffeur->annee_modele }}</p>
            <p><strong>Nombre de courses :</strong> {{ $chauffeur->nombre_course }}</p>
            <p><strong>Disponibilité :</strong> {{ $chauffeur->disponibilite ? 'Disponible' : 'Non disponible' }}</p>
        </div>

        <div class="form-group">
            <strong>Photo actuelle :</strong><br>
            @if ($chauffeur->photo)
                <img src="{{ asset('storage/' . $chauffeur->photo) }}" alt="Photo du Chauffeur">
            @else
                <p>Aucune photo disponible.</p>
            @endif
        </div>
    
        
    
        @auth
            <!-- Afficher le formulaire pour mettre à jour la photo et supprimer le chauffeur uniquement pour les utilisateurs authentifiés -->
            <form action="{{ route('chauffeurs.update', $chauffeur->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
    
                <div class="form-group">
                    <input type="file" name="photo" accept="image/*" class="form-control">
                    <button type="submit" class="btn btn-primary mt-3">Mettre à jour la photo</button>
                </div>
            </form>
    
            <form action="{{ route('chauffeurs.destroy', $chauffeur->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce chauffeur?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Supprimer le Chauffeur</button>
            </form>
        @endauth

        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Retourner au Dashboard</a>
    </div>

@endsection
