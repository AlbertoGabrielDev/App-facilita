<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioForm;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $fieldSearchable = [
        'name' => 'like',
        'email' => 'like',
        'numero_cadastro' => '=',
        'status' => '=',
    ];
    public function index()
    {
        $user = User::query();
        $this->applyLikeConditions($user, request()->get('searchLike'));
        $users = $user->where('id', '!=' , 1)->paginate(15);
       
        return view('biblioteca.usuario.usuario', compact('users'));
    }

    public function create()
    {
        return view('biblioteca.usuario.cadastrar');
    }

    public function store(UsuarioForm $request)
    {
        $dadosValidados = $request->validated();
        User::create($dadosValidados);
        return redirect()->route('usuario.index')->with('success', 'Usuário criado');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); 
        return view('biblioteca.usuario.cadastrar', compact('user')); 
    }

    public function update(UsuarioForm $request, $id)
{
    $user = User::findOrFail($id); 
    $validatedData = $request->validated();
    $user->update($validatedData);  

    return redirect()->route('usuario.index')->with('success', 'Usuario atualizado com sucesso');
}

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('usuario.index')->with('success', 'Usuario excluído com sucesso!');

    }

    public function status($statusId)
    {
        $status = User::findOrFail($statusId);
        // Gate::authorize('permissao');
        $status->status = ($status->status == 0) ? 1 : 0;
        $status->save();
        return response()->json(['status' => $status->status]);
    }
}
