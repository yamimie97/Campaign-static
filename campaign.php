<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Campaign</title>	
	<link rel="stylesheet" href="styles.css"> <!-- csslink-->
</head>
<body>
    <?php
        if(isset($_SESSION['admin'])) {
		include("smc_dbconnection.php");
		if(isset($_POST['btnadd'])) {
			$campaign_name = $_POST['campaign_name'];
			$type = $_POST['type'];
			$location = $_POST['location'];
			$starting_Date = $_POST['starting_Date'];
			$end_date = $_POST['end_date'];
			$fee = $_POST['fee'];
			$description = $_POST['description'];
			$aim = $_POST['aim'];
			$vision = $_POST['vision'];
			$status = $_POST['status'];

			$image1 = $_FILES['image1']['name'];
			$img_tmp_name = $_FILES['image1']['tmp_name'];
			$path1 = "image/campaign/".$image1;
			copy($img_tmp_name,$path1);

			$image2 = $_FILES['image2']['name'];
			$img_tmp_name = $_FILES['image2']['tmp_name'];
			$path2 = "image/campaign/".$image2;
			copy($img_tmp_name,$path2);

			$image3 = $_FILES['image3']['name'];
			$img_tmp_name = $_FILES['image3']['tmp_name'];
			$path3 = "image/campaign/".$image3;
			copy($img_tmp_name,$path3);

			$image4 = $_FILES['image4']['name'];
			$img_tmp_name = $_FILES['image4']['tmp_name'];
			$path4 = "image/campaign/".$image4;
			copy($img_tmp_name,$path4);

			$start_date_obj = new DateTime($starting_Date);
			$end_date_obj = new DateTime($end_date);

			$starting_date = $start_date_obj->format('Y-m-d');
			$end_date = $end_date_obj->format('Y-m-d');

			$queryString = "SELECT * FROM campaign WHERE campaign_name='$campaign_name'";
			$query = mysqli_query($connection, $queryString);
			$row = mysqli_num_rows($query);
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
			else if($row > 0) {
				echo "<script>window.alert('Campaign already exists!')</script>";
			} else {
				$sqlinsert = "INSERT INTO campaign (campaign_name, type, location, starting_Date, end_date, fee, description, aim, vision, status, image1, image2, image3, image4) 
				VALUES ('$campaign_name', '$type', '$location', '$starting_Date', '$end_date', '$fee', '$description', '$aim', '$vision', '$status', '$path1', '$path2', '$path3', '$path4')";

				if (mysqli_query($connection, $sqlinsert)) {
					echo "<script>window.alert('New Campaign is successfully registered!');
					window.location.href='campaign.php';
					</script>";
				} 
				
				else {
					echo "<script>alert('Invalid Insertion!')</script>";
				}
			}
}
    
?>
	<!--admin home page-->
	<section class="campaign-container">
		<div class="register-imgBox">
		<img src="image/backgroundimg/admin_login_background_img.webp" alt="admin login background">
		</div>
		<div class="register-content">
			<div class="content-formBox">
				<h2>Add New Campaign</h2>
				<form action="#" method="POST" enctype="multipart/form-data">
					<div class="formBox-input">
						<label>Campaign</label>
						<input type="text" name="campaign_name" id="name" autocomplete="off" required>
					</div>
					<div class="formBox-input">
						<label>Campaign Type</label>
						<select name="type">
							<option value="0">---Choose Campaign Type---</option>
							<option value="1">Contest or Giveaway Campaign</option>
							<option value="2">Social Media Campaign</option>
							<option value="3">Referral Campaign</option>
							<option value="4">Content Marketing Campaign</option>
							<option value="5">Influencer Marketing Campaign</option>
						</select>
					</div>
					<div class="formBox-input">
						<label>Location</label>
						<textarea name="location" autocomplete="off" required></textarea>
					</div>
					<div class="formBox-input">
						<label>Starting Date</label>
						<input type="date" name="starting_Date" id="starting_date"  value="<?php date('Y-m-d') ?>" required />
					</div>
					<div class="formBox-input">
						<label>End Date</label>
						<input type="date" name="end_date" id="end_date"  value="<?php date('Y-m-d') ?>" required />
					</div>
					<div class="formBox-input">
						<label>Fee</label>
						<input type="text" name="fee" id="fee" autocomplete="off" required>
					</div>
					<div class="formBox-input">
						<label>Description</label>
						<textarea name="description" autocomplete="off" required></textarea>
					</div>
					<div class="formBox-input">
						<label>Aim</label>
						<textarea name="aim" autocomplete="off" required></textarea>
					</div>
					<div class="formBox-input">
						<label>Vision</label>
						<textarea name="vision" autocomplete="off" required></textarea>
					</div>
					<div class="formBox-input">
						<label>Status</label>
						<select name="status">
							<option value="0">---Choose status---</option>
							<option value="1">Active</option>
							<option value="2">Completed</option>
							<option value="3">Scheduled</option>
							<option value="4">Paused</option>
							<option value="5">Archived</option>
						</select>
					</div>
					<div class="formBox-input">
						<label>Media Image</label>
						<input type="file" name="image1" required><br><br>
						<input type="reset" name="clear" value="Clear">   
					</div>
					<div class="formBox-input">
						<input type="file" name="image2" required><br><br>
						<input type="reset" name="clear" value="Clear">   
					</div>
					<div class="formBox-input">
						<input type="file" name="image3" required><br><br>
						<input type="reset" name="clear" value="Clear">   
					</div>
					<div class="formBox-input">
						<input type="file" name="image4" required><br><br>
						<input type="reset" name="clear" value="Clear">   
					</div>	
					<div class="g-recaptcha" data-sitekey="6LdekKwpAAAAAMcfuV9gokD5yP1YX_FQJoqfsYxA"></div>
					
					<div class="formBox-input">
						<input type="submit" name="btnadd" value="Add">  
					</div>
				</form>
				<a href="adminpanel.php" class="already-account">Back</a>
			</div>
		</div>
	</section>
	<?php
		}
		else{
			echo '<script>alert("Invalid User!");</script>';
		}
	?>
	<script type="text/javascript">
		function showConfirm(id){
			if(confirm("Do you want to delete the selected user record?"))
			{
				window.location.href="deleteuser.php?id="+id;
				alert("Selected User record is deleted!.");
			}
		}
	</script>