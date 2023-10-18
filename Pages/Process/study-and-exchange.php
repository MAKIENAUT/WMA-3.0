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

   <link rel="stylesheet" href="study-and-exchange.css" />
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
            <a class="navbar-logo" href="/Pages/Home/home.php">
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
                  <a class="navbar-category-link" href="/Pages/Process/family-based.php">Family Based</a>
                  <a class="navbar-category-link" href="/Pages/Process/study-and-exchange.php">Study and Exchange</a>
                  <a class="navbar-category-link" href="/Pages/Process/temporary-employment.php">Temporary
                     Employment</a>
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
            <a class="navbar-link" href="/Pages/About-us/about.php">About Us</a>
            <a class="navbar-link" href="#">Login/Sign up</a>
         </div>
      </div>
   </nav>

   <!-- MAIN SECTION -->
   <main>
      <!-- PROCESS HEADER SECTION -->
      <header class="header-parent">
         <div class="header-container">
            <div class="header-content">
               <h1>Process of <span>J1</span></h1>
            </div>
         </div>
      </header>

      <!-- PROCESS STEPS SECTION -->
      <article class="steps-parent">
         <div class="steps-container">
            <div class="steps-content">
               <div class="steps-header">
                  <p>How to Apply?</p>
                  <h1>FOLLOW THESE STEPS!</h1>

               </div>
               <div class="steps-description">
                  <div class="steps-card">
                     <div class="steps-card-header">
                        <h1>01</h1>
                        <h1>FIND A <br>J1 PROGRAM SPONSOR</h1>
                     </div>
                     <p>The first step in obtaining a J1 visa is to identify a J1 program sponsor. The program sponsor
                        is responsible for issuing the DS-2019 form, which is required to apply for the J1 visa.</p>
                  </div>
                  <div class="steps-card">
                     <div class="steps-card-header">
                        <h1>02</h1>
                        <h1>SUBMIT AN APPLICATION</h1>
                     </div>
                     <p>Once you have identified a J1 program sponsor, you will need to submit an application to
                        participate in the program. The application process will vary depending on the specific program,
                        but typically involves submitting personal information, academic transcripts, and a statement of
                        purpose.</p>
                  </div>
                  <div class="steps-card">
                     <div class="steps-card-header">
                        <h1>03</h1>
                        <h1>RECEIVE THE <br>DS-2019 FORM</h1>
                     </div>
                     <p>After your application has been approved, the program sponsor will issue the DS-2019 form. This
                        form is required to apply for the J1 visa.</p>
                  </div>
                  <div class="steps-card">
                     <div class="steps-card-header">
                        <h1>04</h1>
                        <h1>PAY THE SEVIS FEE</h1>
                     </div>
                     <p>Before you can apply for the J1 visa, you must pay the SEVIS fee. This fee supports the Student
                        and Exchange Visitor Program, which manages student and exchange visitor information in the
                        United States.</p>
                  </div>
                  <div class="steps-card">
                     <div class="steps-card-header">
                        <h1>05</h1>
                        <h1>APPLY FOR THE <br>J1 VISA</h1>
                     </div>
                     <p>Once you have received the DS-2019 form and paid the SEVIS fee, you can apply for the J1 visa at
                        a U.S. embassy or consulate in your home country. The application process typically involves
                        submitting the DS-2019 form, a completed visa application form, and any other required
                        documents.</p>
                  </div>
                  <div class="steps-card">
                     <div class="steps-card-header">
                        <h1>06</h1>
                        <h1>ATTEND A VISA INTERVIEW</h1>
                     </div>
                     <p>After submitting your application, you will be required to attend a visa interview at the U.S.
                        embassy or consulate. During the interview, a consular officer will ask you questions about your
                        program, your background, and your intentions for visiting the United States.
                     </p>
                  </div>
                  <div class="steps-card">
                     <div class="steps-card-header">
                        <h1>07</h1>
                        <h1>RECEIVE THE <br>J1 VISA</h1>
                     </div>
                     <p>If your visa application is approved, you will receive the J1 visa in your passport. The visa
                        will specify the duration of your stay in the United States, which will be determined by the
                        length of your J1 program.
                     </p>
                  </div>
               </div>
               <div class="steps-conclusion">
                  <p>Overall, the process of obtaining a J1 visa can take several weeks or months, so it is important to
                     plan ahead and start the application process early. Working with an experienced J1 program sponsor
                     and preparing thoroughly for the visa interview can help ensure a smooth and successful application
                     process.</p>

               </div>
               <div class="link">
                  <a href="#">Learn More</a>
               </div>
            </div>
         </div>
         </div>
      </article>
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
                  <a href="/Pages/About-us/about.php">About us</a>
                  <a href="#">Specialization</a>
               </div>
            </section>
            <section class="footer-process">
               <h1>Process</h1>
               <div class="footer-more-info-content">
                  <a href="/Pages/Process/family-based.php">Family Based</a>
                  <a href="/Pages/Process/study-and-exchange.php">Study and Exchange</a>
                  <a href="/Pages/Process/temporary-employment.php">Temporary Employment</a>
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
                  <a href="https://www.facebook.com/WestMigration" class="fa-brands fa-facebook"></a>
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