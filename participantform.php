<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Participant Form</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <?php
    include('header.php');
  ?>
  <?php
      include("smc_dbconnection.php");
      $campaignID = $_GET['id'];
      $sql = "SELECT * FROM campaign WHERE campaignID=$campaignID";
      $result = mysqli_query($connection,$sql);
      $record = mysqli_fetch_assoc($result);
      if (isset($_POST['btnregister'])) {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $campaign_name = trim($_POST['campaign_name']);
        $type = trim($_POST['type']);

        if (empty($name)) {
          echo "<script>window.alert('You must enter your username');</script>";
        } 
        else if (empty($email)) {
          echo "<script>window.alert('You must enter your email');</script>";
        } 
        else if (empty($phone)) {
          echo "<script>window.alert('You must enter your phone');</script>";
        } 
        else {
          $sql_select = "SELECT * FROM campaignparticipant WHERE (name='$name' or email='$email')";
          $result = mysqli_query($connection, $sql_select);
          $num_rows = mysqli_num_rows($result);
          if ($num_rows == 0)
          {
            $sql = "INSERT INTO campaignparticipant (name, email, phone, campaign_name, campaign_type) 
                  VALUES ('$name', '$email', '$phone', '$campaign_name', '$type')";
            if (mysqli_query($connection, $sql)) {
              echo "<script>window.alert('Successfully applied for participation!');
              window.location.href='information.php';
              </script>";
              } 
          }
          else {
            echo "<script>alert('Invalid Insertion!')</script>";
          }
        }
      }
    ?>
    <section class="participation-container">
      <div class="participation-content">
        <div class="participation-formBox">
          <h2><u>Campaign Participation Form</u></h2>
          <form action="#" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="campaignID" value="<?php echo $campaignID; ?>">
            <div class="participation-input">
              <label for="campaign_name">Campaign Name</label>
              <input type="text" id="campaign_name" name="campaign_name" value="<?php echo $record['campaign_name']; ?>" readonly>
            </div>
            <div class="participation-input">
              <label>Type</label>
              <select name="type" readonly>
                <option value="0">---Choose Campaign type---</option>
                <option value="1" <?php if($record['type'] == 1) echo 'selected'; ?>>Contest or Giveaway Campaign</option>
                <option value="2" <?php if($record['type'] == 2) echo 'selected'; ?>>Social Media Campaign</option>
                <option value="3" <?php if($record['type'] == 3) echo 'selected'; ?>>Referral Campaign</option>
                <option value="4" <?php if($record['type'] == 4) echo 'selected'; ?>>Content Marketing Campaign</option>
                <option value="5" <?php if($record['type'] == 5) echo 'selected'; ?>>Influencer Marketing Campaign</option>
              </select>
            </div>
            <div class="participation-input">
              <label for="location">Location</label>
              <input type="text" id="location" name="location" value="<?php echo $record['location']; ?>" readonly>
            </div>

            <div class="participation-input">
              <label for="starting_Date">Starting Date</label>
              <input type="date" id="starting_Date" name="starting_Date" value="<?php echo $record['starting_Date']; ?>" readonly>
            </div>
            
            <div class="participation-input">
              <label for="end_date">End date</label>
              <input type="date" id="end_date" name="end_date" value="<?php echo $record['end_date']; ?>" readonly>
            </div>

            <div class="participation-input">
              <label for="fee">Fee</label>
              <input type="text" id="fee" name="fee" value="<?php echo $record['fee']; ?>" readonly>
            </div>
            <div class="participation-input">
              <div>
                <label for="name">name</label>
                <input type="text" id="name" name="name" placeholder="name" autocomplete="off" required>
              </div> <br>
              <div>
                <label for="Email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email" autocomplete="off" required>
              </div><br>
              <div>
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" placeholder="Phone" autocomplete="off" required>
              </div><br>
            </div>
                
            <div class="g-recaptcha" data-sitekey="6LdekKwpAAAAAMcfuV9gokD5yP1YX_FQJoqfsYxA"></div>

            <div class="participation-input">
              <input type="submit" name="btnregister" value="Register">  
            </div>
          </form>
          <a href="information.php" class="already-account">Back</a>
        </div>
      </div>
    </section>  
    <?php
      include('footer.php');
    ?>
    
  <script scr="https://www.google.com/recaptcha/enterprise.js?render=6LdekKwpAAAAAMcfuV9gokD5yP1YX_FQJoqfsYxA"></script>
</body>
</html>
