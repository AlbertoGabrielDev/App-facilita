<form action="{{ route('livro.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" class="form-control" name="searchLike" value="{{ request('searchLike') }}" placeholder="Buscar livros...">
        <button class="btn btn-primary" type="submit">Buscar</button>
    </div>
</form>