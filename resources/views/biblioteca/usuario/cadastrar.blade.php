@extends('layouts.principal')

@section('conteudo')
<div class="container mt-5">
    <h2 class="text-center">{{ isset($user) ? 'Editar user' : 'Cadastrar user' }}</h2>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form id="bookForm" method="POST" action="{{ isset($user) ? route('usuario.update', $user->id) : route('usuario.store') }}">
        @csrf
        @if (isset($user)) 
            @method('PUT')
        @endif

        <div class="mb-3">
            <label class="form-label" for="bookTitle">Nome</label>
            <input type="text" class="form-control" id="bookTitle" name="name" value="{{ old('name', $user->name ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="bookAuthor">Número de cadastro</label>
            <input type="number" class="form-control" id="bookAuthor" name="numero_cadastro" value="{{ old('numero_cadastro', $user->numero_cadastro ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label" for="bookRegistration">Email</label>
            <input type="email" class="form-control" id="bookRegistration" name="email" value="{{ old('email', $user->email ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="bookRegistration">Senha</label>
            <input type="password" class="form-control" id="bookRegistration" name="password" value="{{ old('password', $user->password ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($user) ? 'Atualizar user' : 'Cadastrar user' }}</button>
    </form>
</div>
@endsection
