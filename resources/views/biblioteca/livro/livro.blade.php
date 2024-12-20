@extends('layouts.principal')

@section('conteudo')
<div id="books-section" class="section m-5">
  <h2>Gerenciamento de Livros</h2>
  @include('componentes.search')
  <a href="{{ route('livro.create') }}" class="btn btn-primary mb-3">Novo Livro</a>

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
            <a href="{{ route('livro.edit', $livro->id) }}" class="btn btn-primary">Editar</a>
            <form action="{{ route('livro.destroy', $livro->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $livro->id }}">
              @csrf
              @method('DELETE')
              <button type="button" class="btn btn-danger" onclick="showDeleteToast({{ $livro->id }})">Excluir</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="pagination">
            {{ $livros->links() }}
        </div>

  </div>
</div>

<div id="deleteToast" class="toast align-items-center text-bg-warning border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
  <div class="d-flex">
    <div class="toast-body">
      Tem certeza que deseja excluir este livro?
    </div>
    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-footer">
    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Sim</button>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="toast">Cancelar</button>
  </div>
</div>

@endsection

<script>
  let livroIdToDelete = null;

  function showDeleteToast(livroId) {
    livroIdToDelete = livroId;
    var toast = new bootstrap.Toast(document.getElementById('deleteToast'));
    toast.show();

    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
      if (livroIdToDelete !== null) {
        document.getElementById('delete-form-' + livroIdToDelete).submit();
      }
    });
  }
</script>