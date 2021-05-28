<?php 
	session_start();
	$username = $_SESSION['username'];	
	$db = mysqli_connect('localhost', 'root', '', 'vtu');
	if( !isset($_SESSION['username']) ) {
    	die( "<a href='../index.php'>Click to login again</a>" );
	}

	if(isset($_POST['logout'])) {
		$_SESSION = array();
		session_destroy();
		header('location: ../index.php');
	}

	if(isset($_POST['sendMail'])) {
		$header = 'From: mail2surajmahendrakar@gmail.com'."\r\n".'MIME-Version: 1.0'."\r\n".'Content-Type: text/html; charset=utf-8';
		$sem = $_SESSION['sem'];
		$scheme = $_SESSION['scheme'];

		$q = "SELECT * FROM students WHERE scheme = '$scheme' AND sem = '$sem' ";
		$r = mysqli_query($db, $q);

		
		while ($row = mysqli_fetch_assoc($r)) {
			$body1 = "<table>
						<tr>
							<th>IA</th>
							<th>Sub1</th>
							<th>Sub2</th>
							<th>Sub3</th>
							<th>Sub4</th>
							<th>Sub5</th>
							<th>Sub6</th>
						</tr>
					";

			$usn = $row['username'];
			$toEmail = $row['pemail'];
			$_SESSION['sname']= $row['name'];
			$q = "SELECT * FROM marks WHERE usn = '$usn' ORDER BY ia ";
				$r = mysqli_query($db, $q);
				$i = 0;
				while ($row = mysqli_fetch_assoc($r)) {
					$ia = $row['ia'];
					$s1 = $row['s1'];
					$s2 = $row['s2'];
					$s3 = $row['s3'];
					$s4 = $row['s4'];
					$s5 = $row['s5'];
					$s6 = $row['s6'];
					$_SESSION['body2'][$i++] = "<tr>
								<th>$ia</th>
								<th>$s1</th>
								<th>$s2</th>
								<th>$s3</th>
								<th>$s4</th>
								<th>$s5</th>
								<th>$s6</th>
							</tr>";
				}
				if($_SESSION['body2'][0] == NULL) {echo "Enter the marks"; break;}
				if($_SESSION['body2'][1] == NULL) $_SESSION['body2'][1] ="";
				if($_SESSION['body2'][2] == NULL) $_SESSION['body2'][2]="";

			$body3 = "</table>";
			$body20 = $_SESSION['body2'][0];
			$body21 = $_SESSION['body2'][1];
			$body22 = $_SESSION['body2'][2];
			$bodymid = $body20.$body21.$body22;
			$body = $body1.$bodymid.$body3;
			$subject = "Internal Assessment Of ".$_SESSION['sname'];
			$res = mail($toEmail, $subject, $body, $header);
			if($res) {
				echo "<script type='text/javascript'>
						alert('Mail has been sent to respective parents');
					</script>";
			} 
			else echo "<h1>Error in sending mail</h1>";
		}
	}
	
?>



<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="../css/staffDashboard.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light ">
		<div class="head1">
			<a class="navbar-brand" href="#"> 
				<?php
					$q1 = "SELECT * FROM staffs WHERE username = '$username'";
					$r1 = mysqli_query($db, $q1);
					$row1 = mysqli_fetch_assoc($r1);
					$_SESSION['n'] = $row1['name'];
						echo $_SESSION['n'] ; 
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
						<form method="POST" action="../index.php" class="collapse navbar-collapse sform">
							<input type="submit" class="btn btn-outline-success logout my-2 my-sm-0" name="logout" value="Logout">
						</form>
					</a>
				</li>
			</ul>
		</div>
	</nav>

	<div class="email">
		<form method = "POST">
			<input type="submit" class="btn btn-outline-success sendMail" name="sendMail" value="Send Email To Parents"><span></span>
		</form>
	</div>


	

	<div class="row maindiv">
		<div class="col-lg-3 usnlist">
			<?php
				if (isset($_POST['go'])) {
					$scheme = $_SESSION['scheme'] = $_POST['scheme'];
					$sem = $_SESSION['sem'] = $_POST['sem'];
					$q = "SELECT username FROM students WHERE scheme = '$scheme' AND sem = '$sem' ";
					$r = mysqli_query($db, $q);
					$i = 1; 
					while ($row = mysqli_fetch_assoc($r)) {
						$usn = $row['username'];
						$id = "idv".$i;
						echo "<form method = 'POST' action='marks.php'>
								<input type='hidden' name='id1' class='id1'/>
								<input class='usn' type='submit' id='$id' value='$usn'/> 
							</form>";
						$i++;
					}
				}
			?>
		</div>
		
		<div class="col-lg-9 mainMarks">
	  		<!---------------------------------------- Marks ------------------------------------>
		</div>
  	</div>
	<script src="../js/main.js"></script>
</body>
</html>