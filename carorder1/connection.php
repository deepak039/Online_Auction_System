<?php

$con=mysqli_connect("localhost","root","1234","carorder");

if(mysqli_connect_error()){
    echo"<script>alert('cannot connect to database');</script>";
    exit();
}

?>