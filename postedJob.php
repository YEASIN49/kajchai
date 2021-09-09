<?php 

include("includes/config.php");
session_start();


/***************************
**
**
**	All Job Post Data Fetching 
**
**
************************** */


$allJobs;
$selectedToEdit;

function fetchJobList(){
	global $allJobs;
	global $conn;
	$email =$_SESSION["email"];
	$employer_id = $_SESSION["id"];
	$roletype = $_SESSION["role"];
	$sqlSelect = "SELECT * FROM jobs WHERE  employer_id = '".$_SESSION['id']."'";

	$allJobs=$conn->query($sqlSelect) or die('<script>alert("Log In Failed");</script>');
	// echo ($result);
	

			if (!empty($allJobs)){
				// echo ('("All job fetched")');
			
			}else{
				echo '("Job Fetch Failed")';
			}
		
}
fetchJobList();

/***************************
**
**
**
************************** */




/***************************
**
**
**	Job Post Form Data Storing
**
**
************************** */


if(!isset($_SESSION['email']) or $_SESSION['role'] != 'employer'){
	die('<script>alert("You are not allowed here ! Only employers are expected!");
			location.replace("index.php");
	</script>');
	// echo '<script>alert("Please Log In First");</script>';
	// header("location:index.php");
}
/*************
 * *
 * *
 * *
 * *
 ****************/

if(isset($_POST['view'])){
	$_SESSION['jobID'] = $_POST['hiddenJobId'];
	header("location: viewJob.php");
}

/************
*
*
*
*
************/

if(isset($_SESSION['email']) and $_SESSION['role'] == 'employer'){
	

	if (isset($_POST['submit'])) {

		$position = $_POST['position'];
		$company = $_POST['company'];
		$expertise = $_POST['expertise'];
		$experience = $_POST['experience'];
		$type = $_POST['type'];
		$salary = $_POST['salary'];
		$responsibility = $_POST['responsibility'];
		$requirements = $_POST['requirements'];
		$location = $_POST['location'];
		$category = $_POST['category'];
		$employer_id = $_SESSION['id'];
	
		$sql = "INSERT INTO `jobs`( `position`, `company`, `expertise`, `experience`, `type`, `salary`, `responsibility`, `requirements`, `location`, `category`, `employer_id`) VALUES ('$position', '$company', '$expertise', '$experience', '$type', '$salary', '$responsibility', '$requirements', '$location', '$category', '$employer_id')";
		// die($sql);
		$result=$conn->query($sql);
	
		if ($result) {
			// header('Location: postedJob.php');
			die("<script>alert('New Job Posted Successfully');
			location.replace('postedJob.php');
			</script>");
		}else{
			echo 'Job Posting Failed :(';
		}
	}
	elseif(isset($_POST['delete'])){
		$jobID = $_POST['hiddenJobId'];
		$deleteQuery = "DELETE FROM jobs WHERE id = $jobID";
		
		$deleteResult=$conn->query($deleteQuery);
	
		if ($deleteResult) {
			// header('Location: postedJob.php');
			die("<script>alert('Job Deleted Successfully');
			location.replace('postedJob.php');
			</script>");
		}else{
			echo 'Job Delete Failed :(';
		}

	}
	elseif(isset($_POST['viewEdit'])){
		$jobID = $_POST['hiddenJobId'];
	
		foreach ($allJobs as $row) { 
			// echo ($row['id']); 
			if($row['id'] == $_POST['hiddenJobId']){
				$_SESSION['editableJobId'] = $row['id'];
				echo ("testt  - >"); 
				$_SESSION['editableJobPosition'] = $row['position'];
				echo ($_SESSION['editableJobPosition']);
				$_SESSION['editableJobCompany'] = $row['company'];
				$_SESSION['editableJobExpertise'] = $row['expertise'];
				$_SESSION['editableJobExperience'] = $row['experience'];
				$_SESSION['editableJobType'] = $row['type'];
				$_SESSION['editableJobSalary'] = $row['salary'];
				$_SESSION['editableJobResponsibility'] = $row['responsibility'];
				$_SESSION['editableJobRequirements'] = $row['requirements'];
				$_SESSION['editableJobLocation'] = $row['location'];
				$_SESSION['editableJobCategory'] = $row['category'];
				// $_SESSION['editableJobId'] = $row['id'];
				
			}
		}
		// echo ("<script>location.replace('editJob.php');
		// alert('Logged In')</script>");
				// die('<pre>' . print_r($_SESSION, TRUE) . '</pre'); //this is to show all the session variable
				die("<script>location.replace('editJob.php');</script>");
	} 
	else{
		echo "Fill all the field";
	}



?>
	 <!-- HERE GOES HTML, JS CODE -->
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
							<div class="form-group">
								<label for="">Location :</label> 
								<select name="location" id="inputState" class="form-control">
									<option selected value='dhaka'>Dhaka</option>
									<option value='sylhet'>Sylhet</option>
									<option value='chittagong'>Chittagong</option>
								</select>
							</div>
							<div class="form-group">
								<label for="">Category :</label> 
								<select name="category" id="inputState" class="form-control">
									<option value="" disabled selected hidden>Frontend, Backend etc...</option>
									<option value='frontend'>Frontend</option>
									<option value='backend'>Backend</option>
									<option value='fullstack'>Fullstack</option>
									<option value='graphics'>Graphics</option>
									<option value='testing'>Testing</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Responsibilities :</label> 
								<textarea class="form-control" rows="15" name="responsibility"></textarea>
							</div>
							<div class="form-group">
								<label for="">Requirements :</label> 
								<textarea class="form-control" rows="16" name="requirements"></textarea>
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

	<!-- All Posted Jobs from Here  -->
	<div class="container-fluid">
		<div class="table-responsive-lg">
			<h2 class="mt-5 mb-4 pt-5">ALL POSTED JOBS</h2>
			<table class="table table-bordered">
				<!-- <caption>List of users</caption> -->
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Position</th>
						<th scope="col">Expertise</th>
						<th scope="col">Experience</th>
						<th scope="col">Type</th>
						<th scope="col">Salary</th>
						<th scope="col">Responsibilities</th>
						<th scope="col">Requirements</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					foreach ($allJobs as $row) { 
    				// printf("%s (%s)\n", $row["id"], $row["position"]); ?>	
					<tr>
						<th scope="row"><?php echo ($row['id']); ?></th>
						<td><?php echo ($row['position']); ?></td>
						<td><?php echo ($row['expertise']); ?></td>
						<td><?php echo ($row['experience']); ?></td>
						<td><?php echo ($row['type']); ?></td>
						<td><?php echo ($row['salary']); ?></td>
						<td><?php echo ($row['responsibility']); ?></td>
						<td><?php echo ($row['requirements']); ?></td>
						<td>
							
							<!-- data-toggle="modal" data-target="#editJobModal" -->
							<!-- <button class="btn customBtn green-light">View Job</button> -->
							<form method="POST">
								<input type='submit' name="viewEdit"  class="btn customBtn green-light" value="EDIT">
								<button type="submit" name="view" class="btn customBtn green-light">VIEW STATUS</button>
					 			<button type='submit' name="delete" class="btn customBtn bg-danger text-white">Delete</button>
								<input type="hidden" name="hiddenJobId" value="<?php echo ($row['id']); ?>">
							</form>
						</td>
					</tr>
					<?php } ?>	
				</tbody>
			</table>
		</div>
	</div>
	

	


	<?php 
		include("includes/footer.php");
		// include("editJob.php");
	?>
	
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>


<script>
	// this part is copied to other pages. FUture Work : make a js file and code all common js there and import where needed
	const vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0)
	console.log(vw > 768);
	if(vw > 768){
		window.onscroll = function() {enableNavBg()};

		function enableNavBg() {
			let navbar = document.querySelector(".navbar");
			if (document.body.scrollTop > 5 || document.documentElement.scrollTop > 5) {
			
				console.log(navbar)
				navbar.classList.add("bg-light");
				navbar.classList.remove("bg-transparent");
				//  navbar.classList.toggle("bg-primary");
			} 
			else {
				navbar.classList.add("bg-transparent");
				navbar.classList.remove("bg-light");
			}

		}

	}
</script>


</body>
<?php
echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
}
else{
	echo '<script>alert("Please Log In First")</script>';
	// header("location:index.php"); 
	"<script>$('#loginModal').modal('show');</script>";
}



?>








	

</html>