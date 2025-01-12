<?php

namespace App\Http\Controllers;

use App\Models\Chauffeur;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $chauffeurs = Chauffeur::all();
        $courses = Course::all();
        $utilisateurs = User::all();

        return view('dashboard', compact('chauffeurs', 'courses', 'utilisateurs'));
    }
}
