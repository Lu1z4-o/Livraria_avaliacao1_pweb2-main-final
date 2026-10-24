<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('avaliacaos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('livro_id')->constrained('livraria')->onDelete('cascade');
            $table->string('autor', 100)->nullable();
            $table->date('data')->nullable();
            $table->text('avaliacao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avaliacaos');
    }
};
