<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Livraria extends Model
{
    use HasFactory;

    protected $table = 'livraria';

    protected $fillable = [
        'nome',
        'valor',
        'autor',
        'genero',
        'categoria_id',
        'imagem',
        'sinopse',
    ];

    protected $casts = [
        'categoria_id' => 'integer',
        'valor' => 'decimal:2',
    ];

    public function categoriaLivro()
    {
        return $this->belongsTo(CategoriaLivro::class, 'categoria_id');
    } //função que é chamada no list

    /**
     * 
     */
    public function hashtags()
    {
        return $this->belongsToMany(Hashtag::class, 'livro_hashtag', 'livro_id', 'hashtag_id')->withTimestamps();
    }

    /**
     
     */
    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class, 'livro_id');
    }

    /**
     
     */
    public function ebook()
    {
        return $this->hasOne(Ebook::class, 'livro_id');
    }
}
