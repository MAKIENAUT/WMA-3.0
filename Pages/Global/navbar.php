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