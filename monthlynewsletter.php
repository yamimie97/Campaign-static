<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Monthly Newsletter</title>	
	<link rel="stylesheet" href="styles.css"> <!-- csslink-->
</head>
<body>
    <?php
        if(isset($_SESSION['admin'])) {
            include('adminpanel.php');
            include("smc_dbconnection.php");
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
					<a href="adminlogout.php">
						<span class="icon">
							<ion-icon name="log-out-outline"></ion-icon>
						</span>
						<span class="title">Logout</span>
					</a>
				</li>
			</ul>
		</div>
		<form action='#' method='get'>
			<div class="admin-main">
				<div class="admin-topbar">
					<div class="admin-toggle">
						<ion-icon name="menu-outline"></ion-icon>
					</div>

					<div class="admin-user">
						<ion-icon name="person-circle-outline"></ion-icon>
					</div>
				</div>
				<div class="userlist-table">
					<table>
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
							</tr>
						</thead>
						<tbody>
							<?php
			
								$sql = "select * from monthlynewletters";
								$result = mysqli_query($connection,$sql);
								$num_rows = mysqli_num_rows($result);
							
								if($num_rows == 0){
									echo '<script>alert("No Subscription for monthly newsletter!");</script>';
									echo "<a href='adminpanel.php'>Register</a>";
								}
								else{
									//num_rows not equal to 0 // user existed
									for($i = 0; $i < $num_rows; $i++) {
										$record = mysqli_fetch_assoc($result); 
										$id = $record['monthlynewsletterID'];
										echo "<tr>";
										echo "<td>" . $record['username'] . "</td>";
										echo "<td>" . $record['email'] . "</td>";
										echo "</tr>";
									}
								}
								
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		</form>
	<?php
		}
		else{
			echo '<script>alert("Invalid User!");</script>';
		}
	?>