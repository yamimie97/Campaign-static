<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
</head>
<body>
    <!--footer section-->
<footer class="footer">
  <div class="container">
    <div class="footer-row">
      <div class="footer-col">
        <h4>SMC</h4>
        <ul>
          <li><a href="Home.php" <?php if(basename($_SERVER['PHP_SELF']) == 'Home.php') echo 'class="active"'; ?>>Home<?php if(basename($_SERVER['PHP_SELF']) == 'Home.php') echo ' (HERE)';?></a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Terms & Conditions</h4>
        <ul>
          <li><a href="privacypolicy.php" <?php if(basename($_SERVER['PHP_SELF']) == 'privacypolicy.php') echo 'class="active"';?>>Privacy Policy<?php if(basename($_SERVER['PHP_SELF']) == 'privacypolicy.php') echo ' (HERE)';?></a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Categories</h4>
        <ul>
          <li><a href="Information.php" <?php if(basename($_SERVER['PHP_SELF']) == 'Information.php') echo 'class="active"';?>>Information<?php if(basename($_SERVER['PHP_SELF']) == 'Information.php') echo ' (HERE)';?></a></li>
          <li><a href="Mostpopularsocialmediaapps.php" <?php if(basename($_SERVER['PHP_SELF']) == 'Mostpopularsocialmediaapps.php') echo 'class="active"';?>>Most Popular Social Media Apps<?php if(basename($_SERVER['PHP_SELF']) == 'Mostpopularsocialmediaapps.php') echo ' (HERE)';?></a></li>
          <li><a href="HowParentsCanHelp.php" <?php if(basename($_SERVER['PHP_SELF']) == 'HowParentsCanHelp.php') echo 'class="active"';?>>How Parents Can Help<?php if(basename($_SERVER['PHP_SELF']) == 'HowParentsCanHelp.php') echo ' (HERE)'; ?></a></li>
          <li><a href="Livestreaming.php" <?php if(basename($_SERVER['PHP_SELF']) == 'Livestreaming.php') echo 'class="active"'; ?>>Livestreaming<?php if(basename($_SERVER['PHP_SELF']) == 'Livestreaming.php') echo ' (HERE)'; ?></a></li>
          <li><a href="Contact.php" <?php if(basename($_SERVER['PHP_SELF']) == 'Contact.php') echo 'class="active"'; ?>>Contact<?php if(basename($_SERVER['PHP_SELF']) == 'Contact.php') echo ' (HERE)'; ?></a></li>
          <li><a href="LegislationAndGuidance.php" <?php if(basename($_SERVER['PHP_SELF']) == 'LegislationAndGuidance.php') echo 'class="active"'; ?>>Legislation & Guidance<?php if(basename($_SERVER['PHP_SELF']) == 'LegislationAndGuidance.php') echo ' (HERE)';?></a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Follow us</h4>
        <div class="social-icons">
          <a href="https://www.facebook.com/"><i class="fa-brands fa-facebook"></i></a>
          <a href="https://www.instagram.com/"><i class="fa-brands fa-instagram"></i></a>
          <a href="https://twitter.com/"><i class="fa-brands fa-twitter"></i></a>
        </div>
        </div>
          <div class="footer-col">
            <h4>Sponsored by</h4>
            <div class="sponsor-icons">
              <a href="https://www.bilibili.tv/en/search"><i class="fa-brands fa-bilibili"></i></a>
              <a href="https://global.alipay.com/platform/site/ihome"><i class="fa-brands fa-alipay"></i></a>
              <a href="https://www.shopify.com/"><i class="fa-brands fa-shopify"></i></a>
              <a href="https://www.amazon.com/"><i class="fa-brands fa-amazon"></i></a>
            </div>
          </div>
        </div>
        <div class="footer-row">
          <p>© CopyRight Reserved 2024 <br><br>
          This website is the intellectual property of Social Media Campaigns Ltd, and all rights are reserved. Unauthorized reproduction or distribution of any content from this site is strictly prohibited.
          <br><br><br>
          Developed by <b>Social Media Campaigns Ltd</b> <br><br>
          This website has been developed by <b>Social Media Campaigns Ltd</b>. It is intended for informational purposes only and is not meant for commercial use. Any misuse of the website's content for commercial gain is against the terms of use.
        </p>
      </div>
    </div>
  </footer>
</body>
</html>