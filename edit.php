<?php
require("auth.php");
require('db.php');

$id=$_REQUEST['id'];
$query = "SELECT * FROM user where id='".$id."'";
$result = mysqli_query($con, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);

// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT * FROM user WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($id, $username, $full_name, $birth_date, $email_address, $password, $user_type, $isAdmin);
$stmt->fetch();
$stmt->close();


$msg="";
if(isset($_POST['password'])) {
  $password = $_POST['password'];
  $number = preg_match('@[0-9]@', $password);
  $uppercase = preg_match('@[A-Z]@', $password);
  $lowercase = preg_match('@[a-z]@', $password);
  $specialChars = preg_match('@[^\w]@', $password);
 
  if(strlen($password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
    $msg = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
  } else {
    $msg = "Your password is strong.";
	  
	  $status = "";
						if(isset($_POST['new']) && $_POST['new']==1) {
							$id=$_REQUEST['id'];
							$username =$_REQUEST['username'];
							$full_name=$_REQUEST['full_name'];
							$email_address =$_REQUEST['email_address'];
							$password =$_REQUEST['password'];
							$user_type =$_REQUEST['user_type'];
							$isAdmin =$_REQUEST['isAdmin'];
							$update="update user set username='".$username."', full_name='".$full_name."', email_address='".$email_address."', 
											password='".$password."', user_type='".$user_type."', isAdmin='".$isAdmin."' where id='".$id."'";
							mysqli_query($con, $update) or die(mysqli_error());
							$status = "Record Updated Successfully.";
							//echo '<p style="color:#FF0000;">'.$status.'</p>';
							/*if ($_SESSION['id'] >= 1 && $_SESSION['id'] <= 10) {
								echo "</br></br> <a href='users.php'>View Updated Record</a>";
							}*/
							}
	  
	  $status = "";
		if(isset($_POST['new']) && $_POST['new']==1) {
									$id=$_REQUEST['id'];
									$full_name=$_REQUEST['full_name'];
									$user_id=$_REQUEST['user_id'];
									$name=$_REQUEST['name'];
									$user_type =$_REQUEST['user_type'];
									$seed_harvest=$_REQUEST['seed_harvest'];
									$type_user=$_REQUEST['type_user'];

									$ins_query ="update top_5_gardeners set name='".$full_name."', type_user='".$user_type."' where user_id='".$id."'";
									mysqli_query($con, $ins_query) or die(mysqli_error());
									$status = "New User Added Successfully.";
									//echo '<p style="color:#FF0000;">'.$status.'</p>';
									}
  }
}




?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		
		<!-- Bootstrap CSS -->
    	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
			  rel="stylesheet" 
			  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
			  crossorigin="anonymous">
		
	</head>
	<body class="loggedin">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
		  <div class="container-fluid">
			<a class="navbar-brand" href="#">Dynamic Seed Database</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			  <span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
			  <ul class="navbar-nav">
				<li class="nav-item">
				  <a class="nav-link active" aria-current="page" href="home.php">Home</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="seed-page.php">Seed Details</a>
				</li>
				<?php
				if ($isAdmin == 'yes') {
				echo  '<li class="nav-item active"><a class="nav-link" href="users.php">Users</a></li>',
					  '<li class="nav-item"><a class="nav-link" href="alert-and-report.php">Reports</a></li>';
					 
				} ?>
				  <li class="nav-item"><a class="nav-link" href="seed-database.php">Database</a></li>
				<li class="nav-item">
				  <a class="nav-link" href="inventory.php">Inventory</a>
				</li>
				<li class="nav-item dropdown">
				  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					Menu
				  </a>
				  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					<li><a class="dropdown-item" href="profile.php">Profile</a></li>
					<li><a class="dropdown-item" href="notification.php">Notifications</a></li>
					<li><a class="dropdown-item" href="logout.php">Logout</a></li>
				  </ul>
				</li>
			  </ul>
			</div>
		  </div>
		</nav>
		
		
		<div class="mt-3">
			<div class="container">
				<h2>Profile Page</h2>
				<p>Edit the records here:</p>
				
					
							<div>
							<form name="form" method="post" action="" class="row g-3"> 
							<input type="hidden" name="new" value="1" />
							<input name="id" type="hidden" value="<?php echo $row['id'];?>" />
							
							<div class="col-md-4">
							<label for="username" class="form-label">Username:</label>
							<input type="text" class="form-control" name="username" placeholder="Enter Name" required value="<?php echo $row['username'];?>" />
							</div>
								
							<div class="col-md-4">	
							<label for="full_name" class="form-label">full name:</label>
							<input type="text" class="form-control" name="full_name" placeholder="Full Name" required value="<?php echo $row['full_name'];?>" />	
							</div>
								
							<div class="col-md-4">	
							<label for="email_address" class="form-label">Email:</label>
							<input type="text" class="form-control" name="email_address" placeholder="Enter Email" value="<?php echo $row['email_address'];?>" />
							</div>
								
							<div class="col-md-4">
							<label for="password" class="form-label">Password:</label>
							<input type="text" class="form-control" name="password" placeholder="Enter Password" required value="<?php echo $row['password'];?>" />
							</div>
								
							<div class="col-md-4">
							<label for="user_type"  class="form-label">User Type:</label>
								<select id="user_type" class="form-control" name="user_type">
									<?php
									if ($user_type == 'Employee' || $user_type == 'Gardener') {
									?>
									<option value="<?php echo $row['user_type'];?>"><?php echo $row['user_type'];?></option>
									<?php
									}
									?>
									<?php
									if ($isAdmin == 'yes') {
									?>
									<option value="<?php echo $row['user_type'];?>"><?php echo $row['user_type'];?></option>
									<option value="Administrator">Administrator</option>
									<option value="Employee">Employee</option>
									<option value="Gardener">Gardener</option>
									<?php
									}
									?>
								</select>
							</div>
								
							<div class="col-md-4">	
							<label for="isAdmin" class="form-label">is Admin?:</label>
								<select id="isAdmin" class="form-select" name="isAdmin">
									<?php
									if ($user_type == 'Employee' || $user_type == 'Gardener') {
									?>
									<option value="<?php echo $row['isAdmin'];?>"><?php echo $row['isAdmin'];?></option>
									<?php
									}
									?>
									<?php
									if ($isAdmin == 'yes') {
									?>
									<option value="<?php echo $row['isAdmin'];?>"><?php echo $row['isAdmin'];?></option>
									<option value="yes">yes</option>
									<option value="no">no</option>
									<?php
									}
									?>
								</select>
							</div>
								
							<p><input name="submit" type="submit" class="btn btn-success btn-sm" value="Update" /></p>
							</form>
								
							<?php echo $msg?>
							<p style="color:#FF0000;"><?php echo $status; ?></p>
							
							
					
				</div>
				
			</div>
		</div>
	
		
		<!-- Option 1: Bootstrap Bundle with Popper -->
    	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
			integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
			crossorigin="anonymous"></script>
		
	</body>
</html>