<?php
require('connection.php');
session_start();
// include("header.php");

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
    


    $sql = "SELECT ReservationID, serial_no, Username, Status,remark, Timestamp
    FROM reservation
    WHERE serial_no IN (SELECT serial_no FROM car WHERE Username = '$user')
    AND Status = 'Rejected'
    ";
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
  height: 80vh;
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


<div class="container cnt mt-5">
    <h1 class="mb-4">Car Order Dashboard</h1>
    
    <!-- Table to display car orders -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Car Model</th>
                <th>Consumer Name</th>
                <th>Consumer Address</th>
                <th>Status</th>
                <th>Comment</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Loop through reservation data
        
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            // Fetch additional data about the buyer and car using buyer_id and car_id
            $buyerInfo = getBuyerInfo($row['Username']);
            $carInfo = getCarInfo($row['serial_no']);
            
            // Display the data in a card
            // Display the data in a card


            echo "<tr>";
            echo "<td>" . $row['ReservationID'] . "</td>";
            echo "<td>" . $carInfo['carname'] . "</td>";
            echo "<td>" . $buyerInfo['Full_Name'] . "</td>";
            echo "<td>" .  $buyerInfo['Adress'] . "</td>";
            echo "<td>" . $row['Status'] . "</td>";
            echo "<td>" . $row['remark'] . "</td>";

            echo '<td class="timestamp">' . $row['Timestamp'] . '</td>';
            
            
            
            
            echo "</tr>";
            
            
            
            
            
            
                    
                    
                
            

        }
    }

        // Simulate fetching buyer information from the database based on buyer_id
        function getBuyerInfo($buyerID) {
            // Fetch buyer info using the buyer ID
            // Replace this with your database query
            global $con;

            $sql = "SELECT `Full_Name`, `Email`, `mobile`, `Adress` FROM `user` WHERE Username ='$buyerID';";
            $res = $con->query($sql);

    if ($res->num_rows == 1) {
        $userDetails = $res->fetch_assoc(); // Fetch the details of the selected car
        return $userDetails ;
    }
           
        }

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
