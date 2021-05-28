<?php
     session_start();
     $username = $_SESSION['username'];	
     
     if(isset($_POST['logout'])) {
          $_SESSION = array();
          session_destroy();
          header('location: ../../index.php');
     }

     $db = mysqli_connect('localhost', 'root', '', 'vtu');
     $username = $_SESSION['username'];	
     if(isset($_POST['sendFeedback'])) {
		$staffID = $_POST['staffID'];
		$message = $_POST['message'];
		$q = "INSERT INTO feedback VALUES('$staffID', '$message')";
		$r = mysqli_query($db, $q);
		if($r) {echo "Feedback sent";}
		else {echo 'error'.mysqli_error($db);}
	}


?>


<!DOCTYPE html>
<html lang="en">
<head>
     <title>Feedback</title>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="../../css/staffDashboard.css">
	<link rel="stylesheet" href="../../css/feedback.css">
</head>


<body>
     <nav class="navbar navbar-expand-lg navbar-light bg-light ">
		<div class="head1">
			<a class="navbar-brand"> 
				<?php
					
						echo $_SESSION['n']; 
						// Display Admin
						$admin = $_SESSION['admin'];
						if($admin) {
							echo "<a id='admin' href='../create.php'>Admin</a>";
						}
				?>
			</a>
		</div>
		
		<div class="collapse navbar-collapse head2" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item"><a class="nav-link link" href="../staff.php">Home</a></li>
				<li class="nav-item"><a class="nav-link link" href="../profile/staff.php">Profile</a></li>
				<li class="nav-item"><a class="nav-link link" href="../scheme/upload.php">Scheme</a></li>
				<li class="nav-item"><a class="nav-link link" href="../feedback/staff.php">Feedback</a></li>
				<form method="POST" action="../staff.php" class="collapse navbar-collapse sform" >
					<li class="nav-item dropdown">
						<select name="scheme" id="" class="nav-link dropdown-toggle"  id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown1">
								<option value="">Scheme</option>
								<option value="2016">2016</option>
								<option value="2017">2017</option>
								<option value="2018">2018</option>
							</div>
						</select>
					</li>
					<li class="nav-item dropdown sem">
						<select name="sem" id="" class="nav-link dropdown-toggle"  id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown2">
								<option value="">Sem</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
							</div>
						</select>
					</li>
					<input type="submit" class="btn btn-outline-success go my-2 my-sm-0" name="go" value="Go">
				</form>

				<li class="nav-item">
					<a class="nav-link link" href="profile/staff.php">
						<form method="POST" action="../../index.php" class="collapse navbar-collapse sform">
							<input type="submit"class="btn btn-outline-success logout my-2 my-sm-0" name="logout" value="Logout">
						</form>
					</a>
				</li>
			</ul>
		</div>
     </nav>

     <div class="container">
          <?php
               $q = "SELECT grade FROM feedback WHERE staffID = '$username'";
               $r = mysqli_query($db, $q);
               $totalGrade = 0; $i = 0; $avg = 0;
               if(!$r) {echo "NO Feedbacks";}
               else {
                    while ($row = mysqli_fetch_assoc($r)) {
                         $totalGrade += $row['grade'];
                         $i++;
				}
				if($i != 0) $avg = $totalGrade/$i;
                    echo "<h1 class='feedback'>Total points out of <span> 5 </span> is <span> $avg </span> </h1>";
               }
          ?>

     </div>
     
     

</body>
</html>