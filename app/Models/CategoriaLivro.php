<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaLivro extends Model
{
    use HasFactory;

    protected $table = 'categoria_livros';


    protected $fillable = [
        'categoria',
    ];

    /**
     * 
     */
    public function livros()
    {
        return $this->hasMany(Livraria::class, 'categoria_id');
    }
}
