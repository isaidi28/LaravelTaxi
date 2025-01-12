<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ChauffeurController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LanguagueController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\Auth\RegisterController;

// Route pour la page monopage
Route::get('{any}', function () {
    return view('monopage');
})->where('any', '.*');

// Toutes les autres routes
Route::get('/apropos', function () { return view('apropos'); });
Route::get('/', [DashboardController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Routes concernant chauffeurs
Route::get('chauffeurs/create', [ChauffeurController::class, 'create'])->name('chauffeurs.create');
Route::post('chauffeurs', [ChauffeurController::class, 'store'])->name('chauffeurs.store');
Route::delete('/chauffeurs/{id}', [ChauffeurController::class, 'destroy'])->name('chauffeurs.destroy');
Route::put('/chauffeurs/{id}', [ChauffeurController::class, 'update'])->name('chauffeurs.update');
Route::get('/chauffeurs/{id}', [ChauffeurController::class, 'show'])->name('chauffeurs.show');
Route::get('/chauffeurs/search', [ChauffeurController::class, 'search'])->name('chauffeurs.search');
Route::get('/chauffeurs/autocomplete', [ChauffeurController::class, 'autocomplete'])->name('chauffeurs.autocomplete');

// Routes concernant courses
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');
Route::post('/courses/{id}/update-status', [CourseController::class, 'updateStatus'])->name('courses.updateStatus');

// Routes concernant utilisateurs
Route::get('/utilisateurs/create', [UserController::class, 'create'])->name('users.create');
Route::resource('utilisateurs', UserController::class);

// Routes concernant les langues
Route::get('/language/{locale}', [LocalizationController::class, 'switchLanguage'])->name('language.switch');

// Routes d'authentification
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');