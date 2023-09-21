<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />

   <!-- FontAwesome -->
   <link rel="stylesheet" crossorigin="anonymous" referrerpolicy="no-referrer"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
      integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" />
   <!-- FontAwesome -->

   <script defer src="template.js"></script>
   <link rel="stylesheet" href="template.css" />
   <title>Template for WMA</title>
</head>

<body>
   <!-- NAV SECTION -->
   <nav class="navbar-parent">
      <div class="navbar-container">
         <div class="navbar-main-container">
            <a class="navbar-logo" href="#">
               <img src="" alt="Logo" />
            </a>
            <button id="navbarMobileIcon" class="navbar-mobile-icon fa fa-bars burger-icon" onclick="toggleNavbar()">
            </button>
         </div>
         <div id="navbarLinkContainer" class="navbar-link-container">
            <a class="navbar-link" href="#">Link</a>
            <a class="navbar-link" href="#">Link</a>
            <a class="navbar-link" href="#">Link</a>
            <a class="navbar-link" href="#">Link</a>
            <a class="navbar-link" href="#">Link</a>
         </div>
      </div>
   </nav>

   <!-- MAIN SECTION -->
   <main>
      <!-- HERO SECTION -->
      <section class="hero-parent">
         <header class="hero-container">
            <div class="hero-content">
               <h1>Hero Header</h1>
            </div>
         </header>
      </section>

      <!-- SAMPLE SECTION -->
      <section class="sample-parent">
         <header class="header-parent">
            <div class="header-content">
               <h1>Section Header</h1>
            </div>
         </header>
         <article class="article-parent">
            <div class="article-content">
               <h3>Article header</h3>
               <p>asdiofqwpreudkaslfj;asdl;kfjasdifuewporiu</p>
            </div>
         </article>
      </section>
   </main>

   <!-- FOOTER SECTION -->
   <footer class="footer-parent">
      <section class="footer-content">
         <div class="footer-page-links">
            <a href="/Pages/About us/about.html">About Us</a>
            <a href="/Pages/Contact us/contact.html">Contact us</a>
         </div>
         <div class="footer-social-links">
            <p>Our social links</p>
            <div class="footer-socials">
               <a href="https://www.facebook.com/messages/t/251334478355904"><i
                     class="fa-brands fa-facebook-messenger"></i></a>
               <a href="https://www.facebook.com/AthenaTravelToursAndEvents"><i class="fa-brands fa-facebook"></i></a>
               <a href="https://instagram.com/athenatravelmaria?igshid=MzRlODBiNWFlZA=="><i
                     class="fa-brands fa-instagram"></i></a>
               <a href="https://www.tiktok.com/@athenatravelandtours?_t=8fcQ5NdiuZt&_r=1"><i
                     class="fa-brands fa-tiktok"></i></a>
            </div>
         </div>
      </section>
      <section class="copyright">
         <p>Copyright 2023</p>
      </section>
   </footer>
</body>

</html>