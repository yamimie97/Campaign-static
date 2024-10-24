<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Media App</title>
</head>
<body>
    <?php
        if(isset($_SESSION['admin'])){
            include("smc_dbconnection.php");
            $id=$_GET['id'];
			$sqldelete = "DELETE FROM mediaapps WHERE mediaID=$id";
            if (mysqli_query($connection, $sqldelete)){
                $_SESSION['success_message'] = "Deleted one media app successfully!";
                header("Location: showmediaapps.php");
                exit;
            }
            else{
                echo "<script>window.alert('Deleting Error');</script>";
            }
        }
    ?>
</body>
</html>