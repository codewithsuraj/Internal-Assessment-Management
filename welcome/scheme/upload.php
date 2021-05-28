<?php
session_start();
$username = $_SESSION['username'];	

if(isset($_POST['logout'])) {
  $_SESSION = array();
  session_destroy();
  header('location: ../../index.php');
}

// connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'vtu');

// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_FILES['myfile']['name'];
    $scheme = $_POST['scheme'];
    $sem = $_POST['sem'];
    $subject = $_POST['subject'];
    $ia = $_POST['ia'];

    $destination = 'uploads/' . $filename;

    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];

    if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
        echo "You file extension must be .zip, .pdf or .docx";
    } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO scheme (name, size,sscheme, sem, subject,ia, staffID) VALUES('$filename', $size, $scheme, $sem, '$subject',$ia, '$username')";
            if (mysqli_query($conn, $sql)) {
			echo "<script type='text/javascript'>
					alert('File uploaded successfully'); location.replace('upload.php');
				</script>";
            }
        } else {
            echo "Failed to upload file.";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Files Upload and Download</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="../../css/staffDashboard.css">
	<link rel="stylesheet" href="../../css/upload.css">
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

    <div class="row">
	    <p id="download" ><a  href="download.php"> <i class="fa fa-cloud-download" aria-hidden="true"></i> Download</a></p>
        	<form method="post" enctype="multipart/form-data" >
          <h3><i class="fa fa-cloud-upload" aria-hidden="true"></i>Upload Scheme <p>[zip / pdf / docx]</p></h3>
          <div class="nav-item dropdown selectors selector1">
						<select name="scheme" id="" class="nav-link dropdown-toggle selectors"  id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"required >
							<div class="dropdown-menu" aria-labelledby="navbarDropdown1">
								<option value="">Scheme</option>
								<option value="2016">2016</option>
								<option value="2017">2017</option>
								<option value="2018">2018</option>
							</div>
						</select>
          </div>
          
					<div class="nav-item dropdown ">
						<select name="sem" id=""  class="nav-link dropdown-toggle selectors "  id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"required>
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
          
          <div class="nav-item dropdown ">
						<select name="subject"  class="nav-link dropdown-toggle selectors"  id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"required>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown2">
								<option value="">Subject</option>
								<option value="sub1">SUB1</option>
								<option value="sub2">SUB2</option>
								<option value="sub3">SUB3</option>
								<option value="sub4">SUB4</option>
								<option value="sub5">SUB5</option>
								<option value="sub6">SUB6</option>
							</div>
						</select>
          </div>
          
          <div class="nav-item dropdown ">
						<select name="ia" class="nav-link dropdown-toggle selectors"  id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown1">
								<option value="">IA</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
							</div>
						</select>
		</div>

		<label id ="fileup" class="selectors" for="file">
			<i class="fa fa-file" aria-hidden="true"></i>
				Choose a File
			<input id="file" type="file" name="myfile" class="selectors"  id = "fileup" required>
    		</label> 
          
          <button class="btn btn-lg btn-success upload"  type="submit" name="save">Upload File</button>

	   </form>
	   

      </div>
  
  </center>
      

    </div>

  </body>
</html>