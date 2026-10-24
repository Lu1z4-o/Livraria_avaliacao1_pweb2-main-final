<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    use HasFactory;

   
    protected $table = 'hashtags';

    
    protected $fillable = [
        'tag',
        'tipo',
        'descricao',
        'cor',
    ];

    /**
     
     */
    public function livros()
    {
        return $this->belongsToMany(Livraria::class, 'livro_hashtag', 'hashtag_id', 'livro_id')->withTimestamps();
    }

    /**
     *
     */
    public function livro()
    {
        return $this->livros();
    }

    /**
     *
     */
    public function setTagAttribute($value)
    {
        $val = trim($value ?? '');
        if (!empty($val) && !str_starts_with($val, '#')) {
            $val = '#' . $val;
        }
        $this->attributes['tag'] = $val;
    }
}

