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
                    console.error('Erro ao analisar a resposta JSON:', error);
                }
            },
            error: function(xhr, status, error) {
                console.error('Erro AJAX:', status, error);
            }
        });
    });

    // Lidar com o envio de comentários
    $('.comment-form').on('submit', function(event) {
        event.preventDefault(); // Evita o envio do formulário tradicional
        var post_id = $(this).data('post-id');
        var commentInput = $(this).find('.comment-input');
        var commentText = commentInput.val();

        // Envie uma solicitação AJAX para adicionar o comentário ao servidor
        $.ajax({
            type: 'POST',
            url: 'add_comment.php', // Substitua por sua URL correta
            data: {
                action: 'comment',
                post_id: post_id,
                comment_text: commentText
            },
            success: function(response) {
                try {
                    var result = JSON.parse(response);
                    if (result.success) {
                        // Comentário adicionado com sucesso, você pode atualizar a interface aqui
                        alert('Comentário adicionado com sucesso!');
                        commentInput.val(''); // Limpar o campo de comentário
                    } else {
                        // Exibir mensagem de erro do servidor, se houver
                        alert('Erro ao adicionar comentário: ' + result.message);
                    }
                } catch (error) {
                    console.error('Erro ao analisar a resposta JSON:', error);
                }
            },
            error: function(xhr, status, error) {
                console.error('Erro AJAX:', status, error);
            }
        });
    });

    // Lidar com a função "Salvar Post"
    $('.save-button').on('click', function() {
        var post_id = $(this).data('post-id');

        // Envie uma solicitação AJAX para salvar o post no servidor
        $.ajax({
            type: 'POST',
            url: 'dashboard.php', // Substitua por sua URL correta
            data: {
                action: 'save',
                post_id: post_id
            },
            success: function(response) {
                try {
                    var result = JSON.parse(response);
                    if (result.success) {
                        // Post salvo com sucesso, você pode atualizar a interface aqui
                        alert('Post salvo com sucesso!');
                    } else {
                        // Exibir mensagem de erro do servidor, se houver
                        alert('Erro ao salvar o post: ' + result.message);
                    }
                } catch (error) {
                    console.error('Erro ao analisar a resposta JSON:', error);
                }
            },
            error: function(xhr, status, error) {
                console.error('Erro AJAX:', status, error);
            }
        });
    });
});
