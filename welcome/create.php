<?php

	session_start();
	$username = $_SESSION['username'];	
	$db = mysqli_connect('localhost', 'root', '', 'vtu');

	if(isset($_POST['logout'])) {
		$_SESSION = array();
		session_destroy();
		header('location: ../../index.php');
	}
	
	
	if (isset($_POST['create'])) {
		$username = $_POST['username'];
		$pass = base64_encode('123');
		$q1 = "SELECT * FROM staffs WHERE username = '$username'";
		$r1 = mysqli_query($db, $q1);
		if(mysqli_num_rows($r1) == 1) echo "<h1>Staff already exists</h1>";
		else {
			$q2 = "INSERT INTO staffs VALUES('$username', '$pass','Null','Null',0)";
			$r2 = mysqli_query($db, $q2);
			if ($r2) echo "<h1>New Staff Added</h1>";
		}
		header("refresh: 0.1"); 
	}

	if (isset($_POST['createStudent'])) {
		$username = $_POST['username'];
		$scheme = $_POST['scheme'];
		$sem = $_POST['sem'];
		$pass = base64_encode('123');
		$q1 = "SELECT * FROM students WHERE username = '$username'";
		$r1 = mysqli_query($db, $q1);
		if(mysqli_num_rows($r1) == 1) echo "<h1>Student already exists</h1>";
		else {
			$q2 = "INSERT INTO students VALUES('$username', '$pass', $scheme, $sem,'Null','Null','Null',0,'CSE')";
			$r2 = mysqli_query($db, $q2);
			if ($r2) echo "<h1>New Student Added</h1>";
		}
		header("refresh: 0.1"); 

	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add User</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="../css/staffDashboard.css">
	<link rel="stylesheet" href="../css/admin.css">
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
							echo "<a id='admin' href='create.php'>Admin</a>";
						}
				?>
			</a>
		</div>
		
		<div class="collapse navbar-collapse head2" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item"><a class="nav-link link" href="staff.php">Home</a></li>
				<li class="nav-item"><a class="nav-link link" href="profile/staff.php">Profile</a></li>
				<li class="nav-item"><a class="nav-link link" href="scheme/upload.php">Scheme</a></li>
				<li class="nav-item"><a class="nav-link link" href="feedback/staff.php">Feedback</a></li>
				<form method="POST" action="staff.php" class="collapse navbar-collapse sform" >
					<li class="nav-item dropdown">
						<select name="scheme" id="" class="nav-link dropdown-toggle"  id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown1" >
								<option value="" >Scheme</option>
								<option value="2016">2016</option>
								<option value="2017">2017</option>
								<option value="2018">2018</option>
							</div>
						</select>
					</li>
					<li class="nav-item dropdown sem">
						<select name="sem" id="" class="nav-link dropdown-toggle"  id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required >
							<div class="dropdown-menu" aria-labelledby="navbarDropdown2" >
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
						<form method="POST" action="../index.php" class="collapse navbar-collapse sform">
							<input type="submit"class="btn btn-outline-success logout my-2 my-sm-0" name="logout" value="Logout">
						</form>
					</a>
				</li>
			</ul>
		</div>
	</nav>


	<div class="row createUsers">

		<div class="col-lg-6 createStaff" >
			<center>

				<h1 class="heading">Create Staff</h1>
				<form method="POST">
					<input class="user" maxlength="5" pattern="^(?:cs)[0-9]{3}$" title="CS999" placeholder="Username" type="text" name="username" required>
					<input class="createBtn screate" type="submit" name="create" value="Create">		
				</form>
				<a class="staffLink" href="List/staffList.php">List of Staffs</a>
			</center>
			
		</div>

		<div class="col-lg-6 createStudent" >
			<center>
				<h1 class="heading headint-staff">Create Student</h1>
				<form method="POST">
					<div class="nav-item dropdown">
						<select name="scheme" class="nav-link dropdown-toggle user"  id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required >
							<div class="dropdown-menu" aria-labelledby="navbarDropdown1">
								<option value="" >Scheme</option >
								<option value="2016">2016</option>
								<option value="2017">2017</option>
								<option value="2018">2018</option>
							</div>
						</select>
					</div>
					<div class="nav-item dropdown sem">
						<select name="sem" class="nav-link dropdown-toggle user"  id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required>
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
					</div>
					<input class="user" maxlength="10" pattern="^[2-4]{1}[a-z]{2}[0-9]{2}[a-z]{2}[0-9]{3}$" title="2KA99XX999" placeholder="Username" type="text" name="username" required>
					<input class="createBtn " type="submit" name="createStudent" value="Create">		
				</form>
				<a class="studentLink" href="List/studentList.php">List of Students</a>

			</center>
			
		</div>
	</div>
</body>
</html>