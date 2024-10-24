<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMC Most popular social media apps</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <?php
    include('header.php');
  ?>
    <main>
      <div class="MPSMA-container">
      <h1>Popular Social Media Apps</h1>
        <div class="MPSMA-cover">
          <?php
            include 'smc_dbconnection.php'; 

            $query = "SELECT * FROM mediaapps";
            $result = mysqli_query($connection, $query);

            if ($result){
              $apps = array();

              while ($row = mysqli_fetch_assoc($result)){
                $appName = $row['medianame'];
                $appImage = $row['image'];
                $appRating = $row['rating'];
                $appTechnique = $row['technique'];
                $appStatus = $row['status'];
                $mediadesc = $row['mediadesc'];
                $apps[$appName] = array(
                  'Rating' => $appRating,
                  'Image' => $appImage,
                  'Technique' => $appTechnique,
                  'Status' => $appStatus,
                  'Mediadesc' => $mediadesc
                );
              }

                if(isset($_GET['keyword']) && !empty($_GET['keyword'])){
                  $keyword = $_GET['keyword'];
                  $sqlsearch = "SELECT * FROM mediaapps WHERE medianame LIKE '%$keyword%'";
                  $searchresult = mysqli_query($connection, $sqlsearch);

                  if ($searchresult){
                    while ($searchrecord = mysqli_fetch_assoc($searchresult)){
                      $appName = $searchrecord['medianame'];

                      if (isset($apps[$appName])){
                        $appDetails = $apps[$appName];
                        
                        echo '<div class="MPSMA-box">';
                          echo '<img src="' . $appDetails['Image'] . '" alt="' . $appName . '" class="MPSMA-image">';
                          echo '<h2>' . $appName . '</h2>';
                          echo '<p><b>Rating: </b>' . $appDetails['Rating'] . '</p>';
                          echo '<p><b>Technique: </b>' . $appDetails['Technique'] . '</p>';
                          echo '<p><b>Status: </b>' . $appDetails['Status'] . '</p>';
                          echo '<p><b>Status: </b>' . $appDetails['Mediadesc'] . '</p>';
                        echo '</div>';
                      }
                    }
                  } 
                  else{
                    echo '<script>alert("Error searching in the database.");</script>';
                  }
                } 
                else{
                  foreach ($apps as $appName => $appDetails){
                    echo '<div class="MPSMA-box">';
                    echo '<img src="' . $appDetails['Image'] . '" alt="' . $appName . '" class="MPSMA-image">';
                    echo '<h2>' . $appName . '</h2>';
                    echo '<p><b>Rating: </b>' . $appDetails['Rating'] . '</p>';
                    echo '<p><b>Technique: </b>' . $appDetails['Technique'] . '</p>';
                    echo '<p><b>Status: </b>' . $appDetails['Status'] . '</p>';
                    echo '<p><b>Status: </b>' . $appDetails['Mediadesc'] . '</p>';
                    echo '</div>';
                  }
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
  <?php
    include('footer.php');
  ?>
</body>
</html>