<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            $table->foreignUuid('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->foreignId('creneau_id')
                ->constrained('creneaux_visites')
                ->onDelete('cascade');

            $table->enum('statut', ['en_attente', 'confirme', 'annule'])
                  ->default('en_attente');

            $table->decimal('montant_paye', 10, 2)->nullable();
            $table->timestamp('reserve_le')->useCurrent();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
