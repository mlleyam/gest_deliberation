<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pv', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->foreignId('promotion_id')->constrained('promotions')->cascadeOnDelete();
            $table->foreignId('semestre_id')->constrained('semestres')->cascadeOnDelete();
            $table->enum('session', ['normale', 'rattrapage'])->default('normale');
            $table->date('date_deliberation')->nullable();
            $table->string('president_jury')->nullable();
            $table->enum('statut', ['brouillon', 'valide', 'archive'])->default('brouillon');
            $table->string('fichier_path')->nullable();
            $table->string('fichier_hash', 64)->nullable()->index();
            $table->foreignId('cree_par')->constrained('users');
            $table->foreignId('valide_par')->nullable()->constrained('users');
            $table->timestamp('valide_le')->nullable();
            $table->timestamps();

            // RG1 : un seul PV par (promotion, semestre, session)
            $table->unique(['promotion_id', 'semestre_id', 'session']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pv');
    }
};