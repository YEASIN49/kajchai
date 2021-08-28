<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Launch demo modal
</button> -->

<!-- Modal -->

<?php 

include("includes/config.php");

if(isset($_POST['create'])){

	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$location = $_POST['location'];
	$roletype = $_POST['role'];
	// echo "<script>alert('$sql')</script>";

	function insertQuery($sqlQuery){
		global $conn;
		// global $roletype;
		$result=$conn->query($sqlQuery);
		if ($result) {
			echo '<script>alert("Registered Successfull")</script>';
			// echo '<script>location.replace("postedJob.php")</script>';
			// sleep(2);
			// header("location:appliedJob.php"); 
			// die('');
			exit();
		}else{
			echo 'signup failed :(';
		}
		
	}

	if($roletype == 'user'){
		$sql = "INSERT INTO `user`(`name`, `email`, `password`, `location`, `roletype`) VALUES ('$name','$email','$password','$location','$roletype')";
		insertQuery($sql);
	}
	else{
		$sql = "INSERT INTO `employers`(`name`, `email`, `password`, `location`, `roletype`) VALUES ('$name','$email','$password','$location','$roletype')";
		insertQuery($sql);
	}

	// echo "<script>alert('$sql')</script>";
	// $result=$conn->query($sql);
	// echo "<script>alert('$result')</script>";

	// if ($_POST[uname] == 'abul' and $_POST['passwd'] == 'p') {
	

	
	// echo "<script>alert('$email')</script>";
	// echo "<script>alert('$password')</script>";
	// echo "<script>alert('$location')</script>";
	// echo "<script>alert('$roletype')</script>";

		
}else{
	echo "Fill all the field";
}

?>

<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">REGISTER</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
			<form action="" method="post">
				<div class="form-group">
					<label for="exampleInputEmail1">Your Name</label>
					<input type="text" name="name" class="form-control" id="" aria-describedby="nameHelp" placeholder="Enter Your Name">
					<!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Email address</label>
					<input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
					<!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Password</label>
					<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Location</label>
					<!-- <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"> -->
					<select id="inputState" name="location" class="form-control">
						<option selected>Dhaka</option>
						<option>Sylhet</option>
						<option>Chittagong</option>
					</select>
				</div>

				<div class="form-group">
					<!-- <label for="exampleInputPassword1">Password</label>
					<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"> -->

					<input type="radio" id="user" name="role" value="user">
					<label for="user">Employee</label><br>
					<input type="radio" id="employer" name="role" value="employer">
					<label for="employer">Employer</label><br>	
				</div>

				
				<!-- <div class="form-check">
					<input type="checkbox" class="form-check-input" id="exampleCheck1">
					<label class="form-check-label" for="exampleCheck1">Check me out</label>
				</div> -->
				<button type="submit" name="create" class="btn card-btn green">CREATE</button>
			</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
