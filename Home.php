<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Social Media Safety Campaign</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <?php
    include('header.php');
  ?>
  <div class="homeimg-container">
    <img src="image/backgroundimg/homewallpaper3d.jpg" alt="3dimg">
    <div class="homeimg-text">
      <h1>SMC</h1>
      <p>Welcome to Social Meida Campaigns (SMC), your guide to staying safe in the digital world! Explore our resources and learn how to navigate social media responsibly. Together, let's create a safer online environment for everyone.</p>
    </div>
  </div>
  <div class="newsletter-container">
    <div class="newsletter-image">
        <img src="image/backgroundimg/newsletter.webp" alt="Newsletter Image">
    </div>
    <div class="newsletter-form">
      <h1>Subscription for a monthly newsletter</h1>
        <form action="#" method="POST">
            <div class="newsletterform-group">
              <label for="email"><b>Email:</b></label>
              <input type="email" id="email" name="email" placeholder="Enter your email">
            </div>
            <div class="newsletterform-group">
              <label for="username"><b>Username:</b></label>
              <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <button type="submit" name="btnsubscribe">Subscribe</button>
        </form>
    </div>
  </div>
  <section class="livestream-content">
    <h2>Top 10 Tips for Teenagers: Staying Safe Online</h2>
    <ul>
      <li><b>Strong Passwords:</b> Use unique, strong passwords for each of your online accounts. Avoid using easily guessable information like birthdays or common words.</li>
      <li><b>Privacy Settings:</b> Regularly review and adjust the privacy settings on your social media accounts and other online profiles. Limit the amount of personal information visible to the public.</li>
      <li><b>Be Skeptical: </b>Be cautious about sharing personal information or clicking on links from unknown sources, especially in emails or messages. Verify the legitimacy of websites and individuals before sharing sensitive data.</li>
      <li><b>Think Before You Share: </b>Before posting anything online, consider the potential consequences. Once something is shared online, it can be difficult to remove it completely.</li>
      <li><b>Avoid Public Wi-Fi for Sensitive Activities: </b>Public Wi-Fi networks may not be secure, so avoid logging into sensitive accounts or conducting financial transactions while connected to them.</li>
      <li><b>Keep Software Updated: </b>Regularly update your operating system, web browser, and security software to protect against vulnerabilities and malware.</li>
      <li><b>Beware of Phishing: </b>Be cautious of emails, messages, or websites that request personal information or prompt you to click on suspicious links. Phishing attempts can be sophisticated and may appear legitimate.</li>
      <li><b>Use Two-Factor Authentication: </b>Enable two-factor authentication whenever possible to add an extra layer of security to your accounts.</li>
      <li><b>Educate Yourself: </b>Stay informed about common online threats and scams. Educate yourself and others about safe internet practices.</li>
      <li><b>Trust Your Instincts:</b>If something seems too good to be true or feels suspicious, trust your instincts and proceed with caution. It's better to be safe than sorry when it comes to online safety.</li>

    </ul>
  </section>

  <main>
    <div class="MPSMA-container">
    <h1>Most Popular Social Media Apps</h1>
      <div class="MPSMA-cover">
        <?php
          include 'smc_dbconnection.php'; 
          if (isset($_POST['btnsubscribe'])) {
            $email = trim($_POST['email']);
            $username = trim($_POST['username']);
            if (empty($email)){
              echo "<script>window.alert('You must enter your email');</script>";
            } 
            else if (empty($username)){
              echo "<script>window.alert('You must enter your username');</script>";
            } 
            else{
              $sql = "SELECT * FROM monthlynewletters WHERE (username='$username' or email='$email')";
              $result = mysqli_query($connection, $sql);
              $num_rows = mysqli_num_rows($result);
              
              if ($num_rows == 0) {
                $sql = "INSERT INTO monthlynewletters(email,username) VALUES('$email','$username')";
                
                if (mysqli_query($connection, $sql)) {
                  echo "<script>window.alert('Successfully subscribed for monthly newsletter!');
                  window.location.href='home.php';
                  </script>";
                } 
                else {
                  echo "<script>window.alert('Insertion Error');</script>";
                }
              }
            }
          }
          $query = "SELECT * FROM mediaapps";
          $result = mysqli_query($connection, $query);

          if ($result){
            $apps = array();

            while ($row = mysqli_fetch_assoc($result)){
              $appName = $row['medianame'];
              $appImage = $row['image'];
              $appRating = $row['rating'];
              $appTechnique = $row['technique'];
              $appStatus = $row['status'];
              $mediadesc = $row['mediadesc'];
              $apps[$appName] = array(
                'Rating' => $appRating,
                'Image' => $appImage,
                'Technique' => $appTechnique,
                'Status' => $appStatus,
                'Mediadesc' => $mediadesc
              );
            }
            $count = 0;
            foreach ($apps as $appName => $appDetails){
              if ($count >= 6){
                break;
              }
              echo '<div class="MPSMA-box">';
              echo '<img src="' . $appDetails['Image'] . '" alt="' . $appName . '" class="MPSMA-image">';
              echo '<h2>' . $appName . '</h2>';
              echo '<p><b>Rating: </b>' . $appDetails['Rating'] . '</p>';
              echo '<p><b>Technique: </b>' . $appDetails['Technique'] . '</p>';
              echo '<p><b>Status: </b>' . $appDetails['Status'] . '</p>';
              echo '<p><b>Status: </b>' . $appDetails['Mediadesc'] . '</p>';
              echo '</div>';
              $count++;
            }
          }
          else{
            echo "<script>alert('Error fetching data from the database.');</script>";
          }

          mysqli_close($connection);
        ?>
      </div>
    </div>
  </main>
  <?php
    include('footer.php');
  ?>
</body>
</html>
