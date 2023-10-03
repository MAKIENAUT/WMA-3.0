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

   <link rel="stylesheet" href="family-based.css" />
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
                  <a class="navbar-category-link" href="#">Other Uploads</a>
               </div>
            </div>
            <a class="navbar-link" href="#">About Us</a>
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
               <h1>Process of Family-Based</h1>
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
                  <p>It's crucial to research and understand the specific family-based immigration policies of the
                     Western country you are interested in, as they can vary significantly. Additionally,
                     immigration policies in these countries may change over time due to evolving political and
                     social factors.</p>
               </div>
               <div class="steps-description">
                  <div class="steps-card">
                     <div class="steps-card-header">
                        <h1>01</h1>
                        <h1>DETERMINE ELIGIBILITY</h1>
                     </div>
                     <p>The first step in the family-based immigration process is to determine if you are eligible to
                        apply. Generally, U.S. citizens and lawful permanent residents can petition for certain
                        family members to immigrate to the United States.</p>
                  </div>
                  <div class="steps-card">
                     <div class="steps-card-header">
                        <h1>02</h1>
                        <h1>FILE FORM I-30</h1>
                     </div>
                     <p>Once you have determined your eligibility, the next step is to file Form I-130, Petition for
                        Alien Relative, with U.S. Citizenship and Immigration Services (USCIS). This form establishes
                        the relationship between the petitioner and the intending immigrant and serves as the first
                        step in the immigration process.</p>
                  </div>
                  <div class="steps-card">
                     <div class="steps-card-header">
                        <h1>03</h1>
                        <h1>WAIT FOR PROCESSING</h1>
                     </div>
                     <p>After submitting the Form I-130, you will need to wait for USCIS to process the petition. The
                        processing time can vary depending on the complexity of the case and the volume of petitions
                        being processed.</p>
                  </div>
                  <div class="steps-card">
                     <div class="steps-card-header">
                        <h1>04</h1>
                        <h1>FILE FORM I-485</h1>
                     </div>
                     <p>Once the Form I-130 is approved, the intending immigrant can file Form I-485, Application to
                        Register Permanent Residence or Adjust Status, if they are already in the United States. If
                        the intending immigrant is outside the United States, they will need to apply for an
                        immigrant visa at a U.S. embassy or consulate.</p>
                  </div>
                  <div class="steps-card">
                     <div class="steps-card-header">
                        <h1>05</h1>
                        <h1>ATTEND A VISA INTERVIEW</h1>
                     </div>
                     <p>If the intending immigrant is applying for an immigrant visa at a U.S. embassy or consulate,
                        they will be required to attend a visa interview. During the interview, a consular officer
                        will ask questions about the relationship between the petitioner and the intending immigrant,
                        as well as other aspects of the immigrant's background.</p>
                  </div>
                  <div class="steps-card">
                     <div class="steps-card-header">
                        <h1>06</h1>
                        <h1>RECEIVE A GREEN CARD</h1>
                     </div>
                     <p>If the immigrant visa application is approved, the intending immigrant will receive a green
                        card, which grants them permanent residence in the United States. If the intending immigrant
                        filed Form I-485, they will receive the green card after their application is approved.
                     </p>
                  </div>
               </div>
               <div class="steps-conclusion">
                     <p>Overall, the family-based immigration process can be complex and time-consuming. It is important to work with an experienced immigration attorney and prepare thoroughly for the visa interview to ensure a smooth and successful application process.</p>
                     
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