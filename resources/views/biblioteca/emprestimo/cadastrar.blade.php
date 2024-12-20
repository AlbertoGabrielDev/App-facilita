@extends('layouts.principal')

@section('conteudo')
<div class="container mt-5">
    <h2 class="text-center">{{ isset($emprestimo) ? 'Editar Empréstimo' : 'Cadastrar Empréstimo' }}</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form id="bookForm" method="POST" action="{{ isset($emprestimo) ? route('emprestimo.update', $emprestimo->id) : route('emprestimo.store') }}">
        @csrf
        @if (isset($emprestimo))
        @method('PUT')
        @endif

        <div class="mb-3">
            <label class="form-label" for="id_users">Usuário</label>
            <select class="form-control" id="id_users" name="id_users" required>
                <option value="">Selecione o Usuário</option>
                @foreach($usuarios as $usuario)
                <option value="{{ $usuario->id }}"
                    {{ old('id_users', $emprestimo->id_users ?? '') == $usuario->id ? 'selected' : '' }}>
                    {{ $usuario->name }} - {{ $usuario->email }}
                </option>
                @endforeach
            </select>
            @error('id_users')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="mb-3">
            <label class="form-label" for="id_livros">Livro</label>
            <select class="form-control" id="id_livros" name="id_livros" required>
                <option value="">Selecione o Livro</option>
                @foreach($livros as $livro)
                <option value="{{ $livro->id }}"
                    {{ old('id_livros', $emprestimo->id_livros ?? '') == $livro->id ? 'selected' : '' }}
                    data-numero_registro="{{ $livro->numero_registro }}"
                    data-genero="{{ $livro->genero }}">
                    {{ $livro->nome }} - {{ $livro->autor }} ({{ $livro->numero_registro }})
                </option>
                @endforeach
            </select>
            @error('id_livros')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label" for="bookRegistration">Número de Registro</label>
            <input type="text" class="form-control" id="bookRegistration" name="numero_registro" value="{{ old('numero_registro', isset($emprestimo) ? $emprestimo->livro->numero_registro : '') }}" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label" for="bookGenre">Gênero</label>
            <input type="text" class="form-control" id="bookGenre" name="genero" value="{{ old('genero', isset($emprestimo) ? $emprestimo->livro->genero : '') }}" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label" for="data_devolucao">Data de Devolução</label>
            <input type="date" class="form-control" id="data_devolucao" name="data_devolucao" value="{{ old('data_devolucao', $emprestimo->data_devolucao ?? '') }}" required>
            @error('data_devolucao')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label" for="dataEmprestimo">Data do Empréstimo</label>
            <input type="date" class="form-control" id="dataEmprestimo" name="data_emprestimo"
                value="{{ old('data_emprestimo', now('America/Sao_Paulo')->format('Y-m-d')) }}" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label" for="bookStatus">Situação</label>
            <select class="form-control" id="bookStatus" name="situacao" required>
                <option value="Disponivel" {{ old('situacao', isset($emprestimo) ? $emprestimo->livro->situacao : '') == 'Disponivel' ? 'selected' : '' }}>Disponível</option>
                <option value="Emprestado" {{ old('situacao', isset($emprestimo) ? $emprestimo->livro->situacao : '') == 'Emprestado' ? 'selected' : '' }}>Emprestado</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label" for="bookStatus">Status</label>
            <select class="form-control" id="bookStatus" name="status_emprestimo" required>
                <option value="em_andamento" {{ old('status_emprestimo', isset($emprestimo) ? $emprestimo->situacao : '') == 'em_andamento' ? 'selected' : 'selected' }}>Em Andamento</option>
                <option value="devolvido" {{ old('status_emprestimo', isset($emprestimo) ? $emprestimo->situacao : '') == 'devolvido' ? 'selected' : '' }}>Devolvido</option>
                <option value="atrasado" {{ old('status_emprestimo', isset($emprestimo) ? $emprestimo->situacao : '') == 'atrasado' ? 'selected' : '' }}>Atrasado</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($emprestimo) ? 'Atualizar Empréstimo' : 'Cadastrar Empréstimo' }}</button>
    </form>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('id_livros').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            if (selectedOption.value) {
                document.getElementById('bookRegistration').value = selectedOption.getAttribute('data-numero_registro');
                document.getElementById('bookGenre').value = selectedOption.getAttribute('data-genero');
            } else {
                document.getElementById('bookRegistration').value = '';
                document.getElementById('bookGenre').value = '';
            }
        });

        if (document.getElementById('id_livros').value) {
            var selectedOption = document.getElementById('id_livros').options[document.getElementById('id_livros').selectedIndex];
            document.getElementById('bookRegistration').value = selectedOption.getAttribute('data-numero_registro');
            document.getElementById('bookGenre').value = selectedOption.getAttribute('data-genero');
        }
    });
</script>

@endsection