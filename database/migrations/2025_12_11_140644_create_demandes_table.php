<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->string('photo_releve'); // Chemin du fichier
            $table->string('photo_naissance'); // Chemin du fichier
            $table->foreignId('id_users') // Nom logique pour la relation
                  ->constrained('users') // Référence la table 'users'
                  ->onDelete('cascade'); // Si un user est supprimé, ses demandes aussi
            $table->dateTime('date_demande')->useCurrent(); // Date automatique à la création
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};
