<?php
require('connection.php');
// session_start();
require('check.php');


   

?>


  
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">
        <!-- <a class="navbar-brand" href="#">
          <img src="logo.png" alt="Car Marketplace Logo" width="40" height="40">
        </a> -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="home.php">
                <i class="fas fa-home"></i> Home
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="fas fa-search"></i> Browse
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="sell.php">
                <i class="fas fa-car"></i> Sell a Car
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                 data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i> <?php echo ($_SESSION['username'])?>
              </a>
              <div class="dropdown-menu" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="dashboard.php">Dashboard</a>
                
                <a class="dropdown-item" href="profile.php">Profile</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>



