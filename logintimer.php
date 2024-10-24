<?php
session_start();
$username = isset($_GET['username']) ? $_GET['username'] : '';

if (!isset($_SESSION['lock_time'][$username])) {
    header('Location: login.php'); // Redirect to login if no lock time is set
    exit();
}

// Check if 10-minute countdown is over
if (time() - $_SESSION['lock_time'][$username] > 600) { // 600 seconds = 10 minutes
    unset($_SESSION['login_attempts'][$username]);
    unset($_SESSION['lock_time'][$username]);
    header('Location: login.php'); // Redirect back to login
    exit();
}

$remaining_time = 600 - (time() - $_SESSION['lock_time'][$username]);
$minutes = floor($remaining_time / 60);
$seconds = $remaining_time % 60;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Locked Out</title>
    <style>
        .center-box {
            width: 300px;
            padding: 20px;
            margin: 100px auto;
            text-align: center;
            border: 2px solid #00796b;
            border-radius: 10px;
            background-color: #f8f9fa;
        }
        .countdown {
            font-size: 24px;
            font-weight: bold;
            color: #00796b;
        }
    </style>
</head>
<body>
    <div class="center-box">
        <h3>Your account is locked due to 3 incorrect login attempts.</h3>
        <p>Please wait for the countdown to complete before trying again.</p>
        <div class="countdown" id="countdown">
            <?php echo sprintf("%02d:%02d", $minutes, $seconds); ?>
        </div>
    </div>

    <script>
        // Countdown script
        let remainingTime = <?php echo $remaining_time; ?>;
        const countdownElem = document.getElementById('countdown');

        function updateCountdown() {
            let minutes = Math.floor(remainingTime / 60);
            let seconds = remainingTime % 60;
            countdownElem.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            remainingTime--;
            if (remainingTime < 0) {
                clearInterval(countdownInterval);
                window.location.href = "login.php"; // Redirect to login page after countdown
            }
        }

        const countdownInterval = setInterval(updateCountdown, 1000);
    </script>
</body>
</html>
