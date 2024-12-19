<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|max:255',
            'autor' => 'required|max:255',
            'numero_registro' => 'required|unique:livros',
            'genero' => 'required'
        ]);

        $livro = Livro::create($validatedData);

        if ($request->ajax()) {
            return response()->json([
                'success' => 'Livro criado com sucesso!',
                'livro' => $livro
            ]);
        }

        return view('livro.index')->with('success', 'Livro criado');
    }

    public function edit($id)
    {
        $livro = Livro::findOrFail($id);
        return response()->json($livro);
    }

    public function update(Request $request, $id)
    {
        $livro = Livro::findOrFail($id);

        $validatedData = $request->validate([
            'nome' => 'required|max:255',
            'autor' => 'required|max:255',
            'numero_registro' => 'required|unique:livros,numero_registro,' . $livro->id,
            'genero' => 'required'
        ]);

        $livro->update($validatedData);

        return response()->json([
            'success' => 'Livro atualizado com sucesso!',
            'livro' => $livro 
        ]);
    }

    public function destroy($id)
    {
        $livro = Livro::findOrFail($id);
        $livro->delete();
        return response()->json([
            'success' => 'Livro excluído com sucesso!'
        ]);
    }

}
