@extends('layouts.principal')

@section('conteudo')
<div class="container mt-5">
    <h2 class="text-center">{{ isset($livro) ? 'Editar Livro' : 'Cadastrar Livro' }}</h2>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form id="bookForm" method="POST" action="{{ isset($livro) ? route('livro.update', $livro->id) : route('livro.store') }}">
        @csrf
        @if (isset($livro)) 
            @method('PUT') <!-- Método PUT para edição -->
        @endif

        <div class="mb-3">
            <label class="form-label" for="bookTitle">Título</label>
            <input type="text" class="form-control" id="bookTitle" name="nome" value="{{ old('nome', $livro->nome ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="bookAuthor">Autor</label>
            <input type="text" class="form-control" id="bookAuthor" name="autor" value="{{ old('autor', $livro->autor ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label" for="bookRegistration">Número de Registro</label>
            <input type="text" class="form-control" id="bookRegistration" name="numero_registro" value="{{ old('numero_registro', $livro->numero_registro ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label" for="bookGenre">Gênero</label>
            <select class="form-control" id="bookGenre" name="genero" required>
                <option value="Ficção" {{ old('genero', $livro->genero ?? '') == 'Ficção' ? 'selected' : '' }}>Ficção</option>
                <option value="Romance" {{ old('genero', $livro->genero ?? '') == 'Romance' ? 'selected' : '' }}>Romance</option>
                <option value="Fantasia" {{ old('genero', $livro->genero ?? '') == 'Fantasia' ? 'selected' : '' }}>Fantasia</option>
                <option value="Aventura" {{ old('genero', $livro->genero ?? '') == 'Aventura' ? 'selected' : '' }}>Aventura</option>
                <option value="Outros" {{ old('genero', $livro->genero ?? '') == 'Outros' ? 'selected' : '' }}>Outros</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label" for="bookStatus">Situação</label>
            <select class="form-control" id="bookStatus" name="situacao" required>
                <option value="disponivel" {{ old('situacao', $livro->situacao ?? '') == 'Disponivel' ? 'selected' : '' }}>Disponível</option>
                <option value="emprestado" {{ old('situacao', $livro->situacao ?? '') == 'Emprestado' ? 'selected' : '' }}>Emprestado</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($livro) ? 'Atualizar Livro' : 'Cadastrar Livro' }}</button>
    </form>
</div>
@endsection
