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
        Schema::create('livraria', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique();
            $table->string('autor');
            $table->decimal('valor', 8, 2);
            $table->string('genero'); // tamanho 
            $table->foreignId('categoria_id')->constrained('categoria_livros');
            $table->text('sinopse')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livraria');
    }
};
