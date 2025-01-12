<?php

namespace App\Http\Controllers;

use App\Models\Chauffeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChauffeurController extends Controller
{
    public function create()
    {
        return view('chauffeurs.create');
    }

    public function show($id)
    {
        $chauffeur = Chauffeur::findOrFail($id);
        return view('chauffeurs.show', compact('chauffeur'));
    }
  
    public function store(Request $request)
{
    // Validation des données
    $validatedData = $request->validate([
        'nom' => 'required|string|max:50',
        'prenom' => 'required|string|max:50',
        'pocket_number' => 'required|string|max:20',
        'modele_taxi' => 'required|string|max:50',
        'annee_modele' => 'required|integer',
        'disponibilite' => 'required|boolean',
        'photo' => 'nullable|image|max:2048|mimes:jpg,png,jpeg,gif,svg',
    ]);

    // Gestion de l'upload de la photo
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('photos', 'public');
        $validatedData['photo'] = $photoPath;
    } else {
        $validatedData['photo'] = null; // Si pas de photo, on affecte null
    }

    // Création du chauffeur
    Chauffeur::create($validatedData);

    // Redirection vers la page d'accueil ou une autre page
    return redirect()->route('dashboard')->with('success', 'Chauffeur ajouté avec succès!');
}
    public function destroy($id)
{
    $chauffeur = Chauffeur::findOrFail($id);
        // Supprimer l'ancienne photo si elle existe
        if ($chauffeur->photo) {
            Storage::delete('public/' . $chauffeur->photo);
        }
        $chauffeur->delete();

        return redirect()->route('dashboard')->with('success', 'Chauffeur supprimé avec succès!');
}


public function update(Request $request, $id)
{
    $chauffeur = Chauffeur::findOrFail($id);

    $validatedData = $request->validate([
        'photo' => 'image|nullable|max:2048', 
    ]);

    if ($request->hasFile('photo')) {
        if ($chauffeur->photo) {
            Storage::delete($chauffeur->photo);
        }

        $path = $request->file('photo')->store('photos', 'public');
        $validatedData['photo'] = $path; 
    }

    $chauffeur->update($validatedData);

    return redirect()->route('chauffeurs.show', $chauffeur->id)->with('success', 'Photo du chauffeur mise à jour avec succès');



}


public function search(Request $request)
{
    $term = $request->get('term');  // Récupère le terme de recherche
    $chauffeurs = Chauffeur::where('nom', 'like', '%' . $term . '%')
                           ->orWhere('prenom', 'like', '%' . $term . '%')
                           ->get();

    return response()->json($chauffeurs);  // Retourne les résultats sous forme de JSON
}

public function autocomplete(Request $request)
{
    $query = $request->input('query');
    $chauffeurs = Chauffeur::where('nom', 'like', '%' . $query . '%')
                           ->orWhere('prenom', 'like', '%' . $query . '%')
                           ->take(10) 
                           ->get(['id', 'nom', 'prenom']); 

    return response()->json($chauffeurs); 
}


}
