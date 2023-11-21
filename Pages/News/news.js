function filter_content(category) {
   const postCards = document.querySelectorAll('.post_card');

   postCards.forEach(card => {
      const cardCategory = card.getAttribute('data-category');
      if (category === 'all' || category === cardCategory) {
         card.classList.add('active');
      } else {
         card.classList.remove('active');
      }
   });
}

function toggleExcerpt(contentId) {
   var excerptContainer = $('#excerptContainer_' + contentId);
   var fullExcerptContainer = $('#fullExcerptContainer_' + contentId);

   excerptContainer.hide();
   fullExcerptContainer.show();
}

function collapseExcerpt(contentId) {
   var excerptContainer = $('#excerptContainer_' + contentId);
   var fullExcerptContainer = $('#fullExcerptContainer_' + contentId);

   excerptContainer.show();
   fullExcerptContainer.hide();
}

function featuredToggleExcerpt(contentId) {
   var excerptContainer = $('#featuredExcerptContainer_' + contentId);
   var fullExcerptContainer = $('#featuredFullExcerptContainer_' + contentId);

   excerptContainer.hide();
   fullExcerptContainer.show();
}

function featuredCollapseExcerpt(contentId) {
   var excerptContainer = $('#featuredExcerptContainer_' + contentId);
   var fullExcerptContainer = $('#featuredFullExcerptContainer_' + contentId);

   excerptContainer.show();
   fullExcerptContainer.hide();
}

function content_search() {
   document.getElementById('searchbar').addEventListener('input', function () {
      var searchText = this.value.toLowerCase();
      var cards = document.querySelectorAll('.post_card');

      cards.forEach(function (card) {
         var searchableText = card.getAttribute('data-search').toLowerCase();
         if (searchableText.includes(searchText)) {
            card.style.display = 'flex';
         } else {
            card.style.display = 'none';
         }
      });
   });
}

$(document).ready(function () {
   $('.like-button').on('click', function () {
      var likeButton = $(this);
      var action = likeButton.data('action');
      var content_id = likeButton.data('content-id');

      $.ajax({
         type: 'POST',
         url: 'ajax_like.php',
         data: { action: action, content_id: content_id },
         success: function (data) {
            var likeCountElement = likeButton.closest('.interaction_info').find('.like-count');
            var currentLikeCount = parseInt(likeCountElement.text());

            if (action == 'like') {
               likeButton.find('i').removeClass('fa-regular fa-heart').addClass('fa-solid fa-heart').css('color', 'red');
               likeButton.data('action', 'unlike');
               likeCountElement.text(currentLikeCount + 1);
            } else {
               likeButton.find('i').removeClass('fa-solid fa-heart').addClass('fa-regular fa-heart').css('color', '');
               likeButton.data('action', 'like');
               likeCountElement.text(Math.max(0, currentLikeCount - 1));
            }
         }
      });
   });
});


