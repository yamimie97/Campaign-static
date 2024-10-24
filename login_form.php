<?php
  include 'db.php'; // Include your DB connection file

  // Initialize error variables
  $usernameError = $passwordError = "";

  // Handle form submission
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    
    $isFormValid = true;

    // Check for empty username
    if (empty($username)) {
      $usernameError = "Username is required.";
      $isFormValid = false;
    }

    // Check for empty password
    if (empty($password)) {
      $passwordError = "Password is required.";
      $isFormValid = false;
    }

    if ($isFormValid) {
      // Check if username exists in the database
      $sql_check_username = "SELECT * FROM employee WHERE username = ?";
      $stmt = $conn->prepare($sql_check_username);
      $stmt->bind_param("s", $username);
      $stmt->execute();
      $result = $stmt->get_result();
      
      if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $hash_pw = $user['password'];  // Get hashed password
        $login_attempts = $user['login_attempts'];  // Get login attempts

        // Verify the hashed password
        if (!password_verify($password, $hash_pw)) {
          incrementLoginAttempts($username);  // Increment login attempts
          $login_attempts++;

          // Lock the account after 3 failed attempts
          if ($login_attempts >= 3) {
            lockLoginForm($conn, $username);  // Lock account
            echo '<script>alert("Login failed. Your account has been locked for 10 minutes.");</script>';
          } 
          else {
            echo '<script>alert("Invalid password!");</script>';
          }
        } 
        else {
          // Reset login attempts on successful login
          resetLoginAttempts($username);

          // Start session and redirect to dashboard
          session_start();
          $_SESSION['username'] = $username;
          header("Location: dashboard.php");
          exit(); 
        }
      } 
      else {
        $usernameError = "Username not found.";
      }
    }
  }

  // Increment login attempts
  function incrementLoginAttempts($username) {
      global $conn;
      $sql_update = "UPDATE employee SET login_attempts = login_attempts + 1 WHERE username = ?";
      $stmt = $conn->prepare($sql_update);
      $stmt->bind_param("s", $username);
      $stmt->execute();
  }

  // Reset login attempts
  function resetLoginAttempts($username) {
      global $conn;
      $sql_reset = "UPDATE employee SET login_attempts = 0 WHERE username = ?";
      $stmt = $conn->prepare($sql_reset);
      $stmt->bind_param("s", $username);
      $stmt->execute();
  }

  // Lock the login form for 10 minutes
  function lockLoginForm($conn, $username) {
      $lock_time = time() + (10 * 60);  // Lock for 10 minutes
      $sql_lock = "UPDATE employee SET lock_until = ? WHERE username = ?";
      $stmt = $conn->prepare($sql_lock);
      $stmt->bind_param("is", $lock_time, $username);
      $stmt->execute();
  }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
  <link rel="stylesheet" href="styles.css<?php echo time();?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <?php
    include('header.php');
  ?>
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
            <p>Don't have an account?<a href="registration_form.php">Sign Up</a></p> 
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
	<?php
    include('footer.php');
  ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="main.js"></script>
  <!--icon-->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>