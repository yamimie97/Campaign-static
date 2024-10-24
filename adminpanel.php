<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Panel</title>
    <link rel="stylesheet" href="styles.css"> <!-- csslink-->
</head>

<body class="admin-body">
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
        <div class="admin-main">
            <div class="admin-cardBox">
                <a href="campaign.php">
                    <div class="admin-card">
                        <div>
                        <a href="campaign.php"><div class="cardName">Add Campaign</div></a>
                            
                        </div>
                        <div class="card-iconBox">
                            <ion-icon name="earth-outline"></ion-icon>
                        </div>
                    </div>
                    </a>
            </div>
            <div class="admin-cardBox">
                <a href="mediaapps.php">
                    <div class="admin-card">
                        <div>
                            <div class="cardName">Add Media Apps</div>
                        </div>
                        <div class="card-iconBox">
                            <ion-icon name="apps-outline"></ion-icon>
                        </div>
                    </div>
                </a>
            </div>
            <div class="admin-cardBox">
                <a href="mediaapps.php">
                    <div class="admin-card">
                        <div>
                            <a href="add_newadmin.php"><div class="cardName">New Admin Registration</div></a>
                        </div>
                        <div class="card-iconBox">
                            <ion-icon name="people-outline"></ion-icon>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!--scripts-->
    <script src="main.js"></script>
    <!--icon-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
