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
   <link rel="stylesheet" href="/Pages/Global/global.css" />
   <link rel="icon" type="image/x-icon" href="/Photos/WMA.png">
   <script defer src="/Pages/Global/global.js"></script>
   <title>WMA Home</title>
</head>

<body>
   <!-- NAV SECTION -->
   <?php
   require_once "../Global/navbar.php";
   ?>

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
                     <a href="/Pages/Process/study-and-exchange.php" class="service-content-description-button">Learn
                        more</a>
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
                     <a href="/Pages/Process/family-based.php" class="service-content-description-button">Learn more</a>
                  </div>
               </article>
               <article class="service-content">
                  <div class="service-content-header">
                     <img src="/Photos/employee.jpg" alt="Study and exchange image">
                  </div>
                  <div class="service-content-description">
                     <h1>Temporary Employment</h1>
                     <p>We also offer temporary employment services , which can be an excellent option for individuals
                        looking to gain work experience, explore new industries, or earn extra income. Our team works
                        with employers across various industries to provide opportunities for our clients. We take the
                        time to understand your skills and career goals to match you with the right temporary job.</p>
                     <a href="/Pages/Process/temporary-employment.php" class="service-content-description-button">Learn
                        more</a>
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
   <?php
   require_once "../Global/footer.php";
   ?>
</body>

</html>