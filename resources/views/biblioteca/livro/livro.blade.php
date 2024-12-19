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
    <div class="d-flex justify-content-center">
    {{ $livros->links() }}
</div>
  </div>
</div>

@include('biblioteca.livro.cadastrar')

@endsection