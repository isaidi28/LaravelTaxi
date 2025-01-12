<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChauffeursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chauffeurs', function (Blueprint $table) {
            $table->id(); 
            $table->string('nom', 50); 
            $table->string('prenom', 50); 
            $table->string('pocket_number', 20); 
            $table->string('modele_taxi', 50); 
            $table->integer('annee_modele'); 
            $table->integer('nombre_course')->default(0); 
            $table->boolean('disponibilite'); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chauffeurs');
    }
}
