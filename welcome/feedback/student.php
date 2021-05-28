<?php
     session_start();
     $db = mysqli_connect('localhost', 'root', '', 'vtu');

     if(isset($_POST['sendFeedback'])) {
		$staffID = $_POST['staffID'];
		$grade = $_POST['grade'];
		$q = "INSERT INTO feedback VALUES('$staffID', '$grade')";
		$r = mysqli_query($db, $q);
		if($r) {echo "<h1>Feedback sent</h1>"; header('refresh:0.1');}
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
	<link rel="stylesheet" href="../../css/studentDash.css">
	<link rel="stylesheet" href="../../css/sfeedback.css">
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
          <form action="student.php" class="fform" method="POST">
               <select name="staffID" class="dropdown-toggle finput"  id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                         <option value="">Staff</option>
                         <?php
                              $q = "SELECT * FROM staffs";
                              $r = mysqli_query($db, $q);  
                              while ($row = mysqli_fetch_assoc($r)) {
                                   $name = $row['name'];
                                   $username = $row['username'];
                                   echo "<option value='$username'>$name</option>";
                              }
                         ?>
                    </div>
               </select>
               <div class="grades finput">
                    <div class="form-check form-check-inline">
                         <input class="form-check-input" type="radio" name="grade" id="inlineRadio1"  value="1" required>
                         <label class="form-check-label" for="inlineRadio1">1</label>
                    </div>
                    <div class="form-check form-check-inline">
                         <input class="form-check-input" type="radio" name="grade" id="inlineRadio2"  value="2" required>
                         <label class="form-check-label" for="inlineRadio2">2</label>
                    </div>
                    <div class="form-check form-check-inline">
                         <input class="form-check-input" type="radio" name="grade" id="inlineRadio3"  value="3" required>
                         <label class="form-check-label" for="inlineRadio3">3</label>
                    </div>
                    <div class="form-check form-check-inline">
                         <input class="form-check-input" type="radio" name="grade" id="inlineRadio4"  value="4" required>
                         <label class="form-check-label" for="inlineRadio4">4</label>
                    </div>
                    <div class="form-check form-check-inline">
                         <input class="form-check-input" type="radio" name="grade"  id="inlineRadio5"  value="5" required>
                         <label class="form-check-label" for="inlineRadio5">5</label>
                    </div>
               </div>

               <input class="btn btn-lg btn-success" type="submit" value="Send" name="sendFeedback">
          </form>
     </div>
</body>
</html>