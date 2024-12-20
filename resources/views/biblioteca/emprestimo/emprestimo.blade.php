@extends('layouts.principal')

@section('conteudo')
<div id="books-section" class="section m-5">
    <h2>Gerenciamento de Empréstimos</h2>
    <form action="{{ route('emprestimo.index') }}" method="GET" class="mb-3">
        <div class="input-group">

            <input type="text" class="form-control" name="nome" value="{{ request('nome') }}" placeholder="Nome do Livro">

            <input type="text" class="form-control" name="autor" value="{{ request('autor') }}" placeholder="Autor">

            <input type="text" class="form-control" name="usuario" value="{{ request('usuario') }}" placeholder="Usuário">

            <select class="form-control" name="status_emprestimo">
                <option value="">Status</option>
                <option value="Em Andamento" {{ old('status_emprestimo', isset($emprestimo) ? $emprestimo->status_emprestimo : '') == 'Em Andamento' ? 'selected' : '' }}>Em Andamento</option>
                <option value="Devolvido" {{ old('status_emprestimo', isset($emprestimo) ? $emprestimo->status_emprestimo : '') == 'devolvido' ? 'selected' : '' }}>Devolvido</option>
                <option value="Atrasado" {{ old('status_emprestimo', isset($emprestimo) ? $emprestimo->status_emprestimo : '') == 'atrasado' ? 'selected' : '' }}>Atrasado</option>
            </select>

            <select class="form-control" name="situacao">
                <option value="">Situação</option>
                <option value="Disponivel" {{ old('situacao', isset($emprestimo) ? $emprestimo->livro->situacao : '') == 'Disponivel' ? 'selected' : '' }}>Disponivel</option>
                <option value="Emprestado" {{ old('situacao', isset($emprestimo) ? $emprestimo->livro->situacao : '') == 'Emprestado' ? 'selected' : '' }}>Emprestado</option>
            </select>

            <div class="d-flex flex-column mr-2">
                <label for="data_emprestimo">Data de Empréstimo</label>
                <input type="date" class="form-control" name="data_emprestimo" value="{{ request('data_emprestimo') }}">
            </div>

            <div class="mb-3">
                <label class="form-label" for="data_devolucao">Data de Devolução</label>
                <input type="date" class="form-control" id="data_devolucao" name="data_devolucao"
                    value="{{ old('data_devolucao', $emprestimo->data_devolucao ?? '') }}"
                    min="{{ \Carbon\Carbon::today()->toDateString() }}">
                @error('data_devolucao')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>
    <a href="{{ route('emprestimo.create') }}" class="btn btn-primary mb-3">Novo empréstimo</a>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome do Livro</th>
                    <th>Autor</th>
                    <th>Usuário</th>
                    <th>Data de Empréstimo</th>
                    <th>Data de Devolução</th>
                    <th>Situação</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="books-table-body">
                @foreach ($emprestimos as $emprestimo)
                <tr>
                    <td>{{ $emprestimo->livro->nome }}</td>
                    <td>{{ $emprestimo->livro->autor }}</td>
                    <td>{{ $emprestimo->user->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($emprestimo->data_emprestimo)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($emprestimo->data_devolucao)->format('d/m/Y') }}</td>
                    <td>{{ $emprestimo->livro->situacao }}</td>
                    <td>{{ $emprestimo->status_emprestimo }}</td>
                    <td>
                        <a href="{{ route('emprestimo.edit', $emprestimo->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('emprestimo.destroy', $emprestimo->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $emprestimo->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" onclick="showDeleteToast({{ $emprestimo->id }})">Excluir</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination">
            {{ $emprestimos->links() }}
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
@endsection