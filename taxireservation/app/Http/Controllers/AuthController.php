<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        return response()->json(['message' => 'Inscription réussie !'], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
    
        if (Auth::attempt($credentials)) {
            return response()->json([
                'success' => true,
                'message' => 'Connexion réussie.',
                'user' => Auth::user(),
            ]);
        }
    
        // Ajout d'un message de débogage
        return response()->json([
            'success' => false,
            'message' => 'Identifiants incorrects.',
            'input' => $credentials // Affiche les entrées pour le débogage
        ], 401);
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Déconnexion réussie !');
    }
}
