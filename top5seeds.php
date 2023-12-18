<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'phpmyadmin';
$DATABASE_PASS = 'root';
$DATABASE_NAME = 'dynamic_seed_management';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT password, isAdmin FROM user WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $isAdmin);
$stmt->fetch();
$stmt->close();
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Seed Inventory</title>
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
		
		
		<div class="mt-3">
			<div class="container-fluid">
				<p>	Top 5 Harvested Seeds: <br></p>
				<table class="table">
					<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Seed Name</th>
						<th scope="col">QTY</th>
					</tr>
					</thead>
					<?php
					$query = mysqli_query($con, "SELECT * FROM top_5_harvested ORDER by amount_seed_harvest DESC limit 5");
					while($row = mysqli_fetch_assoc($query)){ ?>
					<tr>
						<td><?php echo $row['harvested_id_seed']; ?></td>
						<td><?php echo $row['harvested_name_seed']; ?></td>
						<td><?php echo $row['amount_seed_harvest']; ?></td>
						
					</tr> 
					<?php } ?>	
				</table>
				
				<p>	Top 5 Wasted Seeds: <br></p>
				<table class="table">
					<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Seed Name</th>
						<th scope="col">QTY</th>
					</tr>
					</thead>
					<?php
					$query = mysqli_query($con, "SELECT * FROM top_5_wasted ORDER by amount_seed_wasted DESC limit 5");
					while($row = mysqli_fetch_assoc($query)){ ?>
					<tr>
						<td><?php echo $row['wasted_id_seed']; ?></td>
						<td><?php echo $row['wasted_name_seed']; ?></td>
						<td><?php echo $row['amount_seed_wasted']; ?></td>
						
					</tr> 
					<?php } ?>	
				</table>
			</div>
		</div>
		
		
		<!-- Option 1: Bootstrap Bundle with Popper -->
    	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
			integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
			crossorigin="anonymous"></script>
	</body>
</html>