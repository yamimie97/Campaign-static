<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Media Apps List</title>	
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
					<div class="admin-search">
						<div class="search-input">
							<label>
								<input type="text" name="keyword" placeholder="Search . . .">
								<ion-icon name="search-outline"></ion-icon>
							</label>
						</div>
						<div class="search-button">
							<input type="submit" name="search" value="Search">
						</div>
						<div class="search-button">
							<a href="showmediaapps.php">Clear</a>
						</div>
					</div>
				</div>
				<div class="userlist-table">
					<table>
						<thead>
							<tr>
								<th>Media App</th>
								<th>Name</th>
								<th>Technique</th>
								<th>Description</th>
                                <th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(isset($_GET['keyword'])){
									$keyword = $_GET['keyword'];
									$sqlsearch = "SELECT * FROM mediaapps WHERE (medianame LIKE '%$keyword%')";
									$searchresult = mysqli_query($connection,$sqlsearch);
									$num_searchrows = mysqli_num_rows($searchresult);
									if ($num_searchrows == 0){
										echo '<script>alert("Not Found!");</script>';
									}
									else{
										echo "<h2>Searched Media App List</h2>";
										$searchrecord = mysqli_fetch_assoc($searchresult); 
										$id = $searchrecord['mediaID'];

										echo "<tr>";
										echo "<td><img src='" . $searchrecord['image'] . "' width='50' height='50'></td>";
										echo "<td>" . $searchrecord['medianame'] ."</td>";
										echo "<td>" . $searchrecord['technique'] . "</td>";
										echo "<td>" . $searchrecord['mediadesc'] . "</td>";
										echo "<td><a href='#' onclick='showConfirm(" . $id . ")'>Delete</a> || <a href='editmediaapps.php?id=" . $id . "'>Edit</a></td>";
										echo "</tr>";
									}
								}
								else{
									$sql = "select * from mediaapps";
									$result = mysqli_query($connection,$sql);
									$num_rows = mysqli_num_rows($result);
								
									if($num_rows == 0){
										echo '<script>alert("No Media App Record!");</script>';
										echo "<a href='mediaapps.php'>Register</a>";
									}
									else{
										//num_rows not equal to 0 // user existed
										for($i = 0; $i < $num_rows; $i++) {
											$record = mysqli_fetch_assoc($result); 
											$id = $record['mediaID'];
	
											echo "<tr>";
											echo "<td><img src='" . $record['image'] . "' width='50' height='50'></td>";
											echo "<td>" . $record['medianame'] ."</td>";
											echo "<td>" . $record['technique'] . "</td>";
											echo "<td>" . $record['mediadesc'] . "</td>";
											echo "<td><a href='#' onclick='showConfirm(" . $id . ")'>Delete</a> || <a href='editmediaapps.php?id=" . $id . "'>Edit</a></td>";
											echo "</tr>";
										}
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
	<script type="text/javascript">
		function showConfirm(id){
			if(confirm("Do you want to delete the selected media app?"))
			{
				window.location.href="deletemediaapps.php?id="+id;
				alert("Selected Media App is deleted!.");
			}
		}
	</script>
</body>
</html>