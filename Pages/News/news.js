$(document).ready(function () {
   $('.like-button').on('click', function () {
      var action = $(this).data('action');
      var content_id = $(this).data('content-id');
      var likeButton = $(this);

      $.ajax({
         type: 'POST',
         url: 'ajax_like.php',
         data: { action: action, content_id: content_id },
         success: function (data) {
            if (action == 'like') {
               likeButton.data('action', 'unlike').text('unlike');
            } else {
               likeButton.data('action', 'like').text('like');
            }

            // Update like count on the page (if applicable)
            var likeCountElement = likeButton.closest('div').find('.like-count');
            var currentLikeCount = parseInt(likeCountElement.text());
            likeCountElement.text(action == 'like' ? currentLikeCount + 1 : currentLikeCount - 1);
         }
      });
   });
});