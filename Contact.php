<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Smc Contact</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
 	<?php
  	include('header.php');
 	?>
	<div class="contact-container">
		<main class="contact-row">
			<section class="contact-col left">
				<div class="contactTitle">
					<h2>Contact Us</h2>
					<p>If you need any further assistance or have specific questions, please don't hesitate to contact us. We're here to help!</p>
				</div>
				<div class="contactInfo">
					<div class="iconGroup">
						<div class="icon">
							<i class="fa-solid fa-phone"></i>
						</div>
						<div class="details">
							<span>Phone</span>
							<span>+777 777 777</span>
						</div>
					</div>

					<div class="iconGroup">
						<div class="icon">
							<i class="fa-solid fa-envelope"></i>
						</div>
						<div class="details">
							<span>Email</span>
							<span>smc1879@yahoo.com</span>
						</div>
					</div>

					<div class="iconGroup">
						<div class="icon">
							<i class="fa-solid fa-location-dot"></i>
						</div>
						<div class="details">
							<span>Location</span>
							<span>No. 44, Pyay Road, Yangon</span>
						</div>
					</div>
					<div class="privacy-policy-link">
						<a href="privacypolicy.php">Privacy Policy</a>
					</div>

				</div>
				<div class="socialMedia">
					<a href="https://www.facebook.com/"><i class="fa-brands fa-facebook-f"></i></a>
					<a href="https://twitter.com/?lang=en"><i class="fa-brands fa-twitter"></i></a>
					<a href="https://www.instagram.com/"><i class="fa-brands fa-instagram"></i></a>
				</div>
			</section>
			<section class="contact-col right">
				<form action="#" method="POST" class="messageForm">
					<div class="inputGroup halfWidth">
						<input type="text" name="name" required="required">
						<label>Your Name</label>
					</div>
					<div class="inputGroup halfWidth">
						<input type="text" name="email" required="required">
						<label>Email</label>
					</div>

					<div class="inputGroup fullWidth">
						<input type="text" name="subject" required="required">
						<label>Subject</label>
					</div>
					<div class="inputGroup fullWidth">
						<textarea name="detail" required="required"></textarea>
						<label>Say Something</label>
					</div>
					<div class="inputGroup fullWidth">
						<button type="submit" name="send_message">Send Message</button>
					</div>
				</form>
			</section>
		</main>
	</div>
 	<?php
  		include('footer.php');
	?>
	<?php
		include("smc_dbconnection.php");
		if (isset($_POST['send_message'])){
			$name = trim($_POST['name']);
			$email = trim($_POST['email']);
			$subject = trim($_POST['subject']);
			$detail = trim($_POST['detail']);
			if (empty($name)){
				echo "<script>window.alert('You must enter your name');</script>";
			} 
			else if (empty($email)){
				echo "<script>window.alert('You must enter your email');</script>";
			} 
			else if (empty($subject)){
				echo "<script>window.alert('You must enter subject');</script>";
			} 
			else if (empty($detail)){
				echo "<script>window.alert('You must enter detail');</script>";
			} 
			else{
				$sql = "INSERT INTO contact(name,email,subject,detail) 
						VALUES('$name','$email','$subject','$detail')";
				if (mysqli_query($connection, $sql)){
					echo "<script>window.alert('Sent Messge successfully!');
					window.location.href='Contact.php';
					</script>";
				} 
				else{
					echo "<script>window.alert('Insertion Error');</script>";
				}
			}
		}
	?>
</body>
</html>
