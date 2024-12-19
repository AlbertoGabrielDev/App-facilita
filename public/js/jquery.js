$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const bookModal = new bootstrap.Modal($('#bookModal')[0]);

    const clearModal = () => {
        $('#bookId').val('');
        $('#bookTitle').val('');
        $('#bookAuthor').val('');
        $('#bookRegistration').val('');
        $('#bookGenre').val('');
    };

    const showModal = () => bookModal.show();
    const hideModal = () => {
        bookModal.hide();
        clearModal();
    };

    const handleError = (message) => toastr.error(message || "Erro ao realizar a ação.");

    const saveBook = (e) => {
        e.preventDefault();

        const bookId = $('#bookId').val();
        const bookData = {
            nome: $('#bookTitle').val(),
            autor: $('#bookAuthor').val(),
            numero_registro: $('#bookRegistration').val(),
            genero: $('#bookGenre').val()
        };

        const url = bookId ? `/biblioteca/livro/${bookId}` : '{{ route("livro.store") }}';
        const method = bookId ? 'PUT' : 'POST';

        $.ajax({
            url,
            method,
            data: bookData,
            success: function(response) {
                toastr.success(bookId ? "Livro atualizado com sucesso!" : "Livro criado com sucesso!");
                hideModal();
                setTimeout(() => window.location.reload(), 800);
            },
            error: function(xhr) {
                handleError("Erro ao salvar o livro.");
            }
        });
    };

    const editBook = (livroId) => {
        $.ajax({
            url: `/biblioteca/livro/${livroId}/edit`,
            method: 'GET',
            success: function(response) {
                $('#bookId').val(response.id);
                $('#bookTitle').val(response.nome);
                $('#bookAuthor').val(response.autor);
                $('#bookRegistration').val(response.numero_registro);
                $('#bookGenre').val(response.genero);
                showModal();
            },
            error: function() {
                handleError("Erro ao carregar os dados do livro.");
            }
        });
    };

    const deleteBook = (livroId) => {
        $('#confirmationToast').toast({ autohide: false }).toast('show');

        $(document).off('click', '.confirmDelete').on('click', '.confirmDelete', function() {
            $.ajax({
                url: `/biblioteca/livro/${livroId}`,
                method: 'DELETE',
                success: function(response) {
                    toastr.success(response.success);
                    setTimeout(() => window.location.reload(), 800);
                },
                error: function() {
                    handleError("Erro ao excluir o livro.");
                }
            });

            $('#confirmationToast').toast('hide');
        });

        $(document).off('click', '.cancelDelete').on('click', '.cancelDelete', function() {
            $('#confirmationToast').toast('hide');
        });
    };

    $(document).on('click', '.editBook', function() {
        editBook($(this).data('id'));
    });

    $(document).on('click', '#newBook, [data-bs-target="#bookModal"]', function(e) {
        e.preventDefault();
        clearModal();
        showModal();
    });

    $(document).on('click', '.cancelEdit, [data-bs-dismiss="modal"]', function(e) {
        e.preventDefault();
        hideModal();
    });

    $(document).on('click', '.deleteBook', function() {
        deleteBook($(this).data('id'));
    });

    $('#saveBook').click(saveBook);

    $('#bookModal').on('hidden.bs.modal', clearModal);
});