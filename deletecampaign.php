<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Campaign</title>
</head>
<body>
    <?php
        if(isset($_SESSION['admin'])){
            include("smc_dbconnection.php");
            $id=$_GET['id'];
			$sqldelete = "DELETE FROM campaign WHERE campaignID=$id";
            if (mysqli_query($connection, $sqldelete)){
                $_SESSION['success_message'] = "Deleted selected campaign successfully!";
                header("Location: showcampaign.php");
                exit;
            }
            else{
                echo "<script>window.alert('Deleting Error');</script>";
            }
        }
    ?>
</body>
</html>