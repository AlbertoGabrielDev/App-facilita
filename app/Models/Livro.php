<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $fillable = ['nome', 'autor', 'numero_registro', 'situacao', 'genero','id_users','id_livros'];

    public function emprestimos()
    {
        return $this->hasMany(LivroEmprestimo::class, 'id_livros');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    
}