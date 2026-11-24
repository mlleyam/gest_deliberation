<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('journal_activites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('action');
            $table->string('objet_type')->nullable();
            $table->unsignedBigInteger('objet_id')->nullable();
            $table->string('adresse_ip', 45)->nullable();
            $table->text('details')->nullable();
            $table->timestamp('date')->useCurrent();

            $table->index(['objet_type', 'objet_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('journal_activites');
    }
};