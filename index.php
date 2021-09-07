<?php 
	session_start();
	include("includes/config.php");

	$allJobs;
	
	// function fetchJobList(){
	// 	global $allJobs;
		global $conn;
		// $email =$_SESSION["email"];
		// $employer_id = $_SESSION["id"];
		// $roletype = $_SESSION["role"];
		$sqlSelect = "SELECT * FROM jobs";
	
		$allJobs=$conn->query($sqlSelect) or die('<script>alert("Log In Failed");</script>');
		// echo ($result);
		
	
				if (!empty($allJobs)){
					echo ('("All job fetched")');
				
					// echo("HERE ");
					// echo ($rows['position']);
				}else{
					echo '("Job Fetch Failed")';
				}
			
	// }
	// fetchJobList();
	// $submitted;
	if(isset($_POST['view'])){
		$_SESSION['jobID'] = $_POST['jobID'];
		header("location: viewJob.php");
	}
	if(isset($_POST['apply'])){
		if(!empty($_SESSION['id']) && $_SESSION['role'] == 'user'){
				// echo('<script>alert("Currently Logged IN");</script>');
				$submitted = true;
				$userID = $_SESSION['id'];
				$jobID = $_POST['jobID'];
				// $_SESSION['disableBtnId'] = $_POST['jobID'];

				$insertQuery = "INSERT INTO `application`(`job_id`, `user_id`) VALUES ('$jobID','$userID')";
			
				$insertResult=$conn->query($insertQuery);
				if ($insertResult) {
					// echo ('<script>
				// 			alert("Apply Successfull");
				// 		</script>');
				// echo '<script>location.replace("postedJob.php")</script>';
				// sleep(2);
				// header("location:index.php"); 
				die('<script>
					alert("Apply Successfull");
					location.replace("index.php");
				</script>');
				// exit();
				}else{
					echo 'Apply Failed !!! ';
				}

			}
			else{
				echo('<script>alert(" Please Log in as a User First");</script>');
			}
	}
	




?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<?php include("includes/docHeaderInfo.php")?>
	
	<title>KAJCHAI</title>
</head>

<body>

<?php 
	include("includes/navbar.php");
	// echo ($allJobs);	
?>

<?php foreach ($allJobs as $row) { 
    				// printf("%s (%s)\n", $row["id"], $row["position"]); 
					 echo $row['id'];}?>

<!--******************** 

***  Hero Image Section

***********************-->

<div class="hero-container position-relative">
  <div class="hero-text mr-5 position-absolute">
    <h1 style="font-weight:800">FIND OR SELL SKILLS THAT YOU DESIRE</h1>
    <p>Search Your Skills</p>
    <!-- <button>Hire me</button> -->
	 <form>
			<div class="form-row">
				<div class="form-group col-md-5 p-0 m-0">
					<!-- <label for="inputEmail4">Email</label> -->
					<input type="text" class="form-control" placeholder="programming, Finance etc..." id="inputEmail4">
				</div>
				<div class="form-group col-md-4 p-0 m-0">
				<!-- <label for="inputState">State</label> -->
					<select id="inputState" class="form-control">
						<option selected>Dhaka</option>
						<option>Sylhet</option>
						<option>Chittagong</option>
					</select>
				</div>
				<button type="submit" class="btn customBtn green">SEARCH</button>
			</div>
		</form>
  </div>
</div>

<!-- **********************************

 ******** Section Divider Style

*********************************** -->
<div class="dividerContainer">
	<div class="box">

	</div>
</div>


<!-- **********************************

 ******** Job Listing Container

*********************************** -->


<div class="jobListContainer my-5 mx-4 pt-5">
	<h3 class="font-weight-bold text-center">EXPLORE ALL THE VACANCIES</h3>
	<p class="text-center explore position-relative"><span class="material-icons">work_outline</span></p>

	<div class="card-group pb-5 ">
		
		<?php foreach ($allJobs as $row) { 
    				// printf("%s (%s)\n", $row["id"], $row["position"]); ?>	
		<div class="card">
			<!-- <img src="..." class="card-img-top" alt="..."> -->
			<div class="card-body">
			
				<p class="card-text"><small class="text-muted"><?php echo ($row['company']); ?></small></p>
				<h5 class="card-title font-weight-bold"><?php echo ($row['position']); ?></h5>
				<p class="card-text mb-0"><span style="font-weight: 500">Experience :</span> <?php echo ($row['experience']); ?></p>
				<p class="card-text mb-0"><span style="font-weight: 500">Expertise Level :</span> <?php echo ($row['expertise']); ?></p>
				<p class="card-text mb-2"><span style="font-weight: 500">Salary :</span> <?php echo ($row['salary']); ?></p>
				<p class="card-text mb-5"><span style="font-weight: 500">Requirements : </span><?php echo ($row['requirements']); ?></p>
				<form action="" method="post" class="py-2">
					
					<input type="hidden" name="jobID" value="<?php echo($row['id']);?>">
					<button type="submit" name="view" class="btn card-btn green position-absolute form-control">VIEW</button>
					<button type="submit" name="apply" 
					
					<?php 
						// if(isset($_SESSION['disableBtnId'])){
						// 	if($row['id'] == $_SESSION['disableBtnId']){
						// 		echo('disabled');
						// 	}
						// }
					?> id="applyBtn" class="btn card-btn btn-apply green position-absolute form-control">APPLY</button>
				</form>
				
				<!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
			
			</div>
		</div>
		<?php } ?>
		
	</div>
</div>



<?php include("login.php");
		include("register.php");
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
<?php include("includes/footer.php")?>

<?php
echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
?>