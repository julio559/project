<script type="text/javascript">
$('.like__btn').on('click', function(){
        // AJAX call goes to our endpoint url
        $.ajax({
            url: 'http://192.168.1.8/p-test/wp-json/example/v2/likes/7',
            type: 'post',
            success: function() {
                console.log('works!');
             },
             error: function() {
                console.log('failed!');
              }
          });
        
        // Change the like number in the HTML to add 1
        var updated_likes = parseInt($('.like__number').html()) + 1;

        $('.like__number').html(updated_likes);
        // Make the button disabled
        $(this).attr('disabled', true);
    });
</script>