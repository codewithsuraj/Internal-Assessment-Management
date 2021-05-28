<?php
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'vtu');
     if(isset($_POST['sendMail'])) {
          $email = $_SESSION['email'] =$_POST['email'] ;
          $q = "SELECT email FROM staffs WHERE email = '$email'
                    UNION
                SELECT email FROM students WHERE email = '$email'";
          $r = mysqli_query($db, $q);
          if(mysqli_num_rows($r) != 1) echo "<h1 class='error' >User Doesn't Exist</h1>";
          else {
               $header = 'From: mail2surajmahendrakar@gmail.com'."\r\n".'MIME-Version: 1.0'."\r\n".'Content-Type: text/html; charset=utf-8';
               $subject = "Forgot Password";
               $toEmail = $email;
               $body = "<a href ='http://localhost/suraj/reset.php'>Click here to reset your password</a>";
               $res = mail($toEmail, $subject, $body, $header);
               if($res) {
                    echo "<script type='text/javascript'>
                              alert('Mail has been sent to $toEmail'); location.replace('https://mail.google.com');
                         </script>";
               }
               else echo "<h1 class='error' >Error in sending mail</h1>";
          }
     }

     
?>


<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Forgot Password</title>
     <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
     <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
     <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
     <link rel="stylesheet" href="css/forgot.css">
</head>
<body>

    
     <div class="form-gap"></div>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Forgot Password?</h2>
                  <p>You can reset your password here.</p>
                  <div class="panel-body">
    
                    <form method="POST">
    
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input name="email" placeholder="Email Address" class="form-control inputField"  type="email" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <input class="btn btn-lg btn-primary btn-block subbtn" name="sendMail" value="Reset Password" type="submit">
                      </div>

                      
                    </form>

                    <a class="backbtn" href="index.php">Back</a>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
	</div>
</div>
     
</body>
</html>