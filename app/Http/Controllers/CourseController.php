<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Méthode pour afficher la liste des courses avec chauffeurs et clients
    public function index()
    {
        // Récupérer les courses avec les relations vers chauffeur et utilisateur (ou client)
        $courses = Course::with('chauffeur', 'utilisateur')->get();

        // Passer les données à la vue 'dashboard'
        return view('dashboard', compact('courses'));
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.show', compact('course'));
    }

    // Méthode pour créer une nouvelle course (si nécessaire)
    public function create()
    {
        return view('courses.create'); // si tu as une vue pour ajouter des courses
    }

    // Méthode pour stocker une nouvelle course dans la base de données
    public function store(Request $request)
    {
        $request->validate([
            'montant' => 'required|numeric',
            'chauffeur_id' => 'required|exists:chauffeurs,id',
            'utilisateur_id' => 'required|exists:users,id',
            'adresse_destination' => 'required|string|max:255',
        ]);

        // Créer la course
        Course::create([
            'montant' => $request->montant,
            'chauffeur_id' => $request->chauffeur_id,
            'utilisateur_id' => $request->utilisateur_id, // ou client_id si tu utilises un modèle client
            'adresse_destination' => $request->adresse_destination,
            'statut' => 'en attente', // statut par défaut
        ]);

        return redirect()->route('courses.index')->with('success', 'Course ajoutée avec succès !');
    }

    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'statut' => 'required|string',
    ]);

    $course = Course::findOrFail($id);
    $course->statut = $request->statut; // Met à jour le statut
    $course->save();

    return redirect()->route('dashboard', $id)->with('success', 'Statut mis à jour avec succès !');
}
}
