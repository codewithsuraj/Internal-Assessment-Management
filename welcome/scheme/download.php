
<?php 
     session_start();
	$username = $_SESSION['username'];	
     $conn = mysqli_connect('localhost', 'root', '', 'vtu');


     if(isset($_POST['logout'])) {
          $_SESSION = array();
          session_destroy();
          header('location: ../../index.php');
     }


     $q = "SELECT * FROM students WHERE username='$username'";
     $r = mysqli_query($conn, $q);
     $row = mysqli_fetch_assoc($r);
     $scheme = $row['scheme'];
     $sem = $row['sem'];
     $sql = "SELECT * FROM scheme ORDER BY sem , ia";
     $result = mysqli_query($conn, $sql);
     $files = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Download files</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="../../css/staffDashboard.css">
	<link rel="stylesheet" href="../../css/download.css">
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
               <table class="table">
                    <thead>
                        <tr>
                            <td>IA</td>
                            <td>SCHEME</td>
                            <td>SEM</td>
                            <td>SUBJECT</td>
                            <td>DOWNLOAD</td>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                            $i= 0 ;
                            foreach ($files as $file){ 
                            if(($scheme == $file['sscheme'] AND $sem == $file['sem']) OR $username == $file['staffID']) {
                                $did[$i] = $file['id'];
                        ?>

                        <tr>
                            <td><?php echo $file['ia']; ?></td>
                            <td><?php echo $file['sscheme']; ?></td>
                            <td><?php echo $file['sem']; ?></td>
                            <td><?php echo $file['subject']; ?></td>
                            <td><button class ="down">
                                <?php
                                $x = $did[$i];
                                $sql = "SELECT * FROM scheme WHERE id=$x";
                                $result = mysqli_query($conn, $sql);
                                $file = mysqli_fetch_assoc($result);
                                $filepath = 'uploads/' . $file['name'];
                                ?>
                                <a href="<?php echo $filepath; ?>" download><i class="fa fa-download" aria-hidden="true"></i></a>
                            </button>
                            </td>
                        </tr>
                        <?php $i++; }}?>
                    </tbody>
            </table>
          </center>
     </div>
</body>
</html>