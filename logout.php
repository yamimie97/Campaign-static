<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
</head>
<body>
    <?php
        session_destroy();
        unset($_SESSION['admin']);
        echo "<script>alert('Successfully logout!')";
        header("Location: Home.php");
        exit(); 
    ?>
</body>
</html>