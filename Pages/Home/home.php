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
   <link rel="icon" type="image/x-icon" href="/Photos/WMA.png">
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
               </div>
            </div>
            <a class="navbar-link" href="#">About Us</a>
            <a class="navbar-link" href="#">Login/Sign up</a>
         </div>
      </div>
   </nav>

   <!-- MAIN SECTION -->
   <main>
      <!-- HERO SECTION -->
      <section class="hero-parent">
         <div class="hero-container">
            <div class="hero-content">
               <h1>Venture West: <span>Where Dreams Take Flight</span></h1>
               <p>
                  Welcome to our employment agency! (West Migration Agency “
                  WMA”). We are dedicated to providing high-quality services to
                  help individuals achieve their career goals and reunite with
                  loved ones. Our agency offers various services, including study
                  and exchange programs, family-based petitions, and temporary
                  employment.
               </p>
            </div>
         </div>
      </section>

      <!-- SERVICE SECTION -->
      <section class="service-parent">
         <div class="service-container">
            <header class="service-header">
               <h1>Services Offered</h1>
            </header>
            <div class="service-content-container">
               <article class="service-content">
                  <div class="service-content-header">
                     <img src="/Photos/student.jpg" alt="Study and exchange image">
                  </div>
                  <div class="service-content-description">
                     <h1>Study And Exchange</h1>
                     <p>Our study and exchange programs offer excellent opportunities for those looking to further their
                        education or gain international experience. We work with top universities and institutions
                        worldwide
                        to provide our clients with access to high-quality educational programs. In addition, we work
                        with
                        different school districts across the United States that partner with visa sponsors. Our team is
                        committed to helping you find the program that best suits your needs and supports you throughout
                        the
                        application process.</p>
                     <a href="#" class="service-content-description-button">Learn more</a>
                  </div>
               </article>
               <article class="service-content">
                  <div class="service-content-header">
                     <img src="/Photos/famBased.jpg" alt="Study and exchange image">
                  </div>
                  <div class="service-content-description">
                     <h1>Family Based</h1>
                     <p>Family is important to us, and we understand the challenges of family-based petitions. That's
                        why we offer a personalized approach to help reunite families. Our experienced team will guide
                        you through the process, from filing the petition to preparing for the interview. We understand
                        the emotional, and legal complexities involved and are here to support you every step of the
                        way.</p>
                     <a href="#" class="service-content-description-button">Learn more</a>
                  </div>
               </article>
               <article class="service-content">
                  <div class="service-content-header">
                     <img src="/Photos/h2a.jpg" alt="Study and exchange image">
                  </div>
                  <div class="service-content-description">
                     <h1>Temporary Employment</h1>
                     <p>We also offer temporary employment services , which can be an excellent option for individuals
                        looking to gain work experience, explore new industries, or earn extra income. Our team works
                        with employers across various industries to provide opportunities for our clients. We take the
                        time to understand your skills and career goals to match you with the right temporary job.</p>
                     <a href="#" class="service-content-description-button">Learn more</a>
                  </div>
               </article>
            </div>
         </div>
      </section>

      <!-- STATEMENT SECTION -->
      <section class="statement-parent">
         <div class="statement-container">
            <div class="statement-content">
               <h3>
                  At West Migration Agency, we believe in <span>providing exceptional service
                     and personalized support</span> to help our clients achieve their goals. We
                  understand that each individual has unique needs and circumstances and
                  are committed to delivering tailored solutions to meet those needs.
                  Contact us today to learn how we can help you with your study and
                  exchange program, family-based petition, or temporary employment
                  needs.
               </h3>
            </div>
         </div>
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
               <div class="footer-more-info-content">
                  <a href="#">About us</a>
                  <a href="#">Specialization</a>
               </div>
            </section>
            <section class="footer-process">
               <h1>Process</h1>
               <div class="footer-more-info-content">
                  <a href="#">Family Based</a>
                  <a href="#">Study and Exchange</a>
                  <a href="#">Temporary Employment</a>
               </div>
            </section>
            <section class="footer-links">
               <h1>More Info</h1>
               <div class="footer-more-info-content">
                  <a href="#">News</a>
                  <a href="#">Contact us</a>
                  <a href="#">Administrator</a>
               </div>
            </section>
            <section class="footer-socials">
               <h1>Our Social Links</h1>
               <div class="social-content">
                  <a href="#" class="fa-brands fa-facebook"></a>
                  <a href="#" class="fa-brands fa-instagram"></a>
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