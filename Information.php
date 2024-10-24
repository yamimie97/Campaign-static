<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMC Information</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php
        include('header.php');
    ?>

    <main>
        <div class="MPSMA-container">
            <h1>Social Media Campaign</h1>
            <div class="MPSMA-cover">
            <?php
                include 'smc_dbconnection.php'; 

                $query = "SELECT * FROM campaign";
                $result = mysqli_query($connection, $query);

                if ($result){
                    $apps = array();
                    while ($row = mysqli_fetch_assoc($result)){
                        $campaignID = $row['campaignID'];
                        $campaign_name = $row['campaign_name'];
                        $type = $row['type'];
                        $location = $row['location'];
                        $starting_Date = $row['starting_Date'];
                        $end_date = $row['end_date'];
                        $fee = $row['fee'];
                        $description = $row['description'];
                        $aim = $row['aim'];
                        $vision = $row['vision'];
                        $status = $row['status'];
                        $campaignImage1 = $row['image1'];
                        $campaignImage2 = $row['image2'];
                        $campaignImage3 = $row['image3'];
                        $campaignImage4 = $row['image4'];
                        $typeMapping = array(
                            1 => 'Contest or Giveaway Campaign',
                            2 => 'Social Media Campaign',
                            3 => 'Referral Campaign',
                            4 => 'Content Marketing Campaign',
                            5 => 'Influencer Marketing Campaign'
                        );
                        $statusMapping = array(
                            1 => 'Active',
                            2 => 'Completed',
                            3 => 'Scheduled',
                            4 => 'Paused',
                            5 => 'Archieved'
                        );
                        $cpg[$campaignID] = array(
                        'campaign_name' => $campaign_name,
                        'type' => $type,
                        'location' => $location,
                        'starting_Date' => $starting_Date,
                        'end_date' => $end_date,
                        'fee' => $fee,
                        'description' => $description,
                        'aim' => $aim,
                        'vision' => $vision,
                        'status' => $status,
                        'campaignImage1' => $campaignImage1,
                        'campaignImage2' => $campaignImage2,
                        'campaignImage3' => $campaignImage3,
                        'campaignImage4' => $campaignImage4
                        );
                    }
                    foreach ($cpg as $campaignID => $cpgDetails){
                        echo '<div class="MPSMA-box">';
                            echo '<div class="image-container">';
                                echo '<img src="' . $cpgDetails['campaignImage1'] . '" alt="Image 1">';
                                echo '<img src="' . $cpgDetails['campaignImage2'] . '" alt="Image 2">';
                                echo '<img src="' . $cpgDetails['campaignImage3'] . '" alt="Image 3">';
                                echo '<img src="' . $cpgDetails['campaignImage4'] . '" alt="Image 4">';
                            echo '</div>';
                            echo '<h2>' . $campaign_name . '</h2>';
                            echo '<p><b>Type: </b>' . $typeMapping[$cpgDetails['type']] . '</p>';
                            echo '<p><b>Location: </b>' . $cpgDetails['location'] . '</p>';
                            echo '<p><b>Starting Date: </b>' . $cpgDetails['starting_Date'] . '</p>';
                            echo '<p><b>End Date: </b>' . $cpgDetails['end_date'] . '</p>';
                            echo '<p><b>Fee: </b>' . $cpgDetails['fee'] . '</p>';
                            echo '<p><b>Description: </b>' . $cpgDetails['description'] . '</p>';
                            echo '<p><b>Aim: </b>' . $cpgDetails['aim'] . '</p>';
                            echo '<p><b>Vision: </b>' . $cpgDetails['vision'] . '</p>';
                            echo '<p><b>Status: </b>' . $statusMapping[$cpgDetails['status']] . '</p>';    
                            echo '<div class="button-container">';
                                echo '<a href="participantform.php?id=' . $campaignID . '"><button class="button">Participate</button></a>';
                            echo '</div>';                  
                        echo '</div>';
                    }
                }
                
            else{
              echo "<script>alert('Error fetching data from the database.');</script>";
            }

            mysqli_close($connection);
            ?>
            </div>
        </div>
    </main>

    <section class="information-content">
        <h2>About Social Media Campaigns Ltd.</h2>
        <p>Social Media Campaigns Ltd. (SMC) is dedicated to providing help and support to teenagers to encourage safe use of social media apps.</p>
        <p>Our mission is to educate teenagers about the potential risks associated with social media use and empower them with the knowledge and skills to stay safe online.</p>
        <p>We offer a range of resources, including informative articles, interactive workshops, and a monthly newsletter, to help teenagers make informed choices about their online behavior.</p>
    </section>
  
    <section class="information-content">
        <h2>Our Aims and Vision</h2>
        <p>Our aim is to create a safer online environment for teenagers by promoting responsible social media use and fostering digital literacy skills.</p>
        <p>We envision a future where teenagers can navigate social media platforms confidently, knowing how to protect their privacy, avoid cyberbullying, and engage in positive online interactions.</p>
    </section>

     <section class="information-content">
        <h2>Our Approach</h2>
        <p>At Social Media Campaign, we take a proactive approach to online safety education for teenagers. Our approach includes:</p>
        <ul>
            <li><strong>Educational Programs:</strong> We develop and deliver interactive workshops and presentations to schools and youth organizations to educate teenagers about online safety.</li>
            <li><strong>Resource Library:</strong> We maintain a comprehensive online resource library with articles, videos, and guides covering various topics related to social media safety.</li>
            <li><strong>Community Engagement:</strong> We actively engage with teenagers and parents through social media channels, online forums, and community events to raise awareness and provide support.</li>
        </ul>
    </section>
    <?php
        include('footer.php');
    ?>
</body>
</html>