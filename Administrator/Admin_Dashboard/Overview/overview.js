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


function showGraph() {
   var graphContainer = document.getElementById('chart_div');
   var cardContainer = document.querySelector('.user_card_container');
   var showGraph_Button = document.querySelector('.show_graph');

   var isGraphHidden = graphContainer.style.display === 'none';

   graphContainer.style.display = isGraphHidden ? 'flex' : 'none';
   cardContainer.style.display = isGraphHidden ? 'none' : 'flex';
   showGraph_Button.style.color = isGraphHidden ? 'gold' : 'white';
   showGraph_Button.innerHTML = isGraphHidden ? 'View Cards' : 'View Graph';
   showGraph_Button.style.border = isGraphHidden ? '1px solid teal' : '1px solid rgba(149, 149, 149, 0.8)';
}


function searchUsers() {
   var input, filter, cards, card, email, fullName, i, txtValue;
   input = document.getElementById('userSearch');
   filter = input.value.toUpperCase();
   cards = document.getElementsByClassName('user_cards');

   for (i = 0; i < cards.length; i++) {
      card = cards[i];
      email = card.getElementsByTagName('p')[0];
      fullName = card.getElementsByTagName('p')[1];
      txtValue = email.textContent || email.innerText;
      txtValue += fullName.textContent || fullName.innerText;

      if (txtValue.toUpperCase().indexOf(filter) > -1) {
         card.style.display = "";
      } else {
         card.style.display = "none";
      }
   }
}