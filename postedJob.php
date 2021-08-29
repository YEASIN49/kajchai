<?php 

include("includes/config.php");
session_start();
if(!isset($_SESSION['email']) or $_SESSION['role'] != 'employer'){
	die('<script>alert("You are not allowed here ! Only employers are expected!");
			location.replace("index.php");
	</script>');
	// echo '<script>alert("Please Log In First");</script>';
	// header("location:index.php");
}
if(isset($_SESSION['email']) and $_SESSION['role'] == 'employer'){

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
		$employer_id = $_SESSION['id'];
	
		$sql = "INSERT INTO `jobs`( `position`, `company`, `expertise`, `experience`, `type`, `salary`, `responsibility`, `requirements`, `employer_id`) VALUES ('$position', '$company', '$expertise', '$experience', '$type', '$salary', '$responsibility', '$requirements', '$employer_id')";
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
	
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

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