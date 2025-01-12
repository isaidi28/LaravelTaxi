<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function connexion(Request $request)
    {
        $donneeRentrant = $request->validate([
            'loginemail' => 'required|email',
            'loginpassword' => 'required',
        ]);

        if (auth()->attempt(['email' => $donneeRentrant['loginemail'], 'password' => $donneeRentrant['loginpassword']])) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Connexion réussie !');
        }

        return back()->withErrors([
            'login' => 'Identifiants invalides.',
        ])->onlyInput('loginemail');
    }

    public function create()
    {
        return view('utilisateurs.create'); // Assurez-vous que le nom de la vue est correct
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Déconnexion réussie !');
    }

    public function index()
    {
        $utilisateurs = User::all(); // Récupère tous les utilisateurs
        return view('utilisateurs.index', compact('utilisateurs')); // Assurez-vous de créer la vue correspondante
    }

    public function show($id)
    {
        $utilisateur = User::findOrFail($id); // Récupérer l'utilisateur ou renvoyer une erreur 404
        return view('utilisateurs.show', compact('utilisateur')); // Remplacez par le nom de la vue correspondante
    }

    public function inscription(Request $request)
    {
        $donneeRentrant = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'telephone' => ['nullable', 'string', 'max:15'],
            'password' => ['required', 'confirmed'], // Assurez-vous d'avoir un champ de confirmation
        ]);

        $donneeRentrant['password'] = bcrypt($donneeRentrant['password']);
        $nouvelUtilisateur = User::create($donneeRentrant);

        auth()->login($nouvelUtilisateur);
        return redirect('/')->with('success', 'Inscription réussie !');
    }

    public function store(Request $request)
    {
        $donneeRentrant = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'telephone' => ['required', 'string', 'max:15'],
            'password' => ['required', 'confirmed'], // Assurez-vous d'avoir un champ de confirmation
        ]);

        $donneeRentrant['password'] = bcrypt($donneeRentrant['password']);
        User::create($donneeRentrant); // Crée le nouvel utilisateur

        return redirect()->route('dashboard')->with('success', 'Utilisateur ajouté avec succès.');
    }
}
