<?php
include("includes/config.php");
session_start();



$sqlSelect = "SELECT * FROM jobs WHERE id = '".$_SESSION['jobID']."'";
	
$jobResult=$conn->query($sqlSelect) or die('<script>alert("SQL Query Failed");</script>');
		// echo ($result);
$row = $jobResult->fetch_assoc();
		// echo $row['option_value'];
	
if (!empty($row)){
	echo ('("job fetched")');

	// echo("HERE ");
	// echo ($rows['position']);
}else{
	echo '("Job Fetch Failed")';
}


if(isset($_POST['apply'])){
	if(!empty($_SESSION['id']) && $_SESSION['role'] == 'user'){
			// echo('<script>alert("Currently Logged IN");</script>');
			// $submitted = true;
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

	<title>View Job</title>
</head>
<body>

<?php include("includes/navbar.php")?>

<div class="container jobContainer mt-5 pt-5 px-5">
		<h3 class="font-weight-bold mb-3">JOB DETAILS</h3>
		<div class="pt-2 pb-5 pl-4">
			<p class="card-text"><small class="text-muted"><?php echo ($row['company']); ?></small></p>

			<h4 class="font-weight-bold mb-2"><?php echo($row['position']); ?></h4>

			<!-- <h5 class="card-title font-weight-bold"><?php echo ($row['position']); ?></h5> -->
			<p class="card-text mb-0"><span style="font-weight: 500">Experience :</span> <?php echo ($row['experience']); ?></p>
			<p class="card-text mb-0"><span style="font-weight: 500">Expertise Level :</span> <?php echo ($row['expertise']); ?></p>
			<p class="card-text mb-0"><span style="font-weight: 500">Type :</span> <?php echo ($row['type']); ?></p>
			<p class="card-text mb-2"><span style="font-weight: 500">Salary :</span> <?php echo ($row['salary']); ?></p>
			<p class="card-text mb-5"><span style="font-weight: 500">Responsibilities : </span><?php echo ($row['responsibility']); ?></p>
			<p class="card-text mb-5"><span style="font-weight: 500">Requirements : </span><?php echo ($row['requirements']); ?></p>
			<a type="submit" href="./index.php" class="btn card-btn green py-3">BACK</a>
			<form action="" method="post" class="py-2 d-inline">
				
				<input type="hidden" name="jobID" value="<?php echo($row['id']);?>">
				
				<button type="submit" name="apply" id="applyBtn" class="btn card-btn btn-apply green py-3">APPLY</button>
			</form>

		</div>
	</div>

<?php include("includes/footer.php")?>

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
</html>

<?php
include("login.php");
include("register.php");
echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
?>