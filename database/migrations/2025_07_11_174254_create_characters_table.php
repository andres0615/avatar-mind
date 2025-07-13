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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            
            // Información básica
            $table->string('name'); // Nombre del personaje (required)
            $table->enum('category', ['Anime', 'Videojuegos', 'Películas', 'Libros', 'Histórico', 'Original'])->nullable();
            $table->string('tagline', 100)->nullable(); // Descripción corta max 100 caracteres
            $table->enum('visibility', ['public', 'private', 'friends'])->default('public');
            
            // Personalidad y trasfondo
            $table->text('personality_description')->nullable(); // Max 500 palabras
            $table->string('age')->nullable(); // Como string porque puede ser "16 años", "Inmortal", etc.
            $table->string('occupation')->nullable();
            $table->json('interests')->nullable(); // Para almacenar array de intereses/hobbies
            
            // Configuración avanzada
            $table->integer('creativity_level')->default(7); // Rango 1-10
            $table->enum('response_length', ['short', 'medium', 'long'])->default('medium');
            
            // Metadatos
            $table->unsignedBigInteger('user_id'); // Usuario que creó el personaje
            $table->timestamps();
            
            // Índices
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['user_id', 'visibility']);
            $table->index('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
