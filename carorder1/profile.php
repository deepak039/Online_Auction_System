<?php
  require('connection.php');
  include("header.php");
  // session_start();

?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Car Marketplace</title>
  <-- Include Bootstrap CSS -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body> -->
  <!-- Navigation Bar -->
  <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="#">Car Marketplace</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="brouse.html">Browse</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="sell.php">Sell a Car</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="profile.php">profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav> --> 
    <div class="container">
        <div class="profile">
            <img src=
            
            <?php
              if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true){
                echo"$_SESSION[img]";
              }
            ?>
            
            alt="Profile Picture">
            <h1>

            <?php
              if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true){
                echo"$_SESSION[username]";
              }
            ?>

            </h1>
            <h3>Scheme</h3>
            <hr>
            <p></p>
            <ul>
                <li><strong>Email:</strong>
                
                <?php
                    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true){
                        echo"$_SESSION[email]";
                    }
                ?>

                </li>
                <li><strong>Phone:</strong> 
                
                <?php
                    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true){
                        echo"$_SESSION[phone]";
                    }
                ?>
                
                </li>
                
                <a href="index.php">Logout</a>
            </ul>
        </div>
    </div>
</body>
</html>
