<?php 

include("includes/config.php");
session_start();
if(!isset($_SESSION['email'])){
	die('<script>alert("Please Log In First");
			location.replace("index.php");
	</script>');
	// echo '<script>alert("Please Log In First");</script>';
	// header("location:index.php");
}
if(isset($_SESSION['email'])){

	if (isset($_POST['submit'])) {
		# code...
		// include 'connection.php';
		$position = $_POST['position'];
		$company = $_POST['company'];
		$expertise = $_POST['expertise'];
		$experience = $_POST['experience'];
		$type = $_POST['type'];
		$salary = $_POST['salary'];
		$responsibility = $_POST['responsibility'];
		$requirements = $_POST['requirements'];
	
		$sql = "INSERT INTO `jobs`( `position`, `company`, `expertise`, `experience`, `type`, `salary`, `responsibility`, `requirements`) VALUES ('$position', '$company', '$expertise', '$experience', '$type', '$salary', '$responsibility', '$requirements')";
		// die($sql);
		$result=$conn->query($sql);
	
		// if ($_POST[uname] == 'abul' and $_POST['passwd'] == 'p') {
		if ($result) {
			die('all good :) goto login page: <a href="index.php">Login page</a>');
		}else{
			echo 'signup failed :(';
		}
	}else{
		echo "Fill all the field";
	}
?>
	// HERE GOES HTML, JS CODE
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<?php include("includes/docHeaderInfo.php")?>;

	<title>Posted Jobs</title>
</head>
<body>
	<?php include("includes/navbar.php")?>;

	<div class="container my-5 pb-5">
		<h2 class="mt-5 mb-4 pt-5">POST A NEW JOB</h2>
		<div class="row">
			<div class="col-md-12">
				<form action="" method="post">	
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Position :</label> 
								<input class="form-control" type="text" name="position">
							</div>
							<div class="form-group">
								<label for="">Company Name :</label> 
								<input class="form-control" type="text" name="company">
							</div>
							<div class="form-group">
								<label for="">Expertise Level :</label> 
								<input class="form-control" type="text" name="expertise">
							</div>
							<div class="form-group">
								<label for="">Experience :</label> 
								<input class="form-control" type="text" name="experience">
							</div>
							<div class="form-group">
								<label for="">Type :</label> 
								<input class="form-control" type="text" name="type">
							</div>
							<div class="form-group">
								<label for="">Salary :</label> 
								<input class="form-control" type="text" name="salary">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Responsibilities :</label> 
								<textarea class="form-control" rows="11" name="responsibility"></textarea>
							</div>
							<div class="form-group">
								<label for="">Requirements :</label> 
								<textarea class="form-control" rows="11" name="requirements"></textarea>
							</div>
						
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<button type="submit" name="submit" style="width: 180px;" class="btn green-light customBtn">POST JOB</button>
						</div>
					</div>
				</form>
			</div>								
		</div>			
	</div>
	<?php include("includes/footer.php")?>;
</body>
<?php

}
else{
	echo '<script>alert("Please Log In First")</script>';
	// header("location:index.php"); 
	"<script>$('#loginModal').modal('show');</script>";
}


?>








	<?php ?>

</html>