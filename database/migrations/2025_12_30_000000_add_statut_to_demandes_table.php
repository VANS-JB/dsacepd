<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('demandes', function (Blueprint $table) {
            // Ajout d'une colonne statut si elle n'existe pas déjà
            if (! Schema::hasColumn('demandes', 'statut')) {
                $table->enum('statut', ['en attente', 'validée', 'rejetée'])->default('en attente')->after('photo_naissance');
            }
        });
    }

    public function down(): void
    {
        Schema::table('demandes', function (Blueprint $table) {
            if (Schema::hasColumn('demandes', 'statut')) {
                $table->dropColumn('statut');
            }
        });
    }
};
