<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'cnpj',
        'cep',
        'razao_social',
        'rua',
        'bairro',
        'complemento',
        'cidade',
        'uf',
    ];
}
