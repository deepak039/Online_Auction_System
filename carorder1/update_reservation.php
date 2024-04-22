<?php
require('connection.php'); // Include your database connection

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $reservationID = $_POST["reservationID"];

    if (isset($_POST["approve"])) {
        // Update the reservation status to "Approved" in the database
        $updateQuery = "UPDATE reservation SET Status = 'Approved' WHERE ReservationID = $reservationID";
        mysqli_query($con, $updateQuery);
    } elseif (isset($_POST["reject"])) {
        // Update the reservation status to "Rejected" in the database
        $updateQuery = "UPDATE reservation SET Status = 'Rejected' WHERE ReservationID = $reservationID";
        mysqli_query($con, $updateQuery);
    }

    // Redirect back to the dashboard after processing
    header("Location: dashboard.php");
    exit();
}
?>

