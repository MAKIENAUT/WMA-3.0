document.addEventListener('DOMContentLoaded', function () {
   const zoomableImages = document.querySelectorAll('.zoomable');

   zoomableImages.forEach(function (image) {
      image.addEventListener('dblclick', function () {
         image.classList.toggle('zoomed');
      });
   });
});