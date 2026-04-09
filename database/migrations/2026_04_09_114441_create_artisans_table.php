<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artisans', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->string('photo_profil')->nullable();
            $table->text('professions')->nullable();
            $table->text('description')->nullable();
            $table->string('localisation')->nullable();
            $table->decimal('note_moyenne', 2, 1)->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artisans');
    }
};
