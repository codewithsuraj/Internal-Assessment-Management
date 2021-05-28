<?php 
	session_start();
	$n = $_SESSION['n'];
	$username = $_SESSION['username'];	
	$scheme = $_SESSION['scheme'];	
	$_SESSION['c'] = '';
	$sem = $_SESSION['sem'];	
	$db = mysqli_connect('localhost', 'root', '', 'vtu');
	if( !isset($_SESSION['username']) ) {
    	die( "<a href='../index.php'>Click to login again</a>" );
	}
     
     if(isset($_POST['id1'])){
          $_SESSION['u']= $_POST['id1'];
          if($_SESSION['u'] != '') {
               $a = $_SESSION['u'];
          }
     }

	if(isset($_POST['logout'])) {
		$_SESSION = array();
		session_destroy();
		header('location: ../index.php');
	}


	if (isset($_POST['save'])) {
		$ia = $_POST['ia'];
		if($ia <= 3) {
			$usn = $_SESSION['u'];
			$s1 = $_POST['s1'];
			$s2 = $_POST['s2'];
			$s3 = $_POST['s3'];
			$s4 = $_POST['s4'];
			$s5 = $_POST['s5'];
			$s6 = $_POST['s6'];
			$q = "INSERT INTO marks VALUES('$usn', $ia, $s1, $s2, $s3, $s4, $s5, $s6)";
			$r = mysqli_query($db, $q);
			if ($r) {header('location:marks.php');}
			else {echo 'Error in inserting data';}
		}
	}

     if (isset($_POST['edit'])) {
          $usn = $_SESSION['u'];
          $ia = $_POST['eia'];
          $s1 = $_POST['es1'];
          $s2 = $_POST['es2'];
          $s3 = $_POST['es3'];
          $s4 = $_POST['es4'];
          $s5 = $_POST['es5'];
          $s6 = $_POST['es6'];
          $q = "UPDATE marks 
			SET ia=$ia, s1=$s1, s2=$s2, s3=$s3, s4=$s4, s5=$s5, s6=$s6 
			WHERE ia = $ia and usn = '$usn'";
          $r = mysqli_query($db, $q);
		if (!$r) {echo 'error'.mysqli_error($db); }
     }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="../css/staffDashboard.css">
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
						<select name="scheme" id="" class="nav-link dropdown-toggle"  id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"required >
							<div class="dropdown-menu" aria-labelledby="navbarDropdown1">
								<option value="">Scheme</option>
								<option value="2016">2016</option>
								<option value="2017">2017</option>
								<option value="2018">2018</option>
							</div>
						</select>
					</li>
					<li class="nav-item dropdown sem">
						<select name="sem" id="" class="nav-link dropdown-toggle"  id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required >
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
							<input type="submit"class="btn btn-outline-success logout my-2 my-sm-0" name="logout" value="Logout">
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
				 $q = "SELECT username FROM students WHERE scheme = '$scheme' AND sem = '$sem' ";
				 $r = mysqli_query($db, $q);
				 $i = 1; 
				 while ($row = mysqli_fetch_assoc($r)) {
					$usn = $row['username'];
					$id = "idv".$i++;
					echo "<form method = 'POST' action='marks.php'>
							<input type='hidden' name='id1' class='id1'/>
							<input class='usn' type='submit' id='$id' value='$usn'/> 
						</form>";
				}
			?>
		</div>


	<!----------------------------------------------- Marks ----------------------------------------->

		<div class="col-lg-9 mainMarks">
			<div class="marks"> 
				<?php
					$u = $_SESSION['u'];
					$q3 = "SELECT * FROM students WHERE username = '$u'";
					$r3 = mysqli_query($db, $q3);
					$n = mysqli_fetch_assoc($r3);
				?>
				<div class="studInfo">
					<h3 id="sname"><?php echo $n['name']; ?></h3>
					<h3 id="susn"><?php echo $u; ?></h3>
				</div>
				<div class = "result">
					<?php
						$u = $_SESSION['u'];
						$q2 = "SELECT * FROM marks WHERE usn ='$u'";
						$q3 = "SELECT * FROM students WHERE username = '$u'";
						$r2 = mysqli_query($db, $q2);
						$r3 = mysqli_query($db, $q3);
						$_SESSION['c'] = mysqli_num_rows($r2);
						$n = mysqli_fetch_assoc($r3);
						if($_SESSION['c']) { 
					?>
					<table class="marksTable">
						<tr>
							<th>IA</th>
							<th>Sub1</th>
							<th>Sub2</th>
							<th>Sub3</th>
							<th>Sub4</th>
							<th>Sub5</th>
							<th>Sub6</th>
							<th>Edit</th>
						</tr>
						

						<?php
							$u =  $_SESSION['u'];
							$q = "SELECT * FROM marks WHERE usn = '$u' ORDER BY ia ";
							$r = mysqli_query($db, $q);	
							$i = 1;	
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

								<td> <?php 
										echo "<button class='editBtn' value='$u'><i class='fa fa-edit'></i></button>";
									?> 
								</td>
							</tr>		
						<?php } ?>
							<tr>
								<td class="avg">AVG</td>
								<td class="avg"> <?php echo number_format((float)($as1/$_SESSION['c']), 1, '.', ''); ?> </td>
								<td class="avg"> <?php echo number_format((float)($as2/$_SESSION['c']), 1, '.', ''); ?> </td>
								<td class="avg"> <?php echo number_format((float)($as3/$_SESSION['c']), 1, '.', ''); ?> </td>
								<td class="avg"> <?php echo number_format((float)($as4/$_SESSION['c']), 1, '.', ''); ?> </td>
								<td class="avg"> <?php echo number_format((float)($as5/$_SESSION['c']), 1, '.', ''); ?> </td>
								<td class="avg"> <?php echo number_format((float)($as6/$_SESSION['c']), 1, '.', '');?> </td>
								<td class="avg"></td>
							</tr>

					</table>	
						<?php } ?>		
				</div>

				<?php
					if($_SESSION['c'] >=0 && $_SESSION['c']<=2) {
					

						$iac = $_SESSION['c']+1;
						echo "<div class='enterMarks'>";
							echo "<form method='POST'>
									<table class='entryTable'>
									<tr >
										<td> <span class='iamarks'>$iac IA</span></td?>
										<td>	<input type='text' name ='ia' value = '$iac' hidden> </td?>
										<td>	<input class='iamarks' pattern='[0-9]|[1-2][0-9]|30' title ='1 to 30' minlength='1' maxlength='2' type='text' name = 's1' required> </td>
										<td>	<input class='iamarks' pattern='[0-9]|[1-2][0-9]|30' title ='1 to 30' minlength='1' maxlength='2' type='text' name = 's2' required> </td>
										<td>	<input class='iamarks' pattern='[0-9]|[1-2][0-9]|30' title ='1 to 30' minlength='1' maxlength='2' type='text' name = 's3' required> </td>
										<td>	<input class='iamarks' pattern='[0-9]|[1-2][0-9]|30' title ='1 to 30' minlength='1' maxlength='2' type='text' name = 's4' required> </td>
										<td>	<input class='iamarks' pattern='[0-9]|[1-2][0-9]|30' title ='1 to 30' minlength='1' maxlength='2' type='text' name = 's5' required> </td>
										<td>	<input class='iamarks' pattern='[0-9]|[1-2][0-9]|30' title ='1 to 30' minlength='1' maxlength='2' type='text' name = 's6' required> </td>
										<td>	<i id='fa-save' class='fa fa-save'><input class='iamarks' type='submit' value='' name='save' id='saveBtn'></i></td>
									</tr>
									</table>
								</form>
							</div>";
					}
				?>
			</div>

			<div class="editMarks">
				<table class="editTable">
					<tr>
						<th>IA</th>
						<th>Sub1</th>
						<th>Sub2</th>
						<th>Sub3</th>
						<th>Sub4</th>
						<th>Sub5</th>
						<th>Sub6</th>
						<th>Edit</th>
					</tr>


					
					<?php
						$u1 =  $_SESSION['u'];
						$q1 = "SELECT * FROM marks WHERE usn = '$u'  ORDER BY ia ";
						$r1 = mysqli_query($db, $q1);	
						$i = 1;
						while ($row1 = mysqli_fetch_assoc($r1)) {
							$ia = $row1['ia'];
							$s1 = $row1['s1'];
							$s2 = $row1['s2'];
							$s3 = $row1['s3'];
							$s4 = $row1['s4'];
							$s5 = $row1['s5'];
							$s6 = $row1['s6'];
					?>

							<form method="POST">
								<tr>
									<td>	<?php echo $i; ?></td>
									<input class="eiamarks" type="hidden" name="eia" value="<?php echo $ia; ?>"required>
									<td>	<input class="eiamarks" type="text" pattern="[0-9]|[1-2][0-9]|30" title ="1 to 30" minlength="1" maxlength="2" name="es1" value="<?php echo $s1; ?>" required> </td>
									<td>	<input class="eiamarks" type="text" pattern="[0-9]|[1-2][0-9]|30" title ="1 to 30" minlength="1" maxlength="2" name="es2" value="<?php echo $s2; ?>" required> </td>
									<td>	<input class="eiamarks" type="text" pattern="[0-9]|[1-2][0-9]|30" title ="1 to 30" minlength="1" maxlength="2" name="es3" value="<?php echo $s3; ?>" required> </td>
									<td>	<input class="eiamarks" type="text" pattern="[0-9]|[1-2][0-9]|30" title ="1 to 30" minlength="1" maxlength="2" name="es4" value="<?php echo $s4; ?>" required> </td>
									<td>	<input class="eiamarks" type="text" pattern="[0-9]|[1-2][0-9]|30" title ="1 to 30" minlength="1" maxlength="2" name="es5" value="<?php echo $s5; ?>" required> </td>
									<td>	<input class="eiamarks" type="text" pattern="[0-9]|[1-2][0-9]|30" title ="1 to 30" minlength="1" maxlength="2" name="es6" value="<?php echo $s6; ?>" required> </td>
									<td>	<button class='editBtn' value='$u'><i class='fa fa-edit'><input type="submit" id="edit-btn" name="edit" value = ""></i></button></td>
								</tr>
							</form>
					<?php $i++; } ?>    
				</table>

			</div>
		</div>
	</div>


	  <!----------------------------------------------- Marks ----------------------------------------->
	<script src="../js/main.js"></script>
</body>
</html>