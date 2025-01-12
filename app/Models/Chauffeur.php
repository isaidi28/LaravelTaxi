<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chauffeur extends Model
{
    use HasFactory;

    // Ajoute tes propriétés et méthodes ici
    protected $fillable = [
        'nom', 'prenom', 'pocket_number', 'modele_taxi', 'annee_modele', 'disponibilite', 'photo'
    ];}
