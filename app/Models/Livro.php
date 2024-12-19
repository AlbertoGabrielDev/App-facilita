<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $fillable = ['nome', 'autor', 'numero_registro', 'situacao', 'genero'];

    public function bookLoans()
    {
        return $this->hasMany(LivroEmprestimo::class);
    }
}