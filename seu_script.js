$(document).ready(function() {
    $('.like-button').on('click', function() {
        var post_id = $(this).data('post-id');
        var likeCountElement = $(this).find('.like-number');
        var currentLikeCount = parseInt(likeCountElement.text()) || 0;

        // Envie uma solicitação AJAX para atualizar as curtidas no servidor
        $.ajax({
            type: 'POST',
            url: 'like_post.php', // Substitua por sua URL correta
            data: {
                action: 'like',
                post_id: post_id
            },
            success: function(response) {
                console.log(response)

                try {
                  
                    var result = JSON.parse(response);
                    if (result.success) {
                        // Atualização bem-sucedida no lado do servidor
                        currentLikeCount = result.like_count;
                        likeCountElement.text(currentLikeCount);
                    } else {
                        // Exibir mensagem de erro do servidor, se houver
                        alert('Erro: ' + result.message);
                    }
                } catch (error) {
                    console.log(error.response)
                    console.error('Erro ao analisar a resposta JSON:', error);
                }
            },
            error: function(xhr, status, error) {
                console.error('Erro AJAX:', status, error);
            }
        });
    });
});
