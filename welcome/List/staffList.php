<?php
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'vtu');
	$username = $_SESSION['username'];	

	if(isset($_POST['logout'])) {
		$_SESSION = array();
		session_destroy();
		header('location: ../../index.php');
	}

	if(isset($_POST['edit'])) {
		$nusername = $_POST['nusername'];
		$ousername = $_POST['ousername'];
		if($ousername == 'cs001') echo "<h1>Admin id cannot be changed</h1>";
		else {
			$q = "UPDATE staffs SET username = '$nusername' WHERE username = '$ousername' ";
			$r = mysqli_query($db, $q);
			if(!$r){ echo "<h1>Username is already Exists</h1>"; header('refresh:0.1');}
		}
		
	}
	if(isset($_POST['delete'])) {
		$username = $_POST['ousername'];
		if($username == 'cs001') echo "<h1>Admin cannot be removed</h1>";
		else {
			$q = "DELETE FROM staffs WHERE username = '$username' ";
			$r = mysqli_query($db, $q);
			if(!$r){ echo "<h1>Error</h1>"; header('refresh:0.1');}
		}
		
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
	<link rel="stylesheet" href="../../css/lists.css">
	<link rel="stylesheet" href="../../css/staffDashboard.css">
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
						<select name="scheme" class="nav-link dropdown-toggle"  id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown1">
								<option>Scheme</option>
								<option value="2016">2016</option>
								<option value="2017">2017</option>
								<option value="2018">2018</option>
							</div>
						</select>
					</li>
					<li class="nav-item dropdown sem">
						<select name="sem"  class="nav-link dropdown-toggle"  id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown2">
								<option>Sem</option>
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

	<div class="staffList">
		<center>
			<div class = "row1">List of Staffs <i id= 'editBtn' class="fa fa-pencil-square-o" aria-hidden="true"></i></div>
			<div class="row2">
				<?php 
					$q = "SELECT username FROM staffs";
					$r = mysqli_query($db, $q);
					$i = 1;
					while ($row = mysqli_fetch_assoc($r)) {
						$username = $row['username'];
						$idv = "idv".$i;
						$ide = "ide".$i;
						$hideId = "idh".$i;
						echo "<div class='nstaffs'><span id='$hideId'> $username </span>
								<form method='POST' action='staffList.php'>
									<input type='text' id='$idv' maxlength='5' pattern='^(?:cs)[0-9]{3}$' title='CS999' class='editField' value='$username' name ='nusername' required>
									<input type='hidden' value='$username' name ='ousername'>
									<i class='fa fa-pencil-square-o leditBtn' id='$ide' aria-hidden='true'><input type='submit'  name='edit' value=''></i>
									<i class='fa fa-trash deleteBtn' aria-hidden='true'><input type='submit' name='delete' value=''></i>
								</form>
							</div>";
						$i++;
					}
				?>
			</div>
		</center>
	</div>

	<script src="list.js"></script>
</body>
</html>