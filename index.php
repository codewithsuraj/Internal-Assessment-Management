<?php
	function startsWith ($string, $startString) { 
		$len = strlen($startString); 
		return (substr($string, 0, $len) === $startString); 
	} 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'vtu');
	if (isset($_POST['login'])) {
		$username = $_SESSION['username'] =  $_POST['username'];
		$pass =  $_POST['password'];
		$password = base64_encode($pass);
		if($username == 'cs001'){
			$url = "Location: welcome/staff.php";
			$_SESSION['admin'] = true;
			$table = 'staffs';
		} else if(startsWith($username,"cs")) {
			$url = "Location: welcome/staff.php";
			$table = 'staffs';
			$_SESSION['admin'] = false;
		} else{
			$url = "Location: welcome/student.php";
			$table = 'students';
		} 

	    $q = "SELECT * FROM $table WHERE username ='$username' AND password='$password'";
	    $r = mysqli_query($db, $q); 
	    if (mysqli_num_rows($r) == 1) {
		   header($url);
	    	} else {echo "<h1 class='error' >Invalid Username OR Password</h1>";}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Index</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="css/index.css">
</head>
<body>
	<h1 class="title">Internal Assessment Management System</h1>
	<form method="POST">
		<div class="container">
			<h1>Welcome</h1>
			<input class="inputField" type="text" placeholder="Username" name="username" required>
			<input class="inputField" type="password" placeholder="Password" name="password" required>
			<input class="loginBtn" type="submit" name="login" value="Login">
			<label class="remember">
				<input  type="checkbox" checked="checked" name="remember"> Remember me
			</label>
			<span class="psw"> <a href="forgot.php">Forgot password ?</a></span>
		</div>
	</form>
</body>
</html>