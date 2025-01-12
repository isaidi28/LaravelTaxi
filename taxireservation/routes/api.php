<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ChauffeurController as ApiChauffeurController;
use App\Http\Controllers\Api\CourseController as ApiCourseController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');

// API Chauffeurs
Route::get('chauffeurs', [ApiChauffeurController::class, 'index']); // Liste
Route::post('chauffeurs', [ApiChauffeurController::class, 'store']); // Création
Route::get('chauffeurs/{id}', [ApiChauffeurController::class, 'show']); // Afficher un chauffeur
Route::put('chauffeurs/{id}', [ApiChauffeurController::class, 'update']); // Modifier
Route::delete('chauffeurs/{id}', [ApiChauffeurController::class, 'destroy']); // Supprimer
Route::get('/chauffeurs/autocomplete', [ChauffeurController::class, 'autocomplete'])->name('chauffeurs.autocomplete');

// API courses
Route::get('courses', [ApiCourseController::class, 'index']);// Liste des courses
Route::get('courses/{id}', [ApiCourseController::class, 'show']);// Afficher une course spécifique
Route::post('courses', [ApiCourseController::class, 'store']);// Créer une nouvelle course
Route::put('courses/{id}/status', [ApiCourseController::class, 'updateStatus']);// Mettre à jour le statut d'une course
Route::delete('courses/{id}', [ApiCourseController::class, 'destroy']);// Supprimer une course


// Route pour obtenir l'utilisateur connecté
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});