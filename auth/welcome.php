<?php
require_once '../auth/config.php';

// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);

  // get profile info
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $userinfo = [
    'email' => $google_account_info['email'],
    'first_name' => $google_account_info['givenName'],
    'last_name' => $google_account_info['familyName'],
    'gender' => $google_account_info['gender'],
    'full_name' => $google_account_info['name'],
    'picture' => $google_account_info['picture'],
    'verifiedEmail' => $google_account_info['verifiedEmail'],
    'token' => $google_account_info['id'],
  ];

  // checking if user is already exists in database
  $sql = "SELECT * FROM users WHERE email ='{$userinfo['email']}'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    // user is exists
    $userinfo = mysqli_fetch_assoc($result);
    $token = $userinfo['token'];
  } else {
    // user is not exists
    $sql = "INSERT INTO users (email, first_name, last_name, gender, full_name, picture, verifiedEmail, token) VALUES ('{$userinfo['email']}', '{$userinfo['first_name']}', '{$userinfo['last_name']}', '{$userinfo['gender']}', '{$userinfo['full_name']}', '{$userinfo['picture']}', '{$userinfo['verifiedEmail']}', '{$userinfo['token']}')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $token = $userinfo['token'];
    } else {
      echo "User is not created";
      die();
    }
  }

  // save user data into session
  $_SESSION['user_token'] = $token;
} else {
  if (!isset($_SESSION['user_token'])) {
    header("Location: index.php");
    die();
  }

  // checking if user is already exists in database
  $sql = "SELECT * FROM users WHERE token ='{$_SESSION['user_token']}'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    // user is exists
    $userinfo = mysqli_fetch_assoc($result);
  }
}

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Buy And Sell - Profile</title>
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />

    <!-- CSS -->
    <link rel="stylesheet" href="css/styles.css" />
  
  
  </head>
  <body>

  
    <div class="header__wrapper" >


    
      <header id="header">
      <div class="videoHeader">
      <span class="fas fa-arrow-left" style="font-size: 25px; cursor: pointer;" onclick="window.location.href='../index.php';"></span>
        <h3><img src="../assets/plusic.png" alt="Reels" style="vertical-align: middle; width:100px;" /></h3>
        <span class="fas fa-sign-out-alt" style="font-size: 25px; cursor: pointer;" onclick="window.location.href='logout.php';"></span>
      </div>


      </header>
      <div class="cols__container">
        <div class="left__col">
          <div class="img__container">
          <img src="<?= $userinfo['picture'] ?>" id="user-picture" alt="" width="90px" height="90px" crossorigin="anonymous">
            <span></span>
          </div>
          <h2><?= $userinfo['full_name'] ?></h2>
          <p><?= $userinfo['email'] ?></p>
          <nav>
    <button style="
    background: #545454;
    color: #fff;
    border: none;
    padding: 10px 25px;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 20px;
">
        <i class="fab fa-whatsapp"></i> Contact
    </button>
</nav>

          <ul class="about">
            <li><span>4,073,904</span>Views</li>
            <li><span>322</span>Contacts</li>
            <li><span>200,543</span>Likes</li>
          </ul>

 

        </div>
        <div class="right__col">
          <nav>

          </nav>

          <div class="photos" id="photo-container">
    </div>


        </div>
      </div>
    </div>
  </body>
</html>


<script>
        // Fetch images from the server
        fetch('../fetch/profileimg.php')
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('photo-container');
                data.forEach(imagePath => {
                    const img = document.createElement('img');
                    img.src = imagePath;
                    img.alt = 'Photo';
                    container.appendChild(img);
                });
            })
            .catch(error => console.error('Error fetching images:', error));
    </script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.0.1/color-thief.min.js"></script> <!-- Include ColorThief library via CDN -->



<script>
  window.addEventListener('DOMContentLoaded', function() {
    var img = document.getElementById('user-picture');
    var header = document.getElementById('header');
    
    var colorThief = new ColorThief(); // Initialize ColorThief library (make sure to include it in your project)

    img.onload = function() {
      var color = colorThief.getColor(img); // Get the dominant color of the image
      var rgbColor = 'rgb(' + color.join(',') + ')'; // Convert color array to rgb string
      header.style.backgroundColor = rgbColor; // Set header background color
    };

    img.src = '<?= $userinfo['picture'] ?>'; // Set image source
  });
</script>