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
        Schema::create('info_attestation', function (Blueprint $table) {
            $table->id();
            $table->string('nom_complet');
            $table->date('date_naissance');
            $table->string('lieu_naissance'); // J'ai changé le type de 'date' à 'varchar'
            $table->string('ecole');
            $table->integer('numero_table');
            $table->string('session'); // Ex: "2024"
            $table->string('centre');
            $table->string('numero_registre');
            $table->foreignId('id_demande')
                  ->constrained('demandes')
                  ->onDelete('cascade'); // Si la demande est supprimée, ses infos aussi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_attestation');
    }
};
