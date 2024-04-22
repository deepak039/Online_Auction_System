

<?php
require('connection.php');
// include("header.php");
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    $user = $_SESSION['username'];
  $sql = "SELECT carname, Username, model, price, Description, image, serial_no FROM car WHERE Username ='$user'";

  $result = $con->query($sql);
$sql = "SELECT * FROM car";
$result = $con->query($sql);


           

        
           
    }

?>


  <!-- Homepage Content Section -->

  

  <!-- Featured Listings -->
  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Font Awesome CSS for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
      /* Custom styles */
      .navbar {
        background-color: #333;
        padding: 10px 0;
        /* z-index: 1001; */
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
      
      /* Sidebar Styles */
      body {
  margin: 0;
  padding: 0;
}

.sidebar {
  height: auto;
  padding-top: 20px;
  background-color: #333; /* Set background color */
}

.sidebar h1 {
  color: #fff;
  margin-bottom: 20px;
  padding: 0 20px;
}

.nav-item {
  margin-bottom: 10px;
}

.nav-link {
  color: #fff;
  padding: 10px 20px;
  border-radius: 5px;
}

.nav-link:hover {
  background-color: #555; /* Add hover background color */
}

.dropdown-menu {
  background-color: #333;
}

.dropdown-item {
  color: #fff;
}

.main-content {
  padding: 20px;
}
     
    
    
    </style>
   
</head>

<body>
<?php include('header.php');?>
<?php include('demo.php');?>

  <section class="container mt-4">
  <h2>Your Listed Item</h2>
  <div class="row">
    <?php
     $_SESSION['logged_in']=true;
    ?>
      <?php
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            
            
            $_SESSION['detail']=$row['serial_no'];
              echo '<div class="col-md-4 mb-4">
              <div class="card">
                  <img src="product_images/' . $row['image'] . '" class="card-img-top" alt="Car Image" width="300" height="200">
                  <div class="card-body">
                      <h5 class="card-title">' . $row['carname'] . ' ' . $row['model'] . '</h5>
                      <p class="card-text">Year: 1997 | Price: Rs ' . $row['price'] . '</p>
                      
                      <a href="details.php" class="btn btn-primary">Edit detais</a>
                    
                      <a href="?delete=true&serial=' . $row['serial_no'] . '" class="btn btn-secondary">Delete Item</a>                      
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add a click event listener to all "Delete Item" links
    var deleteLinks = document.querySelectorAll('.btn-secondry');
    deleteLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior
            var serialNo = link.getAttribute('serial'); // Get the serial number from the link's data attribute
            
            // Trigger the delete operation via a URL parameter
            window.location.href =self_listed.php'?delete=true&serial=' + serialNo;
        });
    });
});


<?php
// Check if the "Delete Item" link was clicked
if (isset($_GET['delete']) && $_GET['delete'] == 'true') {
    

    if (isset($_GET['serial'])) {
        $serialNo = $_GET['serial'];

        // Perform the delete operation
       

        $deleteQuery = "DELETE FROM car WHERE serial_no = '$serialNo'";
        $result = $con->query($deleteQuery);

        if ($result) {
            // Item deleted successfully, you can choose to redirect or refresh
            header("Location: your_page.php"); // Replace with your actual page name
            exit();
        } else {
            echo "Error deleting item: " . $con->error;
        }

        
    } else {
        echo "Invalid request.";
    }
}
?>

<!-- Your HTML and PHP code -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add a click event listener to all "Delete Item" links
    var deleteLinks = document.querySelectorAll('.btn-secondry');
    deleteLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior
            var serialNo = link.getAttribute('data-serial'); // Get the serial number from the link's data attribute
            
            // Trigger the delete operation via a URL parameter
            window.location.href = '?delete=true&serial=' + serialNo;
        });
    });
});
</script>





</script>

<!-- <footer class="bg-dark text-light py-4">
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
</footer> -->

