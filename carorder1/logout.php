<?php
session_start();
session_destroy();
header("Location: index.php"); // Change 'index.php' to your desired page
exit();
?>
