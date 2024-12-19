$(document).ready(function() {
    console.log('fffdfdfdfdfdfdf')
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Função para limpar os campos do modal
    function clearModal() {
        console.log("Limpar os campos do modal...");
        $('#bookId').val('');
        $('#bookTitle').val('');
        $('#bookAuthor').val('');
        $('#bookRegistration').val('');
        $('#bookGenre').val('');
        console.log("Campos limpos.");
    }

    // Evento de click no botão de editar livro
    $(document).on('click', '.editBook', function() {
        var livroId = $(this).data('id');
        console.log("Editando livro com ID:", livroId);

        // Limpar o modal antes de carregar os dados para evitar dados antigos
        clearModal();

        $.ajax({
            url: '/biblioteca/livro/' + livroId + '/edit',
            method: 'GET',
            success: function(response) {
                console.log("Dados recebidos para editar:", response);
                $('#bookId').val(response.id);
                $('#bookTitle').val(response.nome);
                $('#bookAuthor').val(response.autor);
                $('#bookRegistration').val(response.numero_registro);
                $('#bookGenre').val(response.genero);
                $('#bookModal').modal('show');
                console.log("Modal aberto para edição com dados do livro:", response);
            },
            error: function(xhr) {
                console.error("Erro ao carregar os dados do livro:", xhr);
                toastr.error("Erro ao carregar os dados do livro.");
            }
        });
    });

    // Evento de click no botão de excluir livro
    $(document).on('click', '.deleteBook', function() {
        var livroId = $(this).data('id');
        console.log("Excluindo livro com ID:", livroId);

        $('#confirmationToast').toast({
            autohide: false
        }).toast('show');

        $(document).on('click', '.confirmDelete', function() {
            console.log("Confirmando exclusão de livro com ID:", livroId);

            $.ajax({
                url: '/biblioteca/livro/' + livroId,
                method: 'DELETE',
                success: function(response) {
                    console.log("Livro excluído com sucesso:", response);
                    toastr.success(response.success);
                    setTimeout(function() {
                        window.location.reload();
                    }, 800);
                },
                error: function(xhr) {
                    console.error("Erro ao excluir o livro:", xhr);
                    toastr.error("Erro ao excluir o livro.");
                }
            });

            $('#confirmationToast').toast('hide');
        });

        $(document).on('click', '.cancelDelete', function() {
            $('#confirmationToast').toast('hide');
        });
    });

    // Evento de click para salvar o livro
    $('#saveBook').click(function(e) {
        e.preventDefault();

        var bookId = $('#bookId').val();
        var bookData = {
            nome: $('#bookTitle').val(),
            autor: $('#bookAuthor').val(),
            numero_registro: $('#bookRegistration').val(),
            genero: $('#bookGenre').val()
        };

        console.log("Dados do livro a serem salvos:", bookData);
        var url = bookId ? '/biblioteca/livro/' + bookId : '{{ route("livro.store") }}';
        var method = bookId ? 'PUT' : 'POST';

        $.ajax({
            url: url,
            method: method,
            data: bookData,
            success: function(response) {
                console.log("Resposta do servidor após salvar livro:", response);
                toastr.success(bookId ? "Livro atualizado com sucesso!" : "Livro criado com sucesso!");
                console.log('fffffffffffffff')
                $('#bookModal').modal('hide');
                setTimeout(function() {
                    window.location.reload();
                }, 800);
            },
            error: function(xhr) {
                console.error("Erro ao salvar livro:", xhr);
                toastr.error("Erro: " + xhr.responseJSON.message);
            }
        });
    });

    // Evento de click no botão de "Novo Livro" para limpar o modal
    $(document).on('click', '#newBook', function() {
        console.log("Abrindo modal para novo livro...");
        clearModal();
        $('#bookModal').modal('show');
    });

    // Limpando os campos do modal sempre que ele for fechado
    $('#bookModal').on('hidden.bs.modal', function () {
        console.log("Modal fechado, limpando campos...");
        clearModal();
    });

    // Garantir que ao cancelar a edição o modal seja fechado e limpo
    $(document).on('click', '.cancelEdit', function() {
        console.log("Cancelando edição do livro...");
        $('#bookModal').modal('hide');
        clearModal();
    });
});
