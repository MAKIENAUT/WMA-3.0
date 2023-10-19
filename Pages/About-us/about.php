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

   <link rel="stylesheet" href="about.css" />
   <link rel="stylesheet" href="/Pages/Global//global.css" />
   <link rel="icon" type="image/x-icon" href="/Photos/WMA.png">
   <script defer src="/Pages/Global/global.js"></script>
   <title>About Us</title>
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
               <h1>About Us</h1>
            </div>
         </div>
      </section>

      <!-- ABOUT SECTION -->
      <section class="about-parent">
         <div class="about-container">
            <div class="about-content">
               <p>Welcome to our employment agency! (West Migration Agency “WMA”).</p>
               <p>We are dedicated to providing high-quality services to help individuals achieve their career goals
                  and
                  reunite with loved ones.Our agency offers various services, including study and exchange programs,
                  family-based petitions, and temporary employment.</p>
               <p>At West Migration Agency, we believe in providing exceptional service and personalized support to
                  help
                  our clients achieve their goals. We understand that each individual has unique needs and circumstances
                  and are committed to delivering tailored solutions to meet those needs. Contact us today to learn how
                  we can help you with your study and exchange program, family-based petition, or temporary employment
                  needs.</p>
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