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
		$name = $_POST['name'];
		$phno = $_POST['phno'];
		$email = $_POST['email'];
          $q = "UPDATE staffs SET name = '$name' , phno = '$phno', email = '$email'  WHERE username = '$username' ";
          $r = mysqli_query($db, $q);
		if(!$r) echo "<h1>Error in updating data</h1>";
		header('refresh: 0.1');
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
	<link rel="stylesheet" href="../../css/staffDashboard.css">
	<link rel="stylesheet" href="../../css/profile.css">
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
		<center>
			<div class="head1">Edit Your Profile [<?php echo $username; ?>] <i class="fa fa-edit"></i></div>
			<div class="main">

				<?php
					$q = "SELECT * FROM staffs WHERE username = '$username'";
					$r = mysqli_query($db, $q);	
					$row = mysqli_fetch_assoc($r);
					$name = $_SESSION['n'] = $row['name'];     
					$email = $row['email']; 
					$phno = $row['phno'];       
				?>

				<form class="updateProfile" method="POST" >
                      
                      	<div class="form-group">
						<div class="col-xs-6 shead">
							<label for="name"><h4 >Full Name</h4></label>
							<input type="text" minlength="3" class="form-control inputField" name="name" value = <?php echo "'$name'"; ?> id="name" placeholder="Full Name"  required>
						</div>
                      	</div>
                      
					<div class="form-group">
						<div class="col-xs-6 shead">
							<label for="email"><h4>Email </h4></label>
							<input type="email" class="form-control inputField" name="email"  id="email" value = <?php echo "'$email'"; ?>  placeholder="Enter email" required>
						</div>
					</div>
				  
					<div class="form-group ">
						<div class="col-xs-6 shead">
							<label for="phone"><h4>Phone</h4></label>
							<input type="tel" maxlength="10" pattern="\d{10}" title="Enter 10 digit number" class="form-control inputField"  value = <?php echo "'$phno'"; ?> name="phno" id="phone" placeholder="Enter phone" required>
						</div>
					</div>
				  
					<div class="form-group">
						<div class="col-xs-12">
							<input class="btn btn-lg btn-success update" type="submit" name="update" value="Update">
						</div>
					</div>
				</form>
			</div>

		</center>
		
	</div>
</body>
</html>