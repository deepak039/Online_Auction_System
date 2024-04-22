<?php
require('connection.php');
session_start();

if (!isset($_SESSION['user'])) {
    echo"
  <script>
    alert('User not registered');
    window.location.href='index.php';
  </script>
";
}

?>