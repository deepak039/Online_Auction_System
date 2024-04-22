



<?php
// Assuming you have a database connection established
require('connection.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    session_start(); // Start the session if not already started

    $carID = $_SESSION["serial_no"]; // Retrieve car ID from session
    $buyerID = $_SESSION["username"]; // Assuming you have a session variable for the buyer's ID
   
    // Prepare the query for inserting into the Reservation table
    $query = "INSERT INTO reservation (serial_no, Username, Status, Timestamp)
              VALUES ('$carID', '$buyerID', 'Pending', NOW())";

    // Execute the query and check if insertion was successful
    if (mysqli_query($con, $query)) {
        echo "success";
    } else {
        echo "error";
    }

    // Close the database connection
    mysqli_close($con);
} else {
    echo "invalid_request";
}
?>


