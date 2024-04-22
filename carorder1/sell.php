






<?php
require('connection.php');
// session_start();
// include("header.php");
require('check.php');
// if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != true){
// echo"not loged in";
// echo"<script>
// alert('Wrong Email');
// window.location.href='index.html';
// </script>";


// }

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
  echo"loged in";
    // Define variables
    $user = $_SESSION['username'];

    if (isset($_REQUEST['insert_product'])) {
        $name = $_REQUEST['make'];
        $disc = $_REQUEST['des'];
        $price = $_REQUEST['price'];
        $model = $_REQUEST['model'];
        $year =$_REQUEST['year'];
        $milage=$_REQUEST['milage'];
        $cond=$_REQUEST['cond'];
        
        $file = $_FILES['img[]'];
        print_r($file);

        

        $true = false;

        for ($i = 0; $i < count($_FILES['img']['name']); $i++) {
            $fileName = $_FILES['img']['name'][$i];
            $fileTmpName = $_FILES['img']['tmp_name'][$i];
            $fileSize = $_FILES['img']['size'][$i];
            $fileError = $_FILES['img']['error'][$i];
            $fileType = $_FILES['img']['type'][$i];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png', 'jfif');

            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 1000000) {
                        $true = true;
                        // VERIFIES ALL THE NECESSARY CONDITIONS FOR UPLOADING THE FILES
                    } else {
                        $true = false;
                        $error_upload_size_message = $fileName . ", this file is too big, file size should be less than 1 MB";
                        echo "<script type='text/javascript'>alert('$error_upload_size_message');</script>";
                    }
                } else {
                    $true = false;
                    $error_upload_message = "There was an error uploading your file " . $fileName;
                    echo "<script type='text/javascript'>alert('$error_upload_message');</script>";
                }
            } else {
                $true = false;
                $error_upload_type_message = "For file " . $fileName . ", You cannot upload a file of this type (." . $fileActualExt . ")";
                echo "<script type='text/javascript'>alert('$error_upload_type_message');</script>";
            }
        }

        if ($true) {
            for ($i = 0; $i < count($_FILES['img']['name']); $i++) {
                $fileName = $_FILES['img']['name'][$i];
                $fileTmpName = $_FILES['img']['tmp_name'][$i];
                $fileSize = $_FILES['img']['size'][$i];
                $fileError = $_FILES['img']['error'][$i];
                $fileType = $_FILES['img']['type'][$i];

                $fileExt = explode('.', $fileName);
                $fileActualExt = strtolower(end($fileExt));
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = "product_images/" . $fileNameNew;

                $query3 = "INSERT INTO car (carname, Username, model, price ,year, milage, cond, Description, image) VALUES ('$name', '$user', '$model', '$price','$year','$milage','$cond', '$disc', '$fileNameNew')";
                if(mysqli_query($con,$query3)){
                  move_uploaded_file($fileTmpName, $fileDestination);
                  echo"
                      <script>
                      alert('Registered successfully inserted value');
                      window.location.href='conf.html';
                      </script>
                  ";
              }
              else{
                  echo"
                      <script>
                      alert('Wrong Email');
                      window.location.href='index.html';
                      </script>
                  ";
              }
                // $con->query($query3);
                // move_uploaded_file($fileTmpName, $fileDestination);
                // header("location: conf.html");
            }
        }
    }
}
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
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
      
      
       
    
    
    </style>




  </head>
  <body>
  <?php include('header.php');?>
  <section class="container mt-4">
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <h2>Sell Your Car</h2>
        <form method="post" enctype="multipart/form-data" action="sell.php" >
          <div class="mb-3">
            <label for="make" class="form-label">Car Name</label>
            <input type="text" class="form-control" id="make" name="make" required>
          </div>
          <div class="mb-3">
            <label for="model" class="form-label">Car Model</label>
            <input type="text" class="form-control" id="model"  name="model" required>
          </div>
          <div class="mb-3">
            <label for="milage" class="form-label">milage</label>
            <input type="text" class="form-control" id="milage"  name="milage" required>
          </div>
          <div class="mb-3">
            <label for="year" class="form-label">Year</label>
            <input type="text" class="form-control" id="year"  name="year" required>
          </div>
          <!-- Include more form fields for other car details like year, price, etc. -->
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="des" rows="4"></textarea>
          </div>
          <div class="mb-3">
            <label for="price" class="form-label">price</label>
            <textarea class="form-control" name="price" id="price" rows="4"></textarea>
          </div>
          <div class="mb-3">
            <label for="cond" class="form-label">Condition Of Car</label>
            <textarea class="form-control" name="cond" id="cond" rows="4"></textarea>
          </div>
          <div class="mb-3">
            <label for="images" class="form-label">Upload Images</label>
            <input type="file" class="form-control"name="img[]" id="images" multiple>
            <small class="form-text text-muted">Upload high-quality images to showcase your car.</small>
          </div>
          <button type="submit" name="insert_product" class="btn btn-primary">Submit Listing</button>
        </form>
      </div>
    </div>
  </section>

  <!-- Include Bootstrap JS and other scripts -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> -->
