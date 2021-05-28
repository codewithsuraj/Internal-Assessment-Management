

<?php
	session_start();
     $db = mysqli_connect('localhost', 'root', '', 'vtu');

     if(isset($_POST['reset'])) {
          $email = $_SESSION['email'];	
          $pass = $_POST['pass'];
          $cpass = $_POST['cpass'];
          if($pass == $cpass) {
               $password = base64_encode($pass);
               $q1 = "UPDATE staffs SET password = '$password' WHERE email = '$email'";
               $q2 = "UPDATE students SET password = '$password' WHERE email = '$email'";
               $r1 = mysqli_query($db, $q1);
               $r2 = mysqli_query($db, $q2);
               if($r1 OR $r2 ) {
                    echo "<script type='text/javascript'>
                              alert('Password is changed successfully'); location.replace('http://localhost/suraj/');
                         </script>";
               }
          } else echo "<h1 class='error' >Password Doesn't Matched</h1>";
     }
?>


<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Reset Password</title>
     <link rel="stylesheet" href="css/reset.css">
</head>
<body>
     <div class="container">
          <h1>Reset Password</h1> 
          <form method="POST">
               <input class="input inputField" type="password" placeholder="New Passsword" name="pass">
               <input class="input inputField" type="password" placeholder="Confirm Passsword" name="cpass">
               <input class="input inputSub" type="submit" name="reset" value="Reset">
          </form>
     </div>
     
</body>
</html>