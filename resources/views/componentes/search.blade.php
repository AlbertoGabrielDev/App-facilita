<form action="{{ route('livro.search') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" class="form-control" name="query" placeholder="Buscar livros..." value="{{ request('query') }}">
        <button class="btn btn-primary" type="submit">Buscar</button>
    </div>
</form>