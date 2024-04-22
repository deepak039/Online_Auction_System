

<?php
require('connection.php');
require('check.php');
// include("header.php");
// session_start();
// if (!isset($_SESSION['user'])) {
//     echo"
//   <script>
//     alert('User not registered');
//     window.location.href='index.php';
//   </script>
// ";
// }



?>


<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Marketplace</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Font Awesome CSS for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">

  
    <style>
      /* Custom styles */
      .navbar {
        background-color: #333;
        padding: 10px 0;
      }
      .navbar-toggler {
        border: 2px solid white;
      }
      .navbar-nav .nav-item .nav-link {
        font-weight: bold;
        font-size: 18px; /* Increased font size */
        margin-right: 20px; /* Increased margin */
        color: #fff; /* White color for contrast */
      }
      /* Custom CSS for the offers dashboard */
      body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 20px;
        }
        .card {
            margin-bottom: 20px;
            border: 1px solid #e1e1e1;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }
        .card:hover {
            transform: scale(1.02);
        }
        .card-img-top {
            max-height: 200px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .card-body {
            padding: 20px;
        }
        .car-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .offer-details {
            font-size: 16px;
            margin-bottom: 10px;
        }
        .btn-accept, .btn-reject {
            font-size: 16px;
            margin-right: 10px;
        }
        .favorite-icon.clicked {
    color: red; /* You can change the color to your preferred color */
}
/* CSS to position the favorite icon at the top-right corner */
.favorite-icon{
    position: absolute;
    top: 6px;
    right: 6px;
}
      
       
    
    
    </style>




  </head>
  <body>
  <?php include('header.php');?>

  <!-- Homepage Content Section -->
<section class="container mt-4">
    <div class="row">
      <div class="col-lg-6">
        <h1>Welcome to CarMarketplace</h1>
        <p class="lead">Discover, Buy, and Sell Old Cars Online</p>
        <p>Find your dream vintage or classic car, or sell your beloved vehicle to a fellow enthusiast. CarMarketplace is the ultimate destination for all things automotive.</p>
        <p>Explore a curated selection of pre-owned vehicles, connect with sellers, and make informed decisions with detailed listings and secure communication.</p>
        <a href="#browse" class="btn btn-primary">Start Exploring</a>
      </div>
      <div class="col-lg-6">
        <!-- Placeholder for featured car image -->
        <img src="R.jpg" alt="Featured Car" class="img-fluid">
      </div>
    </div>
  </section>
  

  <!-- Featured Listings -->

  <section class="container mt-4">
  <h2>Featured Listings</h2>
  <div class="row">
    <?php
    //  $_SESSION['logged_in']=true;
    ?>
      <?php
      if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != true) {
        
      
        echo"
        <script>
          alert('User not registered');
          window.location.href='index.php';
        </script>
      ";
                 
      
              
                 
          }

      if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
        $sql = "SELECT * FROM car WHERE serial_no NOT IN (SELECT serial_no FROM reservation WHERE Status IN ('Approved', 'Pending')) ORDER BY serial_no DESC";
        $result = $con->query($sql);
      
      
                 
      
              
                 
          }

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            
            
            $_SESSION['detail']=$row['serial_no'];
              echo '
              <div class="col-md-4">
    <div class="card">
        <img class="card-img-top" src="product_images/' . $row['image'] . '" alt="Car Image">
        <div class="card-body">
        <a href="#" class="btn btn-link favorite-icon">
                            <i class="fas fa-heart fa-2x" ></i>
                        </a>
            <h5 class="car-title">' . $row['carname'] . '</h5>
            <p class="offer-details">Price: Rs ' . $row['price'] . '</p>
           
            <div class="text-center">
                <a href="details.php?serial_no=' . $row['serial_no'] . '" class="btn btn-success btn-accept">View Detailss</a>
              
            </div>
        </div>
    </div>
</div>';;



      





          
          }
      } else {
          echo "No results found.";
      }
      ?>
  </div>
</section>

<footer class="bg-dark text-light py-4">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h5>About Car Marketplace</h5>
        <p>We provide a platform for buying and selling old cars. Find your dream car or list your car for sale today!</p>
      </div>
      <div class="col-md-4">
        <h5>Contact Us</h5>
        <p>Email: info@carmarketplace.com</p>
        <p>Phone: +123-456-7890</p>
      </div>
      <div class="col-md-4">
        <h5>Follow Us</h5>
        <ul class="list-unstyled">
          <li><a href="#"><i class="bi bi-facebook"></i> Facebook</a></li>
          <li><a href="#"><i class="bi bi-twitter"></i> Twitter</a></li>
          <li><a href="#"><i class="bi bi-instagram"></i> Instagram</a></li>
        </ul>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-12 text-center">
        <p>&copy; 2023 Car Marketplace. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
        document.addEventListener("DOMContentLoaded", function () {
            // Get all the favorite icons
            const favoriteIcons = document.querySelectorAll(".favorite-icon");
    
            // Add a click event listener to each favorite icon
            favoriteIcons.forEach(function (icon) {
                icon.addEventListener("click", function (event) {
                    event.preventDefault();
    
                    // Toggle the clicked state
                    const isClicked = icon.getAttribute("data-clicked") === "true";
                    icon.setAttribute("data-clicked", !isClicked);
    
                    // Toggle the color class to change the color
                    icon.classList.toggle("clicked");
                });
            });
        });
    </script>

</body>
</html>
