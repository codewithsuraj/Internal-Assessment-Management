<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'vtu');
	$usn = $_SESSION['username'];	
	if( !isset($_SESSION['username']) ) {
    	die( "<a href='../index.php'>Click to login again</a>" );
	}
	
	if(isset($_POST['logout'])) {
          $_SESSION = array();
          session_destroy();
          header('location: ../../index.php');
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
	<link rel="stylesheet" href="../css/studentDash.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light ">
		<div class="head1">
			<a class="navbar-brand" href="#"> 
				<?php
					$q1 = "SELECT * FROM students WHERE username = '$usn'";
					$r1 = mysqli_query($db, $q1);
					$row1 = mysqli_fetch_assoc($r1);
					$_SESSION['n'] = $row1['name'];
						echo $_SESSION['n'] ; 
				?>
			</a>
		</div>
		
		<div class="collapse navbar-collapse head2" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item"><a class="nav-link link" href="student.php">Home</a></li>
				<li class="nav-item"><a class="nav-link link" href="profile/student.php">Profile</a></li>
				<li class="nav-item"><a class="nav-link link" href="scheme/sdownload.php">Scheme</a></li>
				<li class="nav-item"><a class="nav-link link" href="feedback/student.php">Feedback</a></li>
				<li class="nav-item">
					<form method="POST" action="../index.php" class="collapse navbar-collapse sform">
						<input type="submit" class="btn btn-outline-success logout my-2 my-sm-0" name="logout" value="Logout">
					</form>
					</a>
				</li>
			</ul>
		</div>
	</nav>
	
	<?php
		$u = $_SESSION['username'];
		$q2 = "SELECT * FROM marks WHERE usn ='$u'";
		$r2 = mysqli_query($db, $q2);
		$c = mysqli_num_rows($r2);
		if($c) { 
	?>

	<div class="container">
		<h1>Internal Marks</h1>
		<div class="main">
			<div class="marksTable">
				<table>
					<tr>
						<th>IA</th>
						<th>Sub1</th>
						<th>Sub2</th>
						<th>Sub3</th>
						<th>Sub4</th>
						<th>Sub5</th>
						<th>Sub6</th>
					</tr>

					<?php
						$q = "SELECT * FROM marks WHERE usn = '$usn' ";
						$r = mysqli_query($db, $q);		
						$as1 = $as2 = $as3 = $as4 = $as5 = $as6 = 0; 
						while ($row = mysqli_fetch_assoc($r)) {
							$ia = $row['ia'];
							$s1 = $row['s1'];
							$s2 = $row['s2'];
							$s3 = $row['s3'];
							$s4 = $row['s4'];
							$s5 = $row['s5'];
							$s6 = $row['s6'];
							global $as1,$as2,$as3,$as4,$as5,$as6;
							$as1 += $s1; $as2 += $s2; $as3 += $s3; $as4 += $s4; $as5 += $s5; $as6 += $s6;
					?>
							<tr>
								<td> <?php echo $ia; ?> </td>
								<td> <?php echo $s1; ?> </td>
								<td> <?php echo $s2; ?> </td>
								<td> <?php echo $s3; ?> </td>
								<td> <?php echo $s4; ?> </td>
								<td> <?php echo $s5; ?> </td>
								<td> <?php echo $s6; ?> </td>
							</tr>		
					<?php } ?>

					<tr>
						<td class="avg">AV</td>
						<td class="avg"> <?php echo number_format((float)($as1/$c), 1, '.', ''); ?> </td>
						<td class="avg"> <?php echo number_format((float)($as2/$c), 1, '.', ''); ?> </td>
						<td class="avg"> <?php echo number_format((float)($as3/$c), 1, '.', ''); ?> </td>
						<td class="avg"> <?php echo number_format((float)($as4/$c), 1, '.', ''); ?> </td>
						<td class="avg"> <?php echo number_format((float)($as5/$c), 1, '.', ''); ?> </td>
						<td class="avg"> <?php echo number_format((float)($as6/$c), 1, '.', ''); ?> </td>
					</tr>
				</table>
					<?php } else echo "Still Marks are not entered"; ?>
			</div>
			

			<div class="notification">
				<h3>Notification</h3>
				<?php
					if($c) {
						$a = 0;
						if(($as1/$c) < 9){ echo "<h4> You Don't Have Average in <span>SUB1</span> </h4>"; $a++; }  
						if(($as2/$c) < 9){ echo "<h4> You Don't Have Average in <span>SUB2</span> </h4>"; $a++; }  
						if(($as3/$c) < 9){ echo "<h4> You Don't Have Average in <span>SUB3</span> </h4>"; $a++; }  
						if(($as4/$c) < 9){ echo "<h4> You Don't Have Average in <span>SUB4</span> </h4>"; $a++; }  
						if(($as5/$c) < 9){ echo "<h4> You Don't Have Average in <span>SUB5</span> </h4>"; $a++; }  
						if(($as6/$c) < 9){ echo "<h4> You Don't Have Average in <span>SUB6</span> </h4>"; $a++; }  
						if($a == 0) echo "<h4>You Have Average In All Subjects</h4>";
					}
					
				?>
			</div>
		</div>
	</div>
</body>
</html>