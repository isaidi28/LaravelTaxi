@extends('layouts.app')

@section('styles')
<style>
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

    img {
        display: block;
        max-width: 100%;
        height: auto;
        margin: 20px 0;
        border-radius: 8px;
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
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

    <div class="details-container">
        <h1>Détails de la Course</h1>

        <p><strong>ID de la Course :</strong> {{ $course->id }}</p>
        <p><strong>Utilisateur :</strong> {{ $course->utilisateur->name }}</p>
        <p><strong>Chauffeur :</strong> {{ $course->chauffeur->nom }} {{ $course->chauffeur->prenom }}</p>
        <p><strong>Date de la course :</strong> {{ $course->date_course }}</p>
        <p><strong>Montant :</strong> {{ $course->montant }} $CAD</p>
        <p><strong>Statut :</strong> {{ $course->statut }}</p>
        <p><strong>Adresse de départ :</strong> {{ $course->adresse_depart }}</p>
        <p><strong>Adresse de destination :</strong> {{ $course->adresse_destination }}</p>
        <p><strong>Date de création :</strong> {{ $course->created_at }}</p>
        <p><strong>Date de mise à jour :</strong> {{ $course->updated_at }}</p>


        @auth
        <form action="{{ route('courses.updateStatus', $course->id) }}" method="POST">
            @csrf
            <label for="statut">Modifier le Statut :</label>
            <select name="statut" id="statut" required>
                <option value="en attente" {{ $course->statut === 'en attente' ? 'selected' : '' }}>En attente</option>
                <option value="annulé" {{ $course->statut === 'annulé' ? 'selected' : '' }}>Annulé</option>
                <option value="en cours" {{ $course->statut === 'en cours' ? 'selected' : '' }}>En cours</option>
                <option value="terminé" {{ $course->statut === 'terminé' ? 'selected' : '' }}>Terminé</option>
                <option value="reporté" {{ $course->statut === 'reporté' ? 'selected' : '' }}>Reporté</option>
            </select>
            <button type="submit" class="btn-primary">{{ __('general.edit_status') }}</button>
        </form>
        @endauth

        <a href="{{ url('/') }}" class="btn btn-primary">Retourner au Dashboard</a>
    </div>
@endsection
