<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chauffeur;
use Illuminate\Support\Facades\Storage;

class ChauffeurController extends Controller
{
    // Récupérer la liste des chauffeurs
    public function index()
    {
        $chauffeurs = Chauffeur::all();
        return response()->json($chauffeurs);
    }

    // Créer un nouveau chauffeur
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:50',
            'prenom' => 'required|string|max:50',
            'pocket_number' => 'required|string|max:20',
            'modele_taxi' => 'required|string|max:50',
            'annee_modele' => 'required|integer',
            'disponibilite' => 'required|boolean',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $validatedData['photo'] = $path;
        }

        $chauffeur = Chauffeur::create($validatedData);
        return response()->json($chauffeur, 201);
    }

    // Afficher un chauffeur spécifique
    public function show($id)
    {
        $chauffeur = Chauffeur::find($id);

        if (!$chauffeur) {
            return response()->json(['message' => 'Chauffeur non trouvé'], 404);
        }

        return response()->json($chauffeur);
    }

    // Mettre à jour un chauffeur existant
    public function update(Request $request, $id)
    {
        $chauffeur = Chauffeur::find($id);

        if (!$chauffeur) {
            return response()->json(['message' => 'Chauffeur non trouvé'], 404);
        }

        $validatedData = $request->validate([
            'nom' => 'sometimes|string|max:50',
            'prenom' => 'sometimes|string|max:50',
            'pocket_number' => 'sometimes|string|max:20',
            'modele_taxi' => 'sometimes|string|max:50',
            'annee_modele' => 'sometimes|integer',
            'disponibilite' => 'sometimes|boolean',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($chauffeur->photo) {
                Storage::delete('public/' . $chauffeur->photo);
            }
            $path = $request->file('photo')->store('photos', 'public');
            $validatedData['photo'] = $path;
        }

        $chauffeur->update($validatedData);
        return response()->json($chauffeur);
    }

    // Supprimer un chauffeur
    public function destroy($id)
    {
        $chauffeur = Chauffeur::find($id);

        if (!$chauffeur) {
            return response()->json(['message' => 'Chauffeur non trouvé'], 404);
        }

        if ($chauffeur->photo) {
            Storage::delete('public/' . $chauffeur->photo);
        }

        $chauffeur->delete();
        return response()->json(['message' => 'Chauffeur supprimé avec succès']);
    }
}
