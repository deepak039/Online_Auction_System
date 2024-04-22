<?php
   $con=mysqli_connect("localhost","root","","social_site");
   if(mysqli_connect_error()){
       echo"<script>alert('cannot connect to database');</script>";
       exit();
   }

   if(isset($_GET['email'])&& isset($_GET['v_code'])){
    $query="SELECT * FROM user WHERE Email='$_GET[email]' AND verification_code='$_GET[v_code]'";
    $result=mysqli_query($con,$query);
    if($result){
        if(mysqli_num_rows($result)==1){
            $result_fetch=mysqli_fetch_assoc($result);
            if($result_fetch['is_verified']==0){
                $update="UPDATE user SET is_verified='1' WHERE Email='$result_fetch[Email]'";
                if(mysqli_query($con,$update)){
                    echo"
                        <script>
                            alert('Email verification successful');
                            window.location.href='index.php';
                        </script>
                    ";
                }
                else{
                    echo"
                        <script>
                            alert('cannot run query');
                            window.location.href='index.php';
                        </script>
                    ";
                }
            }
            else{
                echo"
                    <script>
                        alert('Email already registered');
                        window.location.href='index.php';
                    </script>
                ";
            }
        }
    }
    else{
        echo"
            <script>
                alert('cannot run query');
                window.location.href='index.php';
            </script>
        ";
    }



   }
?>