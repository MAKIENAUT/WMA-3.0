const navLinkContainer = document.getElementById('navbarLinkContainer');
const navMobileIcon = document.getElementById('navbarMobileIcon');

function toggleNavbar() {
   navLinkContainer.classList.toggle('active');
}

document.addEventListener('click', function (event) {
   if (
      !navLinkContainer.contains(event.target) &&
      event.target !== navMobileIcon
   ) {
      navLinkContainer.classList.remove('active');
   }
});

// document.addEventListener('click', function (e) {
//    console.log(e.target);
// })