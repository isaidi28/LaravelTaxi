<?php

namespace App\Models;

use App\Models\User;
use App\Models\Course;
use App\Models\Chauffeur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    public function courses()
    {
        return $this->hasMany(Course::class);
    }


  // Relation avec le chauffeur
  public function chauffeur()
  {
      return $this->belongsTo(Chauffeur::class);
  }

  // Relation avec l'utilisateur (client)
  public function utilisateur()
  {
      return $this->belongsTo(User::class); // ou Client::class si tu utilises un modèle Client
  }
}
