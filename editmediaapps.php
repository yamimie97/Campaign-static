<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Media App</title>
    <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
    <?php
      if(isset($_SESSION['admin'])){
        include("smc_dbconnection.php");
        $id = $_GET['id'];
        $sql = "SELECT * FROM mediaapps WHERE mediaID=$id";
        $result = mysqli_query($connection,$sql);
        $record = mysqli_fetch_assoc($result);
        if(isset($_POST['btnedit'])){
          $medianame = trim($_POST['medianame']);
          
        //   $profile_name = $_FILES['profile']['name'];
        //   $profile_tmp_name = $_FILES['profile']['tmp_name'];
        //   $path = "image/profile/".$profile_name;
        //   copy($profile_tmp_name,$path);
          
          $rating = ($_POST['rating']);
          $technique = trim($_POST['technique']);
          $mediadesc = trim($_POST['mediadesc']);

          $sqlupdate = "UPDATE mediaapps SET medianame='$medianame',
                                      rating='$rating',
                                      technique='$technique',
                                      mediadesc='$mediadesc' WHERE mediaID='$id'";

          if (empty($medianame)){
            echo "<script>window.alert('You must enter media name');</script>";
          } 
          if ($rating == 0) {
            echo "<script>window.alert('You must choose rating');</script>";
          } 
          else if (empty($technique)){
            echo "<script>window.alert('You must enter technique');</script>";
          } 
          if ($status == 0) {
            echo "<script>window.alert('You must choose status');</script>";
          } 
          else if (empty($mediadesc)){
            echo "<script>window.alert('You must enter media description');</script>";
          } 
          else if (mysqli_query($connection, $sqlupdate)){
              session_start();
              $_SESSION['success_message'] = "Updated successfully!";
              header("Location: showmediaapps.php");
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
				<li>
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
      <section class="media-container">
        <div class="register-content">
          <div class="content-formBox">
            <h2>Edit User Form</h2>
            <input type="hidden" name="mediaID" value='<?php echo $record['mediaID']; ?>'>
            <div class="formBox-input">
              <label for="medianame">Media App Name</label>
              <input type="text" id="medianame" name="medianame" value='<?php echo $record['medianame']; ?>' autocomplete="off" required >
            </div>
            <div class="formBox-input">
                <label>Image</label><br>
                <?php if(!empty($record['image'])): ?>
                    <img src="<?php echo $record['image']; ?>" style="max-width: 50px;"><br>
                <?php endif; ?>
                <input type="file" name="profile">
                <input type="reset" name="clear" value="Clear">
            </div>
            <div class="formBox-input">
                <label>Rating</label>
                <select name="rating">
                    <option value="0">---Choose rating---</option>
                    <option value="1" <?php if($record['rating'] == 1) echo 'selected'; ?>>Poor</option>
                    <option value="2" <?php if($record['rating'] == 2) echo 'selected'; ?>>Fair</option>
                    <option value="3" <?php if($record['rating'] == 3) echo 'selected'; ?>>Average</option>
                    <option value="4" <?php if($record['rating'] == 4) echo 'selected'; ?>>Good</option>
                    <option value="5" <?php if($record['rating'] == 5) echo 'selected'; ?>>Excellent</option>
                </select>
            </div>
            <div class="formBox-input">
                <label>Technique</label>
                <textarea name="technique"><?php echo $record['technique']; ?></textarea>
            </div>
            
            <div class="formBox-input">
                <label>Status</label>
                <select name="status" value='<?php echo $record['status']; ?>'>
                    <option value="0">---Choose status---</option>
                    <option value="latest" <?php if($record['status'] == "latest") echo 'selected'; ?>>Latest</option>
                    <option value="old" <?php if($record['status'] == "old") echo 'selected'; ?>>Old</option>
                </select>
            </div>
            <div class="formBox-input">
                <label>Description</label>
                <textarea name="mediadesc" rows="8" cols="50"><?php echo $record['mediadesc']; ?></textarea>
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