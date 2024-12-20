@extends('layouts.principal')

@section('conteudo')
<div id="books-section" class="section m-5">
    <h2>Gerenciamento de usuário</h2>
    @include('componentes.search')
    @can('permissao')
    <a href="{{ route('usuario.create') }}" class="btn btn-primary mb-3">Novo usuário</a>
    @endcan
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Número de cadastro</th>
                    <th>Email</th>
                    @can('permissao')
                    <th>Ações</th>
                    @endcan
                </tr>
            </thead>
            <tbody id="books-table-body">
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->numero_cadastro }}</td>
                    <td>{{ $user->email }}</td>

                    <td>
                        @can('permissao')
                        <a href="{{ route('usuario.edit', $user->id) }}" class="btn btn-primary">Editar</a>
                        @endcan
                        @can('permissao')
                        <form action="{{ route('usuario.destroy', $user->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $user->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" onclick="showDeleteToast({{ $user->id }})">Excluir</button>
                        </form>
                        @endcan
                        <button class="toggle-ativacao @if($user->status === 1) btn btn-danger @elseif($user->status === 0) btn btn-success @else btn-primary @endif" data-id="{{ $user->id}}">
              {{ $user->status ? 'Inativar' : 'Ativar' }}
            </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="#" class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400">{{$users->currentPage()}}</a>

    </div>
</div>

<div id="deleteToast" class="toast align-items-center text-bg-warning border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
    <div class="d-flex">
        <div class="toast-body">
            Tem certeza que deseja excluir este usuário?
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
    let userIdToDelete = null;

    function showDeleteToast(userId) {
        userIdToDelete = userId;
        var toast = new bootstrap.Toast(document.getElementById('deleteToast'));
        toast.show();

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (userIdToDelete !== null) {
                document.getElementById('delete-form-' + userIdToDelete).submit();
            }
        });
    }
</script>