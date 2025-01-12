<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Liste des courses avec chauffeurs et utilisateurs
    public function index()
    {
        $courses = Course::with('chauffeur', 'utilisateur')->get();
        return response()->json($courses);
    }

    // Afficher une course spécifique
    public function show($id)
    {
        $course = Course::with('chauffeur', 'utilisateur')->find($id);

        if (!$course) {
            return response()->json(['message' => 'Course non trouvée'], 404);
        }

        return response()->json($course);
    }

    // Ajouter une nouvelle course
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'montant' => 'required|numeric',
            'chauffeur_id' => 'required|exists:chauffeurs,id',
            'utilisateur_id' => 'required|exists:users,id',
            'adresse_destination' => 'required|string|max:255',
        ]);

        $validatedData['statut'] = 'en attente'; // Défaut pour le statut

        $course = Course::create($validatedData);

        return response()->json($course, 201);
    }

    // Mettre à jour le statut d'une course
    public function updateStatus(Request $request, $id)
    {
        $validatedData = $request->validate([
            'statut' => 'required|string',
        ]);

        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course non trouvée'], 404);
        }

        $course->statut = $validatedData['statut'];
        $course->save();

        return response()->json($course);
    }

    // Supprimer une course
    public function destroy($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course non trouvée'], 404);
        }

        $course->delete();

        return response()->json(['message' => 'Course supprimée avec succès']);
    }
}
