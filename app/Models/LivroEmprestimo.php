<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LivroEmprestimo extends Model{


    protected $fillable = ['id_users', 'id_livros', 'data_emprestimo', 'data_devolucao', 'status_emprestimo'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function livro()
    {
        return $this->belongsTo(Livro::class, 'id_livros');
    }

    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

  
}