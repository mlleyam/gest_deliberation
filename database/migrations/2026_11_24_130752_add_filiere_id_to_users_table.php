<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Renseigné pour les chefs de département (et enseignants), null pour admin/agent
            $table->foreignId('filiere_id')->nullable()->after('actif')
                  ->constrained('filieres')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('filiere_id');
        });
    }
};