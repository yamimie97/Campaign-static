<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
  <?php
    include('header.php');
  ?>
  <section class="register-container">
    <div class="register-imgBox">
      <img src="image/backgroundimg/admin_login_background_img.webp" alt="admin login background">
    </div>
    <div class="register-content">
      <div class="content-formBox">
        <h2>Registration Form</h2>
        <form action="#" method="POST" enctype="multipart/form-data">
          <div class="formBox-input">
            <label for="firstName">First Name</label>
            <input type="text" id="firstName" name="firstName" placeholder="First Name" autocomplete="off" required >
          </div>
          <div class="formBox-input">
            <label for="lastName">Last Name</label>
            <input type="text" id="lastName" name="lastName" placeholder="Last Name" autocomplete="off" required>
          </div>

          <div class="formBox-input">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Email" autocomplete="off" required>
          </div>
          
          <div class="formBox-input">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" placeholder="Phone Number" autocomplete="off" required>
          </div>
          
          <div class="formBox-input">
            <label for="gender">Gender</label>
            <div class="gender-option">
              <input type="radio" id="male" name="gender" value="male" autocomplete="off" required>
              <label for="male">Male</label>
            </div>
            <div class="gender-option">
              <input type="radio" id="female" name="gender" value="female" autocomplete="off" required>
              <label for="female">Female</label>
            </div>
            <div class="gender-option">
              <input type="radio" id="other" name="gender" value="other" autocomplete="off" required>
              <label for="other">Other</label>
            </div>
          </div>
          <div class="formBox-input">
            <label for="address">Address</label>
            <input type="text" id="street" name="street" placeholder="Street" autocomplete="off" required>
            <br><br>
            <input type="text" id="city" name="city" placeholder="City" autocomplete="off" required>
            <br><br>
            <select id="country" name="country" autocomplete="off" required>
              <option value='0'> --- Choose your country --- </option>
              <?php
                $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");

                foreach($countries as $value){
                  echo "<option value='$value'>$value</option>";
                }
              ?>
            </select>
          </div>
          
          <div class="formBox-input">
            <div>
              <label for="username">Username</label>
              <input type="text" id="username" name="username" placeholder="Username" autocomplete="off" required>
            </div> <br>
            <div>
              <label for="password">Password</label>
              <input type="password" id="password" name="password" placeholder="Password" autocomplete="off" required>
            </div><br>
            <div>
              <label for="confirmPassword">Confirm Password</label>
              <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" autocomplete="off" required>
            </div><br>
          </div>
          <div class="formBox-input">
            <label>Profile</label><br>
            <input type="file" name="profile" required><br><br>
            <input type="reset" name="clear" value="Clear">   
          </div>
              
          <div class="g-recaptcha" data-sitekey="6LdekKwpAAAAAMcfuV9gokD5yP1YX_FQJoqfsYxA"></div>

          <div class="formBox-input">
            <input type="submit" name="btnregister" value="Register">  
          </div>
        </form>
        <a href="login_form.php" class="already-account">Already have an account</a>
      </div>
    </div>
  </section>
  
  <?php
    include('footer.php');
  ?>
  <?php
    include("smc_dbconnection.php");
    if (isset($_POST['btnregister'])) {
      $profile_name = $_FILES['profile']['name'];
      $profile_tmp_name = $_FILES['profile']['tmp_name'];
      $path = "image/profile/".$profile_name;
      copy($profile_tmp_name,$path);
      $fname = trim($_POST['firstName']);
      $lname = trim($_POST['lastName']);
      $email = trim($_POST['email']);
      $phone = trim($_POST['phone']);
      if (isset($_POST['gender'])) {
        $gender = $_POST['gender'];
      } 
      else {
        echo "<script>window.alert('You must choose your gender');</script>";
      }
  
      $street = trim($_POST['street']);
      $city = trim($_POST['city']);
      $country = $_POST['country'];
      $uname = trim($_POST['username']);
      $pw = trim($_POST['password']);
      $cpw = trim($_POST['confirmPassword']);
      
      if ($country == 0) {
        echo "<script>window.alert('You must choose your country');</script>";
      } 
      else if (empty($uname)) {
        echo "<script>window.alert('You must enter your username');</script>";
      } 
      else if (empty($pw)) {
        echo "<script>window.alert('You must enter your password');</script>";
      } 
      else if (empty($cpw)) {
        echo "<script>window.alert('You must enter your confirm password');</script>";
      } 
      else {
        if (!preg_match('/^(?=(?:.*[A-Za-z]){4})[A-Za-z\d]{4,12}$/', $uname)) {
          echo "<script>window.alert('Username must contain at least 4 alphabets, with a maximum length of 12 characters');</script>";
        } else {
          if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()\-_=+{};:,<.>])(?=.*[^\da-zA-Z]).{8,16}$/', $pw)) {
              echo "<script>window.alert('Password must contain at least 1 lowercase letter, 1 uppercase letter, 1 number, 1 special character, and be 8 to 16 characters long');</script>";
          } 
          else {
            if(isset($_POST['g-recaptcha-response']))
              $captcha=$_POST['g-recaptcha-response'];
            if(!$captcha){
              echo "<script>alert('Please check the reCaptcha form!');</script>";
              echo "<script>window.location='login_form.php';</script>";
            }
             $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdekKwpAAAAAOLmqzQLQNVOwboCwSv5onoI-7Zw&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);

            if($response['success'] == false)
            {
                echo "<script>alert('You are a spammer!');</script>";
                echo "<script>window.location='Login_form.php';</script>";
            }
            else
            {
                echo "<script>alert('Welcome!');</script>";
            }
            if ($pw == $cpw) {
              $hash_pw = password_hash($pw, PASSWORD_DEFAULT);
              $hash_pw = mysqli_real_escape_string($connection, $hash_pw);
            
              $sql_select = "SELECT * FROM user WHERE username='$uname'";
              $result = mysqli_query($connection, $sql_select);
              $num_rows = mysqli_num_rows($result);
              
              if ($num_rows == 0) {
                $sql = "INSERT INTO user(fname,lname,email,phone,gender,address,username,password,role,profile,remark) 
                        VALUES('$fname','$lname','$email','$phone','$gender','$street, $city, $country','$uname','$hash_pw','user','$path','')";
                
                if (mysqli_query($connection, $sql)) {
                  echo "<script>window.alert('Account is successfully registered!');
                  window.location.href='login_form.php';
                  </script>";
                } 
                else {
                  echo "<script>window.alert('Insertion Error');</script>";
                }
              } 
              else {
                echo "<script>window.alert('Username is existed! Try again to enter new username!');</script>";
              }
            } 
            else {
              echo "<script>window.alert('Password not matched! Please type your password again!');</script>";
            }
          }
        }
      }
    }
  ?>
  <script scr="https://www.google.com/recaptcha/enterprise.js?render=6LdekKwpAAAAAMcfuV9gokD5yP1YX_FQJoqfsYxA"></script>
</body>
</html>