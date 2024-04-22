<?php
require('connection.php');
session_start();


if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    //  if (isset($_GET['serial_no'])) {
    //     // $carId =$_SESSION['detail'] ;
    //     $carId = $_GET['serial_no'];



    //     $sql = "SELECT * FROM car WHERE serial_no = $carId";
    //     $result = $con->query($sql);

    //     if ($result->num_rows == 1) {
    //       echo "car details found";
    //         $carDetails = $result->fetch_assoc(); // Fetch the details of the selected car
    //     } else {
    //         // Car not found or multiple cars with the same ID (anomaly)
    //         // Handle the error as needed
    //         echo "car details not found";

    //     }
    // } 

    // $carId =$_SESSION['detail'] ;
    $carId=$_REQUEST['serial_no'];
    $_SESSION['serial_no']=$carId;


    $sql = "SELECT * FROM car WHERE serial_no = $carId";
    $sql1="SELECT  `Full_Name`, `Email`,  `mobile`, `Adress` FROM `user` WHERE  Username =(SELECT Username FROM car WHERE serial_no = $carId)";

    $result = $con->query($sql);
    $result1 = $con->query($sql1);
   

    if ($result->num_rows == 1){
        $carDetails = $result->fetch_assoc(); // Fetch the details of the selected car
    } 
    if ($result1->num_rows == 1){
        $SellerDetails = $result1->fetch_assoc(); // Fetch the details of the selected car
    }
    else {
        // Car not found or multiple cars with the same ID (anomaly)
        // Handle the error as needed
        echo "cardetails no found";

        
    }
  }
  else{
    echo "notlog in";
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
      
    /* Custom CSS for the car details page */

    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
    }

    .tnt {
        background-color: #fff;
        padding: 20px;
        margin-top: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
    }

    .car-image {
        max-width: 100%;
        height: 400px; /* Increased height for the image */
        object-fit: cover; /* Maintain aspect ratio and cover the container */
        border-radius: 5px;
    }

    .make-offer-button {
        margin-top: 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        font-size: 18px;
        border-radius: 5px;
        cursor: pointer;
    }

    .make-offer-button:hover {
        background-color: #0056b3;
    }

    .car-details-container {
        padding: 20px;
    }

    .car-title {
        font-size: 32px;
        margin-top: 0;
        color: #333;
    }

    .car-specifications {
        margin-top: 20px;
    }

    .car-specifications h2 {
        font-size: 24px;
    }

    .car-specifications ul {
        list-style-type: none;
        padding: 0;
    }

    .car-specifications li {
        margin-bottom: 10px;
        font-size: 18px;
    }

    .car-description {
        margin-top: 20px;
    }

    .car-description h2 {
        font-size: 24px;
    }

    .car-description p {
        font-size: 18px;
        line-height: 1.5;
    }

    .car-contact {
        margin-top: 20px;
    }

    .toggle-contact {
        cursor: pointer;
        font-size: 24px;
        color: #007bff;
        text-decoration: underline;
    }

    .contact-info {
        display: none;
        margin-top: 20px;
    }

    .contact-info p {
        font-size: 18px;
        margin: 5px 0;
    }

    .contact-info-button {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        font-size: 18px;
        border-radius: 5px;
        cursor: pointer;
        display: block;
        margin-top: 20px;
    }

    .contact-info-button:hover {
        background-color: #0056b3;
    }
    .reserve-text{
        padding: 10px;
        margin: 10px;
        color: rgb(41, 6, 13);
        font-size: 25px;;
        
    }


      
      
    
    </style>




  </head>
  <body>
  <?php include('header.php');?>

<?php 
  
  if (isset($carDetails)) {
    
      
    echo '<div class="container tnt">
        <div class="row">
            <div class="col-md-6">
                <img class="car-image" src="product_images/' . $carDetails['image']. '" alt="Car Image">
                
                <p class="reserve-text">Interested in purchasing this car? You can place a reserve to secure your chance to buy.</p>
                <button class="btn btn-primary make-offer-button " onclick="placeReservation(this)">Place a Reserve</button>
            </div>
            <div class="col-md-6 car-details-container">
                <h1 class="car-title">' . $carDetails['carname']. '</h1>
                <div class="car-specifications">
                    <h2>Specifications</h2>
                    <ul>
                    <li><strong>Model:</strong> ' . $carDetails['model']. '</li>
                    <li><strong>Year:</strong> ' . $carDetails['year']. '</li>
                    <li><strong>Mileage:</strong> ' . $carDetails['milage']. '</li>
                    <li><strong>Condition:</strong>' . $carDetails['cond']. '</li>
                        <!-- Add more specifications as needed -->
                    </ul>
                </div>
                <div class="car-description">
                    <h2>Description</h2>
                    <p>' . $carDetails['Description']. '</p>
                </div>
                <div class="car-contact">
                    <h2 class="toggle-contact">Seller Contact Info</h2>
                    <div class="contact-info">
                        <p>Seller Name: ' . $SellerDetails['Full_Name']. '</p>
                        <p>Email:' . $SellerDetails['Email']. '</p>
                        <p>Phone: ' . $SellerDetails['mobile']. '</p>
                        <!-- Add more contact information as needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>';;












} else {
    echo "No results found.";
}
?>


</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
   function placeReservation(buttonElement) {
    $.ajax({
        url: "reserve_car.php", // Replace with your backend script URL
        type: "POST",
        
        success: function(response) {
          console.log(response); 
          console.log("Response:", response); // Log the actual response received
    console.log("Length:", response.length); // Log the length of the response
    console.log("Type of response:", typeof response); 
            if (response.trim() === "success") {
                // Update button label and disable it
                $(buttonElement).text("Pending Request").prop("disabled", true);
                alert("Reservation placed successfully!");
            } else {
                alert("Failed to place reservation. Please try again.");
            }
        },
        error: function() {
            alert("An error occurred while processing your request.");
        }
    });

    // Move the console.log statement inside the data object
    console.log("URL: " + "reserve_car.php" + ", Type: " + "POST");
}
        // Move the console.log statement inside the data object
     
</script>
    <script>
        // JavaScript to toggle the visibility of contact info
        document.querySelector('.toggle-contact').addEventListener('click', function() {
            const contactInfo = document.querySelector('.contact-info');
            contactInfo.style.display = contactInfo.style.display === 'none' ? 'block' : 'none';
        });
    </script>
</html>
























