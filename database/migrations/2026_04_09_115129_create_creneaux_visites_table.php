<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('creneaux_visites', function (Blueprint $table) {
            $table->id();

            $table->foreignId('visite_id')
                ->constrained('visites')
                ->onDelete('cascade');

            $table->dateTime('date_heure_debut');
            $table->integer('capacite_max');
            $table->boolean('est_disponible')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('creneaux_visites');
    }
};
