<?php session_start();?>
<?php
  //db connection
  include("smc_dbconnection.php");
    //failed login attempts +1 per time
  function incrementLoginAttempts($username) {
    global $connection;
    $sql = "UPDATE user SET login_attempts = login_attempts + 1 WHERE username='$username'";
    mysqli_query($connection, $sql);
  }
  //lock login form for 10 minutes
  function lockLoginForm($connection, $username) {
    setcookie('login_fail', true, time() + 600);
    $sql = "UPDATE user SET login_attempts = 0 WHERE username='$username'";
    mysqli_query($connection, $sql);
  }
  if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (empty($username) || empty($password)) {
      echo '<script>alert("Username and password are required.");</script>';
    }
    else{
      //Checking if username exists in the database
      $sql = "SELECT * FROM user WHERE username='$username'";
      $result = mysqli_query($connection, $sql);
      $rows = mysqli_num_rows($result);

      if ($rows == 0) {
        echo '<script>alert("Username does not exist!");</script>';
      } 
      else {
        $record = mysqli_fetch_assoc($result);
        $hash_pw = $record['password'];

        if (!password_verify($password, $hash_pw)) {
          $login_attempts = $record['login_attempts'] + 1;
          if ($login_attempts >= 3) {
              lockLoginForm($connection, $username);
              echo '<script>alert("Login failed. Your account has been locked for 10 minutes.");</script>';
          } else {
              echo '<script>alert("Invalid password!");</script>';
          }
          echo '<script>alert("Invalid password!");</script>';
        }
        else {
          $role = $record['role'];
          if($role == 'admin'){
            session_start();
            $_SESSION['admin'] = 'admin';
            header("Location: adminpanel.php");
            exit(); 
          }
          else{
            echo '<script>alert("Invalid login!");</script>';
          }
        }
      }
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Login Page</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <section class="login-container">
    <div class="login-imgBox">
      <img src="image/backgroundimg/admin_login_background_img.webp" alt="admin login background">
    </div>
    <div class="login-content">
      <div class="content-formBox">
        <h2>Login</h2>
        <form action="#" method="post">
          <div class="formBox-input">
            <span>Username</span>
            <input type="text" name="username" placeholder="Enter your username" required>
          </div>
          <div class="formBox-input">
            <span>Password</span>
            <input type="password" name="password" placeholder="Enter your password" required>
          </div>
          <div class="formBox-remember">
            <label><input type="checkbox">Remember me</label>
          </div>
          <div class="formBox-input">
            <input type="submit" name="submit" value="Sign in">  
          </div>
          <div class="formBox-input">
            <p>Don't have an account?<a href="admin_registerform.php">Sign Up</a></p> 
          </div>
        </form>
        <h3>Login with social media</h3>
        <ul class="social">
          <li><ion-icon name="logo-facebook"></ion-icon></li>
          <li><ion-icon name="logo-instagram"></ion-icon></li>
          <li><ion-icon name="logo-tiktok"></ion-icon></li>
        </ul>
      </div>
    </div>
  </section>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
script>
</body>
</html>