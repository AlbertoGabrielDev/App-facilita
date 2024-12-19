<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LivroEmprestimo extends Model{

    protected $fillable = ['user_id', 'livro_id', 'data_emprestimo', 'data_devolucao', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Livro::class);
    }
}