<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    use HasFactory;

    protected $table = 'ebooks';

    protected $fillable = [
        'livro_id',
        'titulo',
        'autor',
        'editora',
        'numero_de_paginas',
        'sinopse',
        'tamanho_do_arquivo',
    ];

    protected $casts = [
        'livro_id' => 'integer',
        'numero_de_paginas' => 'integer',
    ];

    /**
     *
     */
    public function livro()
    {
        return $this->belongsTo(Livraria::class, 'livro_id');
    }
}
