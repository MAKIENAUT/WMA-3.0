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

   <link rel="stylesheet" href="home.css" />
   <link rel="stylesheet" href="/Pages/Global//global.css" />
   <script defer src="/Pages/Global/global.js"></script>
   <title>WMA Home</title>
</head>

<body>
   <!-- NAV SECTION -->
   <nav class="navbar-parent">
      <div class="navbar-container">
         <div class="navbar-main-container">
            <a class="navbar-logo" href="#">
               <img src="/Photos/wma-logo.png" alt="WMA Logo" />
            </a>
            <button id="navbarMobileIcon" class="navbar-mobile-icon fa fa-bars burger-icon" onclick="toggleNavbar()">
            </button>
         </div>
         <div id="navbarLinkContainer" class="navbar-link-container">
            <a class="navbar-link" href="#">News</a>
            <div class="navbar-category-container" href="javascript:void(0)">
               <p id="navbarCategoryContainer" onclick="toggleCategory()">Process<i class="fa-solid fa-caret-down"></i>
               </p>
               <div id="navbarCategory" class="navbar-category">
                  <a class="navbar-category-link" href="#">Family Based</a>
                  <a class="navbar-category-link" href="#">Study and Exchange</a>
                  <a class="navbar-category-link" href="#">Temporary Employment</a>
               </div>
            </div>
            <div class="navbar-category-container" href="javascript:void(0)">
               <p id="navbarCategoryContainer2" onclick="toggleCategory2()">Categories<i
                     class="fa-solid fa-caret-down"></i></p>
               <div id="navbarCategory2" class="navbar-category">
                  <a class="navbar-category-link" href="#">Family Based</a>
                  <a class="navbar-category-link" href="#">Study and Exchange (J-1)</a>
                  <a class="navbar-category-link" href="#">Temporary Employment (EB-3/H2A)</a>
                  <a class="navbar-category-link" href="#">Other Uploads</a>
               </div>
            </div>
            <a class="navbar-link" href="#">About Us</a>
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
         <section class="footer-main-content">
            <section class="footer-disclaimer">
               <div class="disclaimer-content">
                  <img src="/Photos/wma-logo.png" alt="WMA logo">
                  <p>West Migration Agency LLC (“WMA”) is the parent company of West Migration Consultancy Inc.,(“WMC”)
                     based
                     in
                     the Philippines. WMC and its state affiliates advance the corporation's interest to engage in
                     immigration
                     consultancy by providing expert advice to prospective clients for the USA through qualification
                     assistance,
                     processing of applications, and other related documents. </p>
               </div>
               <div class="misc-photos">
                  <img src="/Photos/wmc-logo.png" alt="WMC logo">
                  <img src="/Photos/USCIS.svg" alt="USCIS logo">
               </div>
            </section>
            <section class="footer-info">
               <section class="footer-contact">
                  <h1>Contact us</h1>
                  <div class="contact-content">
                     <div class="contact-address">
                        <header><i class="fa-solid fa-location-dot"></i> Address:</header>
                        <div>3400 Cottage Way STE. G2 #11495 Sacramento, CA 95825</div>
                     </div>
                     <div class="contact-email">
                        <header><i class="fa-solid fa-envelope"></i> Email:</header>
                        <div>admin@westmigrationagency.us</div>
                     </div>
                     <div class="contact-number">
                        <header><i class="fa-solid fa-phone"></i> Phone:</header>
                        <div>415-633-6865</div>
                     </div>
                  </div>
               </section>
               <section class="footer-ph-office">
                  <h1>PH Office</h1>
                  <div class="contact-content">
                     <div class="contact-address">
                        <header><i class="fa-solid fa-location-dot"></i> Address (Cebu Branch):</header>
                        <div>11th Floor, AppleOne - Equicom Tower Mindanao Avenue, cor. Biliran St., Cebu Business Park,
                           Cebu
                           City 6000 Philippines</div>
                     </div>
                     <div class="contact-address">
                        <header><i class="fa-solid fa-location-dot"></i> Address (Dagupan Branch):</header>
                        <div>Upcoming!</div>
                     </div>
                  </div>
               </section>
            </section>
         </section>
         <section class="footer-more-info">
            <section class="about-us">
               <h1>About Us</h1>
               <a href="#">About us</a>
               <a href="#">Specialization</a>
            </section>
            <section class="footer-process">
               <h1>Process</h1>
               <a href="#">Family Based</a>
               <a href="#">Study and Exchange</a>
               <a href="#">Temporary Employment</a>
            </section>
            <section class="footer-links">
               <h1>More Info</h1>
               <a href="#">News</a>
               <a href="#">Contact us</a>
            </section>
            <section class="footer-socials">
               <h1>Our Social Links</h1>
               <div class="social-content">
                  <a href="#"><i class="fa-brands fa-facebook"></i></a>
                  <a href="#"><i class="fa-brands fa-instagram"></i></a>
               </div>
            </section>
         </section>
      </section>
      <section class="copyright">
         <p>Copyright 2023</p>
      </section>
   </footer>
</body>

</html>