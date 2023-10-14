function applicant_search() {
   document.getElementById('searchbar').addEventListener('input', function () {
      var searchText = this.value.toLowerCase();
      var cards = document.querySelectorAll('.applicant_card');

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