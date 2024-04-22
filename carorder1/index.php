<?php
  require('connection.php');
  session_start();

?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <div class="back">
    <div class="container">
      <h1>Login</h1>
      <form method="POST" action="login.php">
        <label for="email">E-Mail:</label>
        <input type="text" id="email" name="email" required name="email">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required name="password">
        <button type="submit" name="login">Login</button>
      </form><br>
      <p>New user? <a href="register.html">Create an account</a></p>
      <a href="#">Forgot Password?</a>
    </div>
  </div>

</body>

</html>