<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
    <?php
      if(isset($_SESSION['admin'])){
        include("smc_dbconnection.php");
        $id = $_GET['id'];
        $sql = "SELECT * FROM user WHERE userid=$id";
        $result = mysqli_query($connection,$sql);
        if ($result && mysqli_num_rows($result)>0){
            $record = mysqli_fetch_assoc($result);
            $address_data = $record['address'];

            $address_components = explode(',', $address_data);
            if (count($address_components) >= 1) {
                $value1 = trim($address_components[0]);
                $value2 = trim($address_components[1]);
                $value3 = trim($address_components[2]);
            } else {
                $value1 = "";
                $value2 = "";
                $value3 = "";
            }
        }
        else{
            $value1 = "";
            $value2 = "";
            $value3 = "";
        }
        if(isset($_POST['btnedit'])){
          $fname = trim($_POST['firstName']);
          $lname = trim($_POST['lastName']);
          $email = trim($_POST['email']);
          $phone = $_POST['phone'];
          if (isset($_POST['gender'])) {
              $gender = $_POST['gender'];
          } 
          else {
              echo "<script>window.alert('You must choose your gender');</script>";
          }
          $street = trim($_POST['street']);
          $city = trim($_POST['city']);
          $country = $_POST['country'];
          $sqlupdate = "UPDATE user SET fname='$fname',
                                      lname='$lname',
                                      email='$email',
                                      phone='$phone',
                                      gender='$gender',
                                      address='$street, $city, $country' WHERE userid='$id'";
          if (mysqli_query($connection, $sqlupdate)){
              session_start();
              $_SESSION['success_message'] = "Updated successfully!";
              header("Location: userlist.php");
          }
          else{
              echo "<script>window.alert('Updating error');</script>";
          }
        }
        
    ?>
    <!--admin home page-->
	<div class="admin-container">
		<div class="admin-navigation">
			<ul>
				<li>
					<a href="#">
						<span class="icon">
							<ion-icon name="snow-outline"></ion-icon>
						</span>
						<span class="title">SMC</span>
					</a>
				</li>
				<li <?php if(basename($_SERVER['PHP_SELF']) == 'adminpanel.php') echo 'class="active"';?>>
					<a href="adminpanel.php">
						<span class="icon">
							<ion-icon name="home-outline"></ion-icon>
						</span>
						<span class="title">Admin Panel</span>
					</a>
				</li>
				<li <?php if(basename($_SERVER['PHP_SELF']) == 'userlist.php') echo 'class="active"';?>>
					<a href="userlist.php">
						<span class="icon">
							<ion-icon name="people-outline"></ion-icon>
						</span>
						<span class="title">Userlist</span>
					</a>
				</li>
				<li <?php if(basename($_SERVER['PHP_SELF']) == 'feedback.php') echo 'class="active"';?>>
					<a href="feedback.php">
						<span class="icon">
							<ion-icon name="chatbubble-outline"></ion-icon>
						</span>
						<span class="title">Messages</span>
					</a>
				</li>

				<li <?php if(basename($_SERVER['PHP_SELF']) == 'showcampaign.php') echo 'class="active"';?>>
					<a href="showcampaign.php">
						<span class="icon">
							<ion-icon name="earth-outline"></ion-icon>
						</span>
						<span class="title">Campaign</span>
					</a>
				</li>
				<li <?php if(basename($_SERVER['PHP_SELF']) == 'showmediaapps.php') echo 'class="active"';?>>
					<a href="showmediaapps.php">
						<span class="icon">
							<ion-icon name="apps-outline"></ion-icon>
						</span>
						<span class="title">Media Apps</span>
					</a>
				</li>
				<li <?php if(basename($_SERVER['PHP_SELF']) == 'campaignparticipants.php') echo 'class="active"';?>>
					<a href="campaignparticipants.php">
						<span class="icon">
							<ion-icon name="person-add-outline"></ion-icon>
						</span>
						<span class="title">Campaign Participants</span>
					</a>
				</li>
				<li <?php if(basename($_SERVER['PHP_SELF']) == 'monthlynewsletter.php') echo 'class="active"';?>>
					<a href="monthlynewsletter.php">
						<span class="icon">
							<ion-icon name="calendar-outline"></ion-icon>
						</span>
						<span class="title">Monthly newsletter</span>
					</a>
				</li>
				<li <?php if(basename($_SERVER['PHP_SELF']) == 'adminhome.php') echo 'class="active"';?>>
					<a href="#">
						<span class="icon">
							<ion-icon name="log-out-outline"></ion-icon>
						</span>
						<span class="title">Logout</span>
					</a>
				</li>
			</ul>
		</div>
		<form action='#' method='post'>
		<div class="admin-main">
      <section class="edituser-container">
        <div class="register-content">
          <div class="content-formBox">
            <h2>Edit User Form</h2>
            <input type="hidden" name="id" value='<?php echo $record['userid']; ?>'>
            <div class="formBox-input">
              <label for="firstName">First Name</label>
              <input type="text" id="firstName" name="firstName" value='<?php echo $record['fname']; ?>' autocomplete="off" required >
            </div>
            <div class="formBox-input">
              <label for="lastName">Last Name</label>
              <input type="text" id="lastName" name="lastName" value='<?php echo $record['lname']; ?>' autocomplete="off" required>
            </div>

            <div class="formBox-input">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" value='<?php echo $record['email']; ?>' autocomplete="off" required>
            </div>
            
            <div class="formBox-input">
              <label for="phone">Phone Number</label>
              <input type="tel" id="phone" name="phone" value='<?php echo $record['phone']; ?>' autocomplete="off" required>
            </div>
            
            <div class=class="formBox-input">
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
              <input type="text" id="street" name="street" value="<?php echo $value1; ?>" autocomplete="off" required>
              <input type="text" id="city" name="city" value="<?php echo $value2; ?>" autocomplete="off" required>
              <select id="country" name="country" autocomplete="off" required>
                <option value='0'> --- Choose your country --- </option>
                <?php
                  $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
                  
                  foreach($countries as $value){
                      if($value3 == $value)    
                          echo "<option value='$value' selected>$value</option>";
                      else
                          echo "<option value='$value'>$value</option>";
                  }
                ?>
              </select>
            </div>
            <div class="g-recaptcha" data-sitekey="6LdekKwpAAAAAMcfuV9gokD5yP1YX_FQJoqfsYxA"></div>
            <div class="formBox-input">
              <input type="submit" name="btnedit" value="Edit">
            </div>         
            <a href="userlist.php">Back</a>
          </div>
        </div>
      </section>
    </form>
  <?php
		}
		else{
			echo '<script>alert("Invalid User!");</script>';
		}
	?>          
</body>
</html>