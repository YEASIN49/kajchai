<?php 
include("includes/config.php");
session_start();


$currentID = $_SESSION['editableJobId'];
$currentPosition = $_SESSION['editableJobPosition'];
$currentCompany = $_SESSION['editableJobCompany'];
$currentExpertise = $_SESSION['editableJobExpertise'];
$currentExperience = $_SESSION['editableJobExperience'];
$currentType = $_SESSION['editableJobType'];
$currentSalary = $_SESSION['editableJobSalary'];
$currentResponsibility = $_SESSION['editableJobResponsibility'];
$currentRequirements = $_SESSION['editableJobRequirements'];



if(!isset($_SESSION['email']) or $_SESSION['role'] != 'employer'){
	die('<script>alert("You are not allowed here ! Only employers are expected!");
			location.replace("index.php");
	</script>');
	// echo '<script>alert("Please Log In First");</script>';
	// header("location:index.php");
}
if(isset($_SESSION['email']) and $_SESSION['role'] == 'employer'){
	

	if (isset($_POST['save'])) {

		$position = $_POST['position'];
		$company = $_POST['company'];
		$expertise = $_POST['expertise'];
		$experience = $_POST['experience'];
		$type = $_POST['type'];
		$salary = $_POST['salary'];
		$responsibility = $_POST['responsibility'];
		$requirements = $_POST['requirements'];
		$employer_id = $_SESSION['id'];
	
		$sql = "UPDATE jobs
			 SET position = '$position', company = '$company', expertise = '$expertise', experience = '$experience', type='$type', salary = '$salary', responsibility = '$responsibility', requirements = '$requirements' WHERE id = $currentID";
		// die($sql);
		$result=$conn->query($sql);
	
		if ($result) {
			// header('Location: postedJob.php');
			die("<script>alert('Job Updated Successfully');
			location.replace('postedJob.php');
			</script>");
		}else{
			echo 'Job Update Failed :(';
		}
	}
	else{
		echo "Fill all the field";
	}


// echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';

?>

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
		
<!-- <div class="modal fade" id="editJobModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">VIEW/EDIT JOB</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> -->
			
			<div class="container py-5">
				<h2 class="mt-5 mb-4">SELECTED JOB DETAILS</h2>
				<div class="row">
					<div class="col-md-12">
						<form action="" method="post">	
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Position :</label> 
										<input class="form-control" type="text" name="position" value="<?php echo $currentPosition; ?>">
									</div>
									<div class="form-group">
										<label for="">Company Name :</label> 
										<input class="form-control" type="text" name="company" value="<?php echo $currentCompany; ?>">
									</div>
									<div class="form-group">
										<label for="">Expertise Level :</label> 
										<input class="form-control" type="text" name="expertise" value="<?php echo $currentExpertise; ?>">
									</div>
									<div class="form-group">
										<label for="">Experience :</label> 
										<input class="form-control" type="text" name="experience" value="<?php echo $currentExperience; ?>">
									</div>
									<div class="form-group">
										<label for="">Type :</label> 
										<input class="form-control" type="text" name="type" value="<?php echo $currentType; ?>">
									</div>
									<div class="form-group">
										<label for="">Salary :</label> 
										<input class="form-control" type="text" name="salary" value="<?php echo $currentSalary; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Responsibilities :</label> 
										<textarea id="responsibility" class="form-control" rows="11" name="responsibility"><?php echo $currentResponsibility; ?></textarea>
									</div>
									<div class="form-group">
										<label for="">Requirements :</label> 
										<textarea id="requirements" class="form-control" rows="11" name="requirements"><?php echo $currentRequirements; ?></textarea>
									</div>
								
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<button type="submit" name="save" style="width: 180px;" class="btn green-light customBtn">SAVE EDIT</button>
									<button onclick="(function(){
										location.replace('postedJob.php');
										return false;
									})();return false" style="width: 180px;" class="btn green-light customBtn">CANCEL EDIT</button>
								</div>
							</div>
						</form>
					</div>								
				</div>			
			</div>										

      <!-- </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> 
      </div>
    </div>
  </div>
</div> -->



<?php 
		include("includes/footer.php");
		// include("editJob.php");
	?>
	

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<script>
	document.getElementById('responsibility').innerHTML = <?php $currentResponsibility ?>;
	document.getElementById('requirements').innerHTML = <?php $currentRequirements ?>;

</script>

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


<?php } ?>
</body>
