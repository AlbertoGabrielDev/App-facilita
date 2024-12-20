<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmprestimoForm;
use App\Models\Livro;
use App\Models\LivroEmprestimo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmprestimoController extends Controller
{

    public function model()
    {
        return LivroEmprestimo::class;
    }

    protected $fieldSearchable = [
        'nome' => 'like',
        'autor' => 'like',
        'genero' => 'like',
        'situacao' => 'like',
        'numero_registro' => '=',
        'name' => 'like',
        'status_emprestimo' => '=',
        'data_emprestimo' => '=',
        'data_devolucao' => '=',
    
    ];

    public function index()
    {
        $query = $this->applyFilters();
      
        $emprestimos = $query->with(['livro', 'user'])->paginate(5);

        return view('biblioteca.emprestimo.emprestimo', compact('emprestimos'));
    }

    public function create()
    {
        $livros = Livro::where('situacao', 'Disponível')->get();
        $usuarios = User::all();
        return view('biblioteca.emprestimo.cadastrar', compact('livros', 'usuarios'));
    }

    public function store(EmprestimoForm $request)
    {

        $validatedData = $request->validated();
    
        $statusMapping = [
            'em_andamento' => 'Em Andamento',
            'atrasado' => 'Atrasado',
            'devolvido' => 'Devolvido',
        ];
   
        $situacaoMapping = [
            'Disponivel' => 'Disponível', 
            'Emprestado' => 'Emprestado',
        ];
      
        $validatedData['status_emprestimo'] = $statusMapping[$validatedData['status_emprestimo']] ?? 'Em Andamento';
    
        $validatedData['data_emprestimo'] = now()->format('Y-m-d');
        
        LivroEmprestimo::create($validatedData);
      
        $livro = Livro::findOrFail($validatedData['id_livros']);
    
        if (isset($validatedData['situacao'])) {
            $livro->situacao = $situacaoMapping[$validatedData['situacao']] ?? 'Emprestado';
        } else {
            $livro->situacao = 'Emprestado';  
        }
    
        $livro->save();
    
        return redirect()->route('emprestimo.index')->with('success', 'Empréstimo registrado com sucesso.');
    }
    
    public function edit($id)
    {
        $emprestimo = LivroEmprestimo::with('livro', 'user')->findOrFail($id);
        $usuarios = User::all();
        $livros = Livro::all();

        return view('biblioteca.emprestimo.cadastrar', compact('emprestimo', 'usuarios', 'livros'));
    }

    public function update(EmprestimoForm $request, $id)
    {
    
        $emprestimo = LivroEmprestimo::findOrFail($id);
        
        $validatedData = $request->validated();
      
        $statusMapping = [
            'em_andamento' => 'Em Andamento',
            'atrasado' => 'Atrasado',
            'devolvido' => 'Devolvido',
        ];
        
        $situacaoMapping = [
            'Disponivel' => 'Disponível', 
            'Emprestado' => 'Emprestado',
        ];
        

        if (isset($validatedData['situacao'])) {
            $validatedData['situacao'] = $situacaoMapping[$validatedData['situacao']] ?? 'Disponível';
        }
    
        $validatedData['status_emprestimo'] = $statusMapping[$validatedData['status_emprestimo']] ?? 'Em Andamento';
      
        $emprestimo->update($validatedData);
     
        if (isset($validatedData['situacao'])) {
            $livro = $emprestimo->livro; 
            $livro->situacao = $validatedData['situacao'];
            $livro->save(); 
        }
    
        return redirect()->route('emprestimo.index')->with('success', 'Empréstimo atualizado com sucesso');
    }
    
    
    public function destroy($id)
    {
        $emprestimo = LivroEmprestimo::findOrFail($id);
        $emprestimo->delete();
        return redirect()->route('emprestimo.index')->with('success', 'Emprestimo excluído com sucesso!');
    }
}
