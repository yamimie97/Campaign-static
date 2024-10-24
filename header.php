<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <!--Navigation bar section-->
  <header>
    <input type="checkbox" id="toggler">
    <label for="toggler" class="fa-solid fa-bars" style="color: var(--black);"></label>

    <a href="#" class="logo">SMC<span>.</span></a>
    <nav class="navigationbar">
      <a href="Home.php" <?php if(basename($_SERVER['PHP_SELF']) == 'Home.php') echo 'class="active"'; ?>>Home</a>
      <a href="Information.php" <?php if(basename($_SERVER['PHP_SELF']) == 'Information.php') echo 'class="active"'; ?>>Information</a>
      <a href="Mostpopularsocialmediaapps.php" <?php if(basename($_SERVER['PHP_SELF']) == 'Mostpopularsocialmediaapps.php') echo 'class="active"'; ?>>Most Popular Social Media Apps</a>
      <a href="HowParentsCanHelp.php" <?php if(basename($_SERVER['PHP_SELF']) == 'HowParentsCanHelp.php') echo 'class="active"'; ?>>How Parents Can Help</a>
      <a href="Livestreaming.php" <?php if(basename($_SERVER['PHP_SELF']) == 'Livestreaming.php') echo 'class="active"'; ?>>Livestreaming</a>
      <a href="Contact.php" <?php if(basename($_SERVER['PHP_SELF']) == 'Contact.php') echo 'class="active"'; ?>>Contact</a>
      <a href="LegislationAndGuidance.php" <?php if(basename($_SERVER['PHP_SELF']) == 'LegislationAndGuidance.php') echo 'class="active"'; ?>>Legislation & Guidance</a>
    </nav>
    <div class="icons">
      <?php
        if(isset($_SESSION['username'])) {
          // User is logged in
          echo '<div class="dropdown">';
            echo '<button class="dropbtn">Profile: </button>';
            echo '<div class="dropdown-content">';
              echo '<a href="#">Edit Profile</a>';
              echo '<a href="logout.php" onclick="return confirm(\'Are you sure you want to logout?\');">Logout</a>';
            echo '</div>';
          echo '</div>';
          echo '<span>' . $_SESSION['username'] . '</span>';
        } else {
          // User is not logged in
          echo '<div class="dropdown">';
            echo '<button class="dropbtn">Login</button>';
            echo '<div class="dropdown-content">';
              echo '<a href="login_form.php">Login</a>';
              echo '<a href="registration_form.php">Register</a>';
            echo '</div>';
          echo '</div>';
        }
      ?>
    </div>
    <div class="cursor"></div>
  </header>
  <section class="search-section">
    <form action='#' method='get'>
      <div class="admin-search">
        <div class="search-input">
          <label>
            <input type="text" name="keyword" placeholder="Search . . .">
            <ion-icon name="search-outline"></ion-icon>
          </label>
        </div>
        <div class="search-btn">
          <input type="submit" name="search" value="Search">
        </div>
        <div class="clear-btn">
          <?php
            $current_page = basename($_SERVER['PHP_SELF']);
            if ($current_page === 'Mostpopularsocialmediaapps.php') {
                echo '<div class="search-button">
                          <a href="Mostpopularsocialmediaapps.php">Clear</a>
                      </div>';
            }
          ?>
        </div>
       
      </div>  
      <div id="google_translate_element"></div>
    </form>
  </section>
  <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  <script>
    function googleTranslateElementInit() {
      new google.translate.TranslateElement(
        {pageLanguage: 'en'}, 'google_translate_element'
      );
    }
  </script>
  <script type="text/javascript">
    const cursor = document.querySelector(".cursor");
    document.addEventListener("mousemove", (e)=>{
      let x = e.pageX;
      let y = e.pageY;
      cursor.style.top = y + "px";
      cursor.style.left = x + "px";
      cursor.style.display = "block";

      function mouseStopped(){
        cursor.style.display = "none";
      }
      clearTimeout(timeout);
      timeout.setTimeout(mouseStopped, 1000);
    });
    document.addEventListener("mouseout",() =>{
      cursor.style.display = "none";
    });
  </script>
</body>
</html>