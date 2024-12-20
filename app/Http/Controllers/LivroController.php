<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivroForm;
use App\Http\Requests\LivroRequest;
use App\Models\Livro;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    protected $fieldSearchable = [
        'nome' => 'like',
        'autor' => 'like',
        'genero' => 'like',
        'situacao' => 'like',
        'numero_registro' => '=',
    ];

    public function index()
{
    $livros = Livro::query();
    $this->applyLikeConditions($livros, request()->get('searchLike'));
    $livros = $livros->paginate(15);

    return view('biblioteca.livro.livro', compact('livros'));
}

    public function create()
    {
        return view('biblioteca.livro.cadastrar');
    }

    public function store(LivroRequest $request)
    {

        $validatedData = $request->validated();
        Livro::create($validatedData);
        return redirect()->route('livro.index')->with('success', 'Livro criado com sucesso');
    }

    public function edit($id)
    {
        $livro = Livro::findOrFail($id); 
        return view('biblioteca.livro.cadastrar', compact('livro')); 
    }

    public function update(LivroRequest $request, $id)
{
    $livro = Livro::findOrFail($id); 
    $validatedData = $request->validated();
    $livro->update($validatedData);  

    return redirect()->route('livro.index')->with('success', 'Livro atualizado com sucesso');
}

    public function destroy($id)
    {
        $livro = Livro::findOrFail($id);
        $livro->delete();
        return redirect()->route('livro.index')->with('success', 'Livro excluído com sucesso!');

    }

}
