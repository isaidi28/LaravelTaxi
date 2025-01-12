<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    // Vérifie si la table 'courses' existe déjà
    if (!Schema::hasTable('courses')) {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')
                  ->constrained('users')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreignId('chauffeur_id')
                  ->constrained('chauffeurs')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->dateTime('date_course');
            $table->decimal('montant', 10, 2);
            $table->string('statut', 20);
            $table->string('adresse_depart', 255); 
            $table->string('adresse_destination', 255); 
            $table->timestamps();
        });
    }
}
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
