<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    use HasFactory;

    protected $table = 'avaliacaos';

    
    protected $fillable = ['livro_id', 'autor', 'data', 'avaliacao'];

    protected $casts = [
        'livro_id' => 'integer',
        'data' => 'date',
    ];

    /**
     .
     */
    public function livro()
    {
        return $this->belongsTo(Livraria::class, 'livro_id');
    }
}