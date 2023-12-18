<?php
require("auth.php");
require('db.php');

// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT * FROM user WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($id, $username, $full_name, $birth_date, $email_address, $password, $user_type, $isAdmin);
$stmt->fetch();
$stmt->close();

// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT * FROM top_5_gardeners');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$stmt->bind_result($user_id, $name, $seed_harvest);
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
									$birth_date =$_REQUEST['birth_date'];
									$email_address =$_REQUEST['email_address'];
									$password =$_REQUEST['password'];
									$user_type =$_REQUEST['user_type'];
									$isAdmin =$_REQUEST['isAdmin'];
									$ins_query ="insert into user (`id`, `username`, `full_name`, `birth_date`, `email_address`, `password`, `user_type`, `isAdmin`)
									values('$id','$username','$full_name','$birth_date','$email_address','$password','$user_type','$isAdmin')";
									mysqli_query($con, $ins_query) or die(mysqli_error());
									$status = "New User Added Successfully.";
									//echo '<p style="color:#FF0000;">'.$status.'</p>';
									}

		$status = "";
		if(isset($_POST['new']) && $_POST['new']==1) {
									$id=$_REQUEST['id'];
									$full_name=$_REQUEST['full_name'];
									$user_id=$_REQUEST['user_id'];
									$name=$_REQUEST['name'];
									$seed_harvest=$_REQUEST['seed_harvest'];

									$ins_query ="insert into top_5_gardeners (`user_id`, `name`, `seed_harvest`, `type_user`)
									values('$id','$full_name', '0', '$user_type')";
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
		<title>Home Page</title>
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
				  <a class="nav-link" aria-current="page" href="home.php">Home</a>
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
		<div class="content">
			<h2>Add Profile Page</h2>
			<div>
				<p>Add a New User here:</p>
				
				<form name="form" method="post" action=""> 
							<input type="hidden" name="new" value="1" />
							
							<label for="id">ID:</label><br>
							<p><input type="text" name="id" placeholder="Enter ID" required /></p>	
							
							<label for="username">Username:</label><br>
							<p><input type="text" name="username" placeholder="Enter Name" required/></p>
							
							<label for="full_name">Full Name:</label><br>
							<p><input type="text" name="full_name" placeholder="Full Name" required/></p>
							
							<label for="birth_date">Birth Date: yyyy-mm-dd</label><br>
							<p><input type="text" name="birth_date" placeholder="Birth Date" required/></p>
							
							<label for="email_address">Email:</label><br>
							<p><input type="text" name="email_address" placeholder="Enter Email" required/></p>
							
							<label for="password">Password:</label><br>
							<p><input type="text" name="password" placeholder="Enter Password" required/></p>
								
							<label for="user_type">User Type:</label><br>
								<p><select id="user_type" name="user_type">
									<option value="Administrator">Administrator</option>
									<option value="Employee">Employee</option>
									<option value="Gardener">Gardener</option>
								</select></p>
							
							<label for="isAdmin">Is Admin?:</label><br>
								<p><select id="isAdmin" name="isAdmin">
									<option value="yes">Yes</option>
									<option value="no">No</option>
								</select></p>
							<p><input name="submit" type="submit" value="Add" /></p>
							</form>
				<?php echo $msg?>
				<p style="color:#FF0000;"><?php echo $status; ?></p>

			</div>
		</div>
		<!-- Option 1: Bootstrap Bundle with Popper -->
    	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
			integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
			crossorigin="anonymous"></script>
	</body>
</html>