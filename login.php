<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Launch demo modal
</button> -->


<?php 
	// session_start();
	include("includes/config.php");

	
	if (isset($_POST['login'])) {
		
		$email = $_POST['email'];
		$password = $_POST['password'];
		$roletype = $_POST['role'];

		function runLoginQuery($sqlQuery){
			global $conn;
			$result=$conn->query($sqlQuery);

			if ($row= $result->fetch_assoc()) {
				echo '<script>alert("Logged In")<script>';
				// $_SESSION['is_login'] = true;
				$_SESSION['email'] = $_POST['email']; 
				// echo '<script>alert("Logged In")<script>';
				// header('Location: postedJob.php');
				echo '<script>alert("Logged In")</script>';
				die("<script>alert('Logged In Successfull')</script>");
				exit();
			}else{
				echo '<script>alert("Log In Failed")</script>';
			}

		}

		if($roletype == 'employee'){
			$sql = "SELECT * FROM user WHERE email='$email' and password = '$password'";
			runLoginQuery($sql);

		}
		elseif($roletype == 'employer'){
			$sql = "SELECT * FROM employers WHERE email='$email' and password = '$password'";
			runLoginQuery($sql);
		}
		// echo `<script>console.log("test"+'$email')<script>`;
		// include 'includes/config.php';
		
		// echo `<script>console.log("test"+'$email'+','+'$sql')<script>`;
		// $result=$conn->query($sql);

		// if ($_POST[uname] == 'abul' and $_POST['passwd'] == 'p') {
		
	}
 ?>


<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">LOG IN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<form action="<?php htmlentities($_SERVER['PHP_SELF']);?>" method="POST">
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
					<input type="radio"  name="role" value="employee">
					<label for="user" name="employee">Employee</label><br>
					<input type="radio"  name="role" value="employer">
					<label for="employer" name="employer">Employer</label><br>	
				</div>
				<!-- <div class="form-check">
					<input type="checkbox" class="form-check-input" id="exampleCheck1">
					<label class="form-check-label" for="exampleCheck1">Check me out</label>
				</div> -->
				<button type="submit" name="login" class="btn card-btn green">LOG IN</button>
			</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>