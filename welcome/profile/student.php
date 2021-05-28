<?php
	session_start();
     $db = mysqli_connect('localhost', 'root', '', 'vtu');
     $username = $_SESSION['username'];	

     if(isset($_POST['logout'])) {
          $_SESSION = array();
          session_destroy();
          header('location: ../../index.php');
     }
     
     if(isset($_POST['update'])) {
     	$username = $_SESSION['username'];	
		$name =  $_SESSION['n'] = $_POST['name'];
		$sem = $_POST['sem'];
		$phno = $_POST['phno'];
		$email = $_POST['email'];
          $pemail = $_POST['pemail'];
          $q = "UPDATE students SET name = '$name', sem = '$sem' , phno = '$phno', email = '$email', pemail = '$pemail'  WHERE username = '$username' ";
          $r = mysqli_query($db, $q);
          if(!$r) echo "<h1>Error in updating data</h1>";
		header("refresh: 0.1"); 
     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <title>Document</title>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="../../css/studentDash.css">
	<link rel="stylesheet" href="../../css/sprofile.css">
     

</head>
<body>
     <nav class="navbar navbar-expand-lg navbar-light bg-light ">
		<div class="head1">
			<a class="navbar-brand"> 
				<?php echo $_SESSION['n']; ?>
			</a>
		</div>
		
		<div class="collapse navbar-collapse head2" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item"><a class="nav-link link" href="../student.php">Home</a></li>
				<li class="nav-item"><a class="nav-link link" href="../profile/student.php">Profile</a></li>
				<li class="nav-item"><a class="nav-link link" href="../scheme/sdownload.php">Scheme</a></li>
				<li class="nav-item"><a class="nav-link link" href="../feedback/student.php">Feedback</a></li>
				<li class="nav-item">
                         <form method="POST" action="../../index.php" class="collapse navbar-collapse sform">
                              <input type="submit"class="btn btn-outline-success logout my-2 my-sm-0" name="logout" value="Logout">
                         </form>
					</a>
				</li>
			</ul>
		</div>
     </nav>

     <div class="container">
          <div class="main1">
               <?php
                    $q = "SELECT * FROM students WHERE username = '$username'";
                    $r = mysqli_query($db, $q);	
                    $row = mysqli_fetch_assoc($r);
                    $name = $row['name'];
                    $sem = $row['sem']; 
                    $scheme = $row['scheme'];     
                    $email = $row['email'];       
                    $pemail = $row['pemail'];       
                    $phno = $row['phno'];
                    $branch = $row['branch'];
               ?>


               <form class="updateProfile" method="POST">

                    <div class="form-group">
                         <div class="col-xs-6 shead">
                              <label for="name"><h4 >Full Name</h4></label>
                              <input type="text" minlength="3" class="form-control inputField" name="name" value = <?php echo "'$name'"; ?> id="name" placeholder="Full Name"  required>
                         </div>
                         </div>
                         
                         <div class="form-group">
                         <div class="col-xs-6 shead">
                              <label for="sem"><h4 >Sem</h4></label>
                              <input type="tel" maxlength="1" pattern="[1-8]" class="form-control inputField" name="sem" value = <?php echo "'$sem'"; ?> title ="Sem 1 to 8" id="sem" placeholder="Enter your sem"  required>
                         </div>
                         </div>

                         <div class="form-group ">
                         <div class="col-xs-6 shead">
                              <label for="phone"><h4>Phone</h4></label>
                              <input type="tel" maxlength="10" pattern="\d{10}" title="Enter 10 digit number" class="form-control inputField"  value = <?php echo "'$phno'"; ?> name="phno" id="phone" placeholder="Enter phone" required>
                         </div>
                    </div>
                         
                    <div class="form-group">
                         <div class="col-xs-6 shead">
                              <label for="email"><h4>Student Email </h4></label>
                              <input type="email" class="form-control inputField" name="email"  id="email" value = <?php echo "'$email'"; ?>  placeholder="Enter email" required>
                         </div>
                    </div>
                    <div class="form-group">
                         <div class="col-xs-6 shead">
                              <label for="eemail"><h4>Parent Email </h4></label>
                              <input type="email" class="form-control inputField" name="pemail"  id="pemail" value = <?php echo "'$pemail'"; ?>  placeholder="Enter email" required>
                         </div>
                    </div>
                    
                    <center>
                         <div class="form-group">
                              <div class="col-xs-12">
                                   <input class="btn btn-lg btn-success update" type="submit" name="update" value="Update">
                              </div>
                         </div>
                    </center>
                    
                    
               </form>
          </div>
     </div>
</body>
</html>