
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
	<link rel="stylesheet" href="../../css/studentDash.css">
	<link rel="stylesheet" href="../../css/download.css">
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