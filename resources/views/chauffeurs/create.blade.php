@extends('layouts.app')

@section('styles')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* Ajouté pour inclure le padding dans la largeur */
        }

        input[type="file"] {
            margin-top: 10px;
        }

        .button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            display: inline-block;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .btn-primary {
            display: block;
            margin: 20px auto;
            text-align: center;
        }
    </style>

    <h1>Ajouter un Chauffeur</h1>

    <form action="{{ route('chauffeurs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" required>
        </div>
        <div>
            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" required>
        </div>
        <div>
            <label for="pocket_number">Pocket Number:</label>
            <input type="text" id="pocket_number" name="pocket_number" required>
        </div>
        <div>
            <label for="modele_taxi">Modèle de Taxi:</label>
            <input type="text" id="modele_taxi" name="modele_taxi" required>
        </div>
        <div>
            <label for="annee_modele">Année du Modèle:</label>
            <input type="number" id="annee_modele" name="annee_modele" required>
        </div>
        <div>
            <label for="nombre_course">Nombre de Courses:</label>
            <input type="number" id="nombre_course" name="nombre_course" required>
        </div>
        <div>
            <label for="disponibilite">Disponibilité:</label>
            <select id="disponibilite" name="disponibilite" required>
                <option value="1">Disponible</option>
                <option value="0">Non disponible</option>
            </select>
        </div>
        <div>
            <label for="photo">Photo du Chauffeur:</label>
            <input type="file" id="photo" name="photo" accept="image/*" required>
        </div>
        <button type="submit" class="button">Ajouter le Chauffeur</button>
    </form>

    <a href="{{ url('/') }}" class="btn btn-primary">Retourner au Dashboard</a>
@endsection
