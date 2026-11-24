<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resultats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pv_id')->constrained('pv')->cascadeOnDelete();
            $table->foreignId('etudiant_id')->constrained('etudiants')->cascadeOnDelete();
            $table->decimal('moyenne', 5, 2)->nullable();
            $table->unsignedSmallInteger('credits_valides')->nullable();
            $table->enum('decision', ['admis', 'ajourne', 'rattrapage', 'exclu']);
            $table->timestamps();

            // RG2 : un étudiant au plus une fois par PV
            $table->unique(['pv_id', 'etudiant_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resultats');
    }
};