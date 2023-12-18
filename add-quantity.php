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
$stmt = $con->prepare('SELECT * FROM seeds_inventory');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['seed_id']);
$stmt->execute();
$stmt->bind_result($seed_id, $seed_name, $quantity, $plant_date, $harvest_date, $purchase_date);
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

// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT * FROM top_5_harvested');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['harvested_id_seed']);
$stmt->execute();
$stmt->bind_result($harvested_id_seed, $harvested_name_seed, $amount_seed_harvest);
$stmt->fetch();
$stmt->close();





$seed_number = $_GET['seed_id'];


$status = "";
if(isset($_POST['new']) && $_POST['new']==1) {
	$quantity=$_REQUEST['quantity'];
	//$quantity1=$_REQUEST['quantity1'];
	$update = "UPDATE seeds_inventory SET quantity = quantity + '".$quantity."' where seed_id='".$seed_number."'";
	
	mysqli_query($con, $update) or die(mysqli_error());
	$status = "Added Quantity Successfully.";
	//echo '<p style="color:#FF0000;">'.$status.'</p>';
}

$date = date('Y-m-d');
$status = "";
if(isset($_POST['new']) && $_POST['new']==1) {
	$quantity=$_REQUEST['quantity'];
	//$quantity1=$_REQUEST['quantity1'];
	$update = "UPDATE seeds_inventory SET harvest_date = '".$date."' where seed_id='".$seed_number."'";
	
	mysqli_query($con, $update) or die(mysqli_error());
	$status = "Added Quantity Successfully.";
	//echo '<p style="color:#FF0000;">'.$status.'</p>';
}

$status = "";
if(isset($_POST['new']) && $_POST['new']==1) {
	$quantity=$_REQUEST['quantity'];
	$quantity1=$_REQUEST['quantity1'];
	$update = "UPDATE Seeds SET quantity1 = quantity1 + '".$quantity."' where seed_id='".$seed_number."'";
	
	mysqli_query($con, $update) or die(mysqli_error());
	$status = "Added Quantity Successfully.";
	//echo '<p style="color:#FF0000;">'.$status.'</p>';
}

$status = "";
if(isset($_POST['new']) && $_POST['new']==1) {
	$user_id=$_REQUEST['user_id'];
	$seed_harvest=$_REQUEST['seed_harvest'];
	$id=$_REQUEST['id'];
	$quantity=$_REQUEST['quantity'];
	$update = "UPDATE top_5_gardeners SET seed_harvest = seed_harvest + '".$quantity."' where user_id='".$_SESSION['id']."'";
	
	mysqli_query($con, $update) or die(mysqli_error());
	$status = "Added Quantity Successfully.";
	//echo '<p style="color:#FF0000;">'.$status.'</p>';
}

$status = "";
if(isset($_POST['new']) && $_POST['new']==1) {
	$harvested_id_seed=$_REQUEST['harvested_id_seed'];
	$amount_seed_harvest=$_REQUEST['amount_seed_harvest'];
	$quantity=$_REQUEST['quantity'];
	$update = "UPDATE top_5_harvested SET amount_seed_harvest = amount_seed_harvest + '".$quantity."' where harvested_id_seed='".$seed_number."'";
	
	mysqli_query($con, $update) or die(mysqli_error());
	$status = "Added Quantity Successfully.";
	//echo '<p style="color:#FF0000;">'.$status.'</p>';
}

$date = date('Y-m-d');
$status = "";
if(isset($_POST['new']) && $_POST['new']==1) {
	$quantity=$_REQUEST['quantity'];
	//$quantity1=$_REQUEST['quantity1'];
	$update = "UPDATE Seeds SET SeedHarvest = '".$date."' where seed_id='".$seed_number."'";
	
	mysqli_query($con, $update) or die(mysqli_error());
	$status = "Added Quantity Successfully.";
	//echo '<p style="color:#FF0000;">'.$status.'</p>';
}

$status = "";
if(isset($_POST['new']) && $_POST['new']==1) {
	$SeedHarvest=$_REQUEST['SeedHarvest'];
	$years=$_REQUEST['years'];
	$ExpireDate=$_REQUEST['ExpireDate'];
	$update = "UPDATE Seeds SET ExpireDate = DATE_ADD(SeedHarvest, INTERVAL years year)";
	
	mysqli_query($con, $update) or die(mysqli_error());
	$status = "Added Quantity Successfully.";
	//echo '<p style="color:#FF0000;">'.$status.'</p>';
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
			<h2>Add Harvested Page</h2>
			<div>
				<p>Add Harvested Quantity:</p>
				
				<form name="form" method="post" action=""> 
					<input type="hidden" name="new" value="1" />
							
					<label for="quantity">Quantity:</label><br>
					<p><input type="text" name="quantity" placeholder="Enter value"  /></p>
					
							
							
					<p><input name="submit" type="submit" value="update" /></p>
					
					
					</form>
				<p style="color:#FF0000;"><?php echo $status; ?></p>
				
			</div>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
			integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
			crossorigin="anonymous"></script>
	</body>
</html>