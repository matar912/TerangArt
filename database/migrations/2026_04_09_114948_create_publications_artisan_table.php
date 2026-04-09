<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('publications_artisan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('artisan_id')
                ->constrained('artisans')
                ->onDelete('cascade');

            $table->string('titre');
            $table->string('image_url');
            $table->decimal('prix', 10, 2)->nullable();
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('publications_artisan');
    }
};
