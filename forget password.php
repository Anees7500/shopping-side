
<h3>Request for new password</h3>
<hr>
<p>Enter your Email address</p>
<form action="" method="post">
<input type="email" name="recovery_email" placeholder="Enter your email" required/><br><br/>
    <input type="submit" name="lost_passowrd" value="Request new password"/>
</form>
<?php
if(isset($_POST["lost_password"])){
  $email = mysqli_real_escape_string($ab->con,$_POST["reovery_email"]);
    $sql = "SELECT id,note FROM user_info WHERE u_email = '$email' LIMIT 1";
    $query =mysqli_query($ab->con,$sql);
    if(mysqli_num_rows($query) == 1){
        $row = mysqli_fetch_array($query);
         $uid = $row["id"];
        $note = $row["note"];
        if($note != ""){
            echo"Please check your email address we have already sended you a password reset link";
            exit();
        }else{
            $random_note = time().rand(50000,100000);
            $random_note = str_shuffle($random_note);
            $update_note = "UPDATE user_info SET note ='$random_note' WHERE id='$uid' AND u_email ='$email'";
            if(mysqli_query($ab->con,$update_note)){
                 $to = $email;
        $sub = "Reset Password";
        $msg = "please click on the given link or copy url to reste your password<br/>";
        $msg ="mohdaneesmca@gmail.com/password_reset.php?note=".$random_note."uid=".$uid."&email=".$email;
        if(mail($to,$sub,$msg)){
        echo"please confirm your email to reset your password<br/>";
            echo"Email temporarily Displayed here<br/>".$msg;
        exit();
            
        }  
        }  
            }
     
       
        
    }else{
        echo"Your email address not exits";
    }
}
?>