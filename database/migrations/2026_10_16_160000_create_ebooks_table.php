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
        Schema::create('ebooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('livro_id')->unique()->constrained('livraria')->onDelete('cascade');
            $table->string('titulo');
            $table->string('autor');
            $table->string('editora');
            $table->integer('numero_de_paginas');
            $table->text('sinopse');
            $table->string('tamanho_do_arquivo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ebooks');
    }
};
