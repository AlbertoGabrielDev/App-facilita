@extends('layouts.principal')

@section('conteudo')
<div id="books-section" class="section m-5">
  <h2>Gerenciamento de Livros</h2>
  @include('componentes.search')
  <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#bookModal">
    Novo Livro
  </button>

  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Título</th>
          <th>Autor</th>
          <th>Número de Registro</th>
          <th>Gênero</th>
          <th>Situação</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody id="books-table-body">
        @foreach ($livros as $livro)
        <tr>
          <td>{{ $livro->nome }}</td>
          <td>{{ $livro->autor }}</td>
          <td>{{ $livro->numero_registro }}</td>
          <td>{{ $livro->genero }}</td>
          <td>{{ $livro->situacao }}</td>
          <td>
            <button class="btn btn-primary editBook" data-id="{{ $livro->id }}">Editar</button>
            <button class="btn btn-danger deleteBook" data-id="{{ $livro->id }}">Excluir</button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <a href="#" class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400">{{$livros->currentPage()}}</a>

  </div>
</div>

@include('biblioteca.livro.cadastrar')

@endsection