<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Campaign</title>
    <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
    <?php
      if(isset($_SESSION['admin'])){
        include("smc_dbconnection.php");
        $id = $_GET['id'];
        $sql = "SELECT * FROM campaign WHERE campaignID=$id";
        $result = mysqli_query($connection,$sql);
        $record = mysqli_fetch_assoc($result);
        if(isset($_POST['btnedit'])){
            $campaign_name = $_POST['campaign_name'];
			$type = $_POST['type'];
			$location = $_POST['location'];
			$end_date = $_POST['end_date'];
            $starting_Date = $_POST['starting_Date'];
			$fee = $_POST['fee'];
			$description = $_POST['description'];
			$aim = $_POST['aim'];
			$vision = $_POST['vision'];
			$status = $_POST['status'];
            
            $sqlupdate = "UPDATE campaign SET campaign_name='$campaign_name',
                                      type='$type',
                                      location='$location',
                                      starting_Date='$starting_Date',
                                      end_date='$end_date',
                                      fee='$fee',
                                      description='$description',
                                      aim='$aim',
                                      vision='$vision',
                                      status='$status'
                                      WHERE campaignID ='$id'";
            if (empty($campaign_name)){
                echo "<script>window.alert('You must enter campaign name');</script>";
            } 
            else if ($type == 0) {
                echo "<script>window.alert('You must choose campaign type');</script>";
            } 
            else if (empty($location)){
                echo "<script>window.alert('You must enter campaign location');</script>";
            } 
            else if (empty($starting_Date)){
                echo "<script>window.alert('You must select a starting date');</script>";
            }
            else if (empty($end_date)){
                echo "<script>window.alert('You must select an end date');</script>";
            }
            else if ($starting_Date > $end_date){
                echo "<script>window.alert('Starting date must be earlier than or equal to the end date');</script>";
            }
            else if (empty($fee)){
                echo "<script>window.alert('You must enter campaign fee');</script>";
            } 
            else if (empty($description)){
                echo "<script>window.alert('You must enter campaign description');</script>";
            } 
            else if (empty($aim)){
                echo "<script>window.alert('You must enter campaign aim');</script>";
            } 
            else if (empty($vision)){
                echo "<script>window.alert('You must enter campaign vision');</script>";
            }                      
            else if (mysqli_query($connection, $sqlupdate)){
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
      <section class="register-container">
        <div class="register-content">
          <div class="content-formBox">
            <h2>Edit Campaign</h2>
            <input type="hidden" name="campaignID" value='<?php echo $record['campaignID']; ?>'>
            <div class="formBox-input">
                <label>Image</label><br>
                <?php if (!empty($record['image1']) || !empty($record['image2']) || !empty($record['image3']) || !empty($record['image4'])): ?>
                    <div class="image-container">
                        <img src="<?php echo $record['image1']; ?>" style="max-width: 50px;"><br>
                        <img src="<?php echo $record['image2']; ?>" style="max-width: 50px;"><br>
                        <img src="<?php echo $record['image3']; ?>" style="max-width: 50px;"><br>
                        <img src="<?php echo $record['image4']; ?>" style="max-width: 50px;"><br>
                    </div>
                <?php endif; ?>
            </div>
            <div class="formBox-input">
              <label for="campaign_name">Campaign Name</label>
              <input type="text" id="campaign_name" name="campaign_name" value='<?php echo $record['campaign_name']; ?>' autocomplete="off" required >
            </div>
            <div class="formBox-input">
                <label>Type</label>
                <select name="type">
                    <option value="0">---Choose Campaign type---</option>
                    <option value="1" <?php if($record['type'] == 1) echo 'selected'; ?>>Contest or Giveaway Campaign</option>
                    <option value="2" <?php if($record['type'] == 1) echo 'selected'; ?>>Social Media Campaign</option>
                    <option value="3" <?php if($record['type'] == 1) echo 'selected'; ?>>Referral Campaign</option>
                    <option value="4" <?php if($record['type'] == 1) echo 'selected'; ?>>Content Marketing Campaign</option>
                    <option value="5" <?php if($record['type'] == 1) echo 'selected'; ?>>Influencer Marketing Campaign</option>
                </select>
            </div>
            <div class="formBox-input">
                <label>Location</label>
                <textarea name="location" autocomplete="off" required><?php echo $record['location']; ?></textarea>
            </div>
            <div class="formBox-input">
                <label>Starting Date</label>
                <input type="date" id="starting_date" name="starting_date" value='<?php echo $record['starting_Date']; ?>' required>
            </div>
            <div class="formBox-input">
                <label>End Date</label>
                <input type="date" id="end_date" name="end_date" value='<?php echo $record['end_date']; ?>' required>
            </div>
            <div class="formBox-input">
                <label>Fee</label>
                <input type="text" name="fee" id="fee" value='<?php echo $record['fee']; ?>' autocomplete="off" required>
            </div>
            <div class="formBox-input">
                <label>Description</label>
                <textarea name="description" autocomplete="off" required><?php echo $record['description']; ?></textarea>
            </div>
            <div class="formBox-input">
                <label>Aim</label>
                <textarea name="aim" autocomplete="off" required><?php echo $record['aim']; ?></textarea>
            </div>
            <div class="formBox-input">
                <label>Vision</label>
                <textarea name="vision" autocomplete="off" required><?php echo $record['vision']; ?></textarea>
            </div>
            <div class="formBox-input">
                <label>Status</label>
                <select name="status">
                    <option value="0">---Choose status---</option>
                    <option value="1" <?php if($record['status'] == 1) echo 'selected'; ?>>Active</option>
                    <option value="2" <?php if($record['status'] == 2) echo 'selected'; ?>>Completed</option>
                    <option value="3" <?php if($record['status'] == 3) echo 'selected'; ?>>Scheduled</option>
                    <option value="4" <?php if($record['status'] == 4) echo 'selected'; ?>>Paused</option>
                    <option value="5" <?php if($record['status'] == 5) echo 'selected'; ?>>Archived</option>
                </select>
            </div>

            <div class="g-recaptcha" data-sitekey="6LdekKwpAAAAAMcfuV9gokD5yP1YX_FQJoqfsYxA"></div>
            <div class="formBox-input">
              <input type="submit" name="btnedit" value="Edit">
            </div>         
            <a href="showcampaign.php">Back</a>
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