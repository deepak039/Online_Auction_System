<?php

$a=$_POST['username'];
$b=$_POST['full_name'];
$c=$_POST['email'];
$d=$_POST['password'];
$e=$_POST['img'];
$f=$_POST['phone'];


$con=mysqli_connect("localhost","root","1234","carorder");
if(mysqli_connect_error()){
    echo"<script>alert('cannot connect to database');</script>";
    exit();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($c,$v_code){
    require ("PHPMailer/PHPMailer.php");
    require ("PHPMailer/SMTP.php");
    require ("PHPMailer/Exception.php");
    $mail = new PHPMailer(true);

    try {                    //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'akabanek193@gmail.com';                     //SMTP username
        $mail->Password   = 'ztpjxghykubgkrbo';                                //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        $mail->setFrom('akabanek193@gmail.com', 'Karma');
        $mail->addAddress($c);    
       
        

        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Email Verification from Server';
        $mail->Body    = "Thanks for registration!
        Click the link below to verify the email address
        <a href='http://localhost/SE/verify.php?email=$c&v_code=$v_code'>Verify</a>";
        
    
        $mail->send();
        return true;
    } 
    catch (Exception $e) {
       return false;
    }
}

    $user_exist_query="SELECT * FROM user WHERE Username='$a' OR Email='$c'";
    $result=mysqli_query($con, $user_exist_query);
    

    if(mysqli_num_rows($result)){
        $result_fetch=mysqli_fetch_assoc($result);
        if($result_fetch['Username']== $a){
            echo"
              <script>
                alert('Username already taken');
                window.location.href='register.html';
              </script>
            ";                
        }
        else
        {
            echo"
                <script>
                    alert('E-mail already registered');
                    window.location.href='register.html';
                </script>
            ";
        }
    }
    else{
        $password=password_hash($d,PASSWORD_BCRYPT);
        $v_code=bin2hex(random_bytes(16));
        $query="INSERT INTO `user`(`Username`, `Full_Name`, `Email`, `Password`, `verification_code`, `is_verified`, `mobile`, `Adress`) VALUES ('$a','$b','$c','$password','$v_code','0','$f','$e')";
        if(mysqli_query($con,$query) ){
            echo"
                <script>
                alert('Registered successfully Please verify from your email');
                window.location.href='index.php';
                </script>
            ";
        }
        else{
            echo"
                <script>
                alert('Wrong Email');
                window.location.href='index.php';
                </script>
            ";
        }
    }
    

?>