$(document).ready(function() {
    $('.like-button').on('click', function() {
        var post_id = $(this).data('post-id');
        var likeCountElement = $(this).find('.like-number');
        var currentLikeCount = parseInt(likeCountElement.text()) || 0;

        // Send an AJAX request to update likes on the server
        $.ajax({
            type: 'POST',
            url: 'like_post.php', // Replace with the correct URL
            data: {
                action: 'like',
                post_id: post_id
            },
            success: function(response) {
                console.log(response);

                try {
                    var result = JSON.parse(response);
                    if (result.success) {
                        // Successful update on the server side
                        currentLikeCount = result.new_like_count; // Ensure the server returns the new count
                        likeCountElement.text(currentLikeCount);
                    } else {
                        // Show server error message if any
                        alert('Error: ' + result.message);
                    }
                } catch (error) {
                    console.log(error.response);
                    console.error('Error parsing JSON response:', error);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    });
});
