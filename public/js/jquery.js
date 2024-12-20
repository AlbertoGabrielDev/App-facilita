$(document).ready(function () {
    $('.toggle-ativacao').click(function () {
        var button = $(this);
        var usuarioId = button.data('id');
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '/biblioteca/usuario/status/' + usuarioId,
            method: 'POST',
            data: {
                _token: csrfToken,
                _method: 'POST'
            },
            success: function (response) {
                if (response.status === 1) {
                    button.text('Inativar')
                        .removeClass('btn-success')
                        .addClass('btn-danger');
                } else {
                    button.text('Ativar')
                        .removeClass('btn-danger')
                        .addClass('btn-success');
                }
            },
            error: function (xhr, status, error) {
                console.error('Erro ao mudar o status do usuário:', error);
                alert('Ocorreu um erro ao tentar alterar o status do usuário.');
            }
        });
    });
});
