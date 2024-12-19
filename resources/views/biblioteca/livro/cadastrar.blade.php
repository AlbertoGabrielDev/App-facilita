<!-- Modal -->
<div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="bookModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookModalLabel">Livro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="bookForm">
                    <input type="hidden" id="bookId">
                    <div class="mb-3">
                        <label class="form-label">Título</label>
                        <input type="text" class="form-control" id="bookTitle" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Autor</label>
                        <input type="text" class="form-control" id="bookAuthor" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Número de Registro</label>
                        <input type="text" class="form-control" id="bookRegistration" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gênero</label>
                        <select class="form-control" id="bookGenre" required>
                            <option value="Ficção">Ficção</option>
                            <option value="Romance">Romance</option>
                            <option value="Fantasia">Fantasia</option>
                            <option value="Aventura">Aventura</option>
                            <option value="Outros">Outros</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="saveBook">Salvar</button>
            </div>
        </div>
    </div>
</div>

<div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
    <div class="toast" style="position: absolute; top: 0; right: 0;" id="confirmationToast">
        <div class="toast-header">
            <strong class="mr-auto">Confirmação de Exclusão</strong>
           
        </div>
        <div class="toast-body">
            Tem certeza que deseja excluir este livro?
            <br />
            <button class="btn btn-danger btn-sm confirmDelete">Sim</button>
            <button class="btn btn-secondary btn-sm cancelDelete">Não</button>
        </div>
    </div>
</div>

<script>

</script>
