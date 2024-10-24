<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Media Apps</title>	
	<link rel="stylesheet" href="styles.css"> <!-- csslink-->
</head>
<body>
    <?php
        if(isset($_SESSION['admin'])) {
            include("smc_dbconnection.php");
			if(isset($_POST['btnadd'])) {
				$medianame = $_POST['medianame'];
				$rating = $_POST['rating'];
				$technique = $_POST['technique'];
				$status = $_POST['status'];
				$mediadesc = $_POST['mediadesc'];

				$profile_name = $_FILES['profile']['name'];
				$profile_tmp_name = $_FILES['profile']['tmp_name'];
				$path = "image/profile/".$profile_name;
				copy($profile_tmp_name,$path);

				$sql_select = "SELECT * FROM mediaapps WHERE medianame='$medianame'";
				$result = mysqli_query($connection, $sql_select);
				$num_rows = mysqli_num_rows($result);
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
				else if ($num_rows == 0)
				{
					$sql = "INSERT INTO mediaapps (medianame, image, rating, technique, status, mediadesc) 
								VALUES ('$medianame', '$path', '$rating', '$technique', '$status', '$mediadesc')";
					if (mysqli_query($connection, $sql)) {
						echo "<script>window.alert('New Media App is successfully registered!');
						window.location.href='mediaapps.php';
						</script>";
					  } 
				}
				else {
					echo "<script>alert('Invalid Insertion!')</script>";
				}
			}
		
    ?>
	<!--admin home page-->
	<section class="media-container">
		<div class="register-imgBox">
		<img src="image/backgroundimg/admin_login_background_img.webp" alt="admin login background">
		</div>
		<div class="register-content">
			<div class="content-formBox">
				<h2>Add New Media App</h2>
				<form action="#" method="POST" enctype="multipart/form-data">
					<div class="formBox-input">
					<label>Media Name</label>
						<input type="text" name="medianame" id="name" autocomplete="off" required>
					</div>
					<div class="formBox-input">
						<label>Media Image</label>
						<input type="file" name="profile" required><br><br>
						<input type="reset" name="clear" value="Clear">   
					</div>

					<div class="formBox-input">
						<label>Rating</label>
						<select name="rating">
							<option value="0">---Choose rating---</option>
							<option value="1">Poor</option>
							<option value="2">Fair</option>
							<option value="3">Average</option>
							<option value="4">Good</option>
							<option value="5">Excellent</option>
						</select>
					</div>
					
					<div class="formBox-input">
						<label>Technique</label>
						<textarea name="technique" autocomplete="off" required></textarea>
					</div>
					
					<div class="formBox-input">
						<label>Status</label>
						<select name="status">
							<option value="0">---Choose status---</option>
							<option value="latest">Latest</option>
							<option value="old">Old</option>
						</select>
					</div>
					<div class="formBox-input">
						<label>Description</label>
						<textarea name="mediadesc" autocomplete="off" required></textarea>
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