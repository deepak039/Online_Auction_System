<?php

$a=$_POST['login'];
$b=$_POST['password'];
$c=$_POST['email'];

$con=mysqli_connect("localhost","root","1234","carorder");
if(mysqli_connect_error()){
    echo"<script>alert('cannot connect to database');</script>";
    exit();
}
session_start();

// if(isset($a)){
    $query="SELECT * FROM user WHERE Email='$c' OR  Username='$c'";
    $result=mysqli_query($con,$query);

    if(mysqli_num_rows($result)){
        $result_fetch=mysqli_fetch_assoc($result);
        
        if($result_fetch['Username']== $c OR $result_fetch['Email']== $c){
          if($result_fetch['is_verified']==1){
            if(password_verify($b,$result_fetch['Password'])){
              // if($b==$result_fetch['Password']){
              $_SESSION['logged_in']=true;
              $_SESSION['username']=$result_fetch['Username'];
              $_SESSION['email']=$result_fetch['Email'];
              $_SESSION['img']=$result_fetch['image'];
              $_SESSION['phone']=$result_fetch['mobile'];
              header("location: sell.php");
            }
            else{
              echo"
                <script>
                  alert('password wrong');
                  window.location.href='index.php';
                </script>
              ";
            } 
          }
          else{
            echo"
              <script>
                alert('Email not verified');
                window.location.href='index.php';
              </script>
            ";
          }
                        
        }
        else{
          echo"
              <script>
                alert('Email not registered');
                window.location.href='index.php';
              </script>
            ";
        }
    }
// }

?>
