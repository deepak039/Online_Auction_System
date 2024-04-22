<?php
require('connection.php');
// session_start();
include("header.php");

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

    $user =$_SESSION['username'] ;
    


    $sql = "SELECT ReservationID, serial_no, Username, Status, Timestamp
    FROM reservation
    WHERE Username='$user'";
    
    $result = $con->query($sql);

    // if ($result->num_rows == 1) {
    //     $carDetails = $result->fetch_assoc(); // Fetch the details of the selected car
    // } else {
    //     // Car not found or multiple cars with the same ID (anomaly)
    //     // Handle the error as needed
    // }
  }



  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   
</head>

<body>
<?php include('demo.php');?>


<div class="container mt-5">
    <div class="row">
        <?php
        // Loop through reservation data
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            // Fetch additional data about the buyer and car using buyer_id and car_id
            // $buyerInfo = getBuyerInfo($row['Username']);
            $carInfo = getCarInfo($row['serial_no']);
            
            // Display the data in a card
            // Display the data in a card
echo '<div class="col-md-4">';
echo '<div class="card">';
echo '<div class="card-body">';
echo '<h5 class="card-title">' . $carInfo['carname'] . '</h5>';
echo '<p class="card-text">Status: ' . $row['Status'] . '</p>';
echo '<p class="card-text">price: ' . $carInfo['price'] . '</p>';
echo '<p class="card-text">year: ' . $carInfo['year'] . '</p>';

// Show buttons for pending reservations
if ($row['Status'] === 'Pending') {
    echo '<form method="POST" action="update_reservation.php">';
    echo '<input type="hidden" name="reservationID" value="' . $row['ReservationID'] . '">';
    echo '<button type="submit" name="approve" class="btn btn-success mr-2">Approve</button>';
    echo '<button type="submit" name="reject" class="btn btn-danger">Reject</button>';
    echo '</form>';
}


echo '</div>';
echo '</div>';
echo '</div>';

        }
    }

        // Simulate fetching buyer information from the database based on buyer_id
    //     function getBuyerInfo($buyerID) {
    //         // Fetch buyer info using the buyer ID
    //         // Replace this with your database query
    //         global $con;

    //         $sql = "SELECT `Full_Name`, `Email`, `mobile`, `Adress` FROM `user` WHERE Username ='$buyerID';";
    //         $res = $con->query($sql);

    // if ($res->num_rows == 1) {
    //     $userDetails = $res->fetch_assoc(); // Fetch the details of the selected car
    //     return $userDetails ;
    // }
           
    //     }

        // Simulate fetching car information from the database based on car_id
        function getCarInfo($carID) {
            // Fetch car info using the car ID
            // Replace this with your database query
            global $con;
            $sql = "SELECT `carname`, `price`, `year` FROM `car` WHERE serial_no =$carID";
            $res = $con->query($sql);

    if ($res->num_rows == 1) {
        $carDetails = $res->fetch_assoc(); // Fetch the details of the selected car
        return $carDetails ;
    }
        }
        ?>
    </div>
</div>
    </div>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



</body>
</html>
