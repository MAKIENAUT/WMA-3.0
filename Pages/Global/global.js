const navLinkContainer = document.getElementById('navbarLinkContainer');
const navMobileIcon = document.getElementById('navbarMobileIcon');
const navCategoryContainer = document.getElementById('navbarCategoryContainer');
const navCategoryContainer2 = document.getElementById('navbarCategoryContainer2');
const navCategory = document.getElementById("navbarCategory");
const navCategory2 = document.getElementById("navbarCategory2");

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

function toggleCategory() {
   navCategory.classList.toggle('active');
   navCategoryContainer.classList.toggle('active');
}

function toggleCategory2() {
   navCategory2.classList.toggle('active');
   navCategoryContainer2.classList.toggle('active');
}

document.addEventListener('click', function (event) {
   if (
      !navCategoryContainer.contains(event.target) &&
      event.target !== navCategory
   ) {
      navCategoryContainer.classList.remove('active');
      navCategory.classList.remove('active');
   }
});

document.addEventListener('click', function (event) {
   if (
      !navCategoryContainer2.contains(event.target) &&
      event.target !== navCategory2
   ) {
      navCategoryContainer2.classList.remove('active');
      navCategory2.classList.remove('active');
   }
});

// document.addEventListener('click', function (e) {
//    console.log(e.target);
// })