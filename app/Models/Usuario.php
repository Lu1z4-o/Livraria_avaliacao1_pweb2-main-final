<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Model
{
    use HasFactory;

    // Aponta explicitamente para a tabela 'usuarios' no banco de dados
    protected $table = 'usuarios';

    // Libera esses dados pessoais (nome, CPF, endereço, e-mail, telefone e foto) para serem salvos ou atualizados via formulário
    protected $fillable = ['nome','cpf','endereco','email','telefone','foto'];
}