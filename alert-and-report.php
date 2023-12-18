<!-- 

This  is a hidden page that will automatically run a monthly report on a specified date and send the report as an email 

-->
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
$stmt = $con->prepare('SELECT * FROM user WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($id, $username, $full_name, $birth_date, $email_address, $password, $user_type, $isAdmin);
$stmt->fetch();
$stmt->close();
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Report</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		
		<!-- Bootstrap CSS -->
    	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
			  rel="stylesheet" 
			  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
			  crossorigin="anonymous">
		
		
		<!-- 	AJAX Library	 -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   		<script type="text/javascript">
        $(function() {
            $("#query").load("sql-query.php");
        });
    	</script>
		
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
					  '<li class="nav-item"><a class="nav-link" href="alert-and-report.php">Reports</a></li>',
					  '<li class="nav-item"><a class="nav-link" href="seed-database.php">Database</a></li>';							
				} ?>
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
			<div>
		<div class="mt-3">
			<div class="container-fluid">
				<p><b>Monthly Report: </b><br>
				<i>Report generated monthly and emailed to Employees</i>
				</p>
				<table class="table">
					<thead>
					<tr>
						<th scope="col">Seed ID</th>
						<th scope="col">Seed Name</th>
						<th scope="col">QTY</th>
					</tr>
					</thead>
					<?php
					$query = mysqli_query($con, "SELECT * FROM seeds_inventory WHERE quantity<1000;");
					while($row = mysqli_fetch_assoc($query)){ ?>
					<tr>
						<td><?php echo $row['seed_id']; ?></td>
						<td><?php echo $row['seed_name']; ?></td>
						<td><?php echo $row['quantity']; ?></td>
						
					</tr> 
					<?php } ?>	
				</table>
				
				<p><b>Expiring Soon Report:</b> <br>
				<i>Report generated when seed expiry date is less than or equal to 1 year</i>
				</p>
				<table class="table">
					<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Seed Name</th>
						<th scope="col">Expiry Date</th>
						<th scope="col">QTY</th>
					</tr>
					</thead>
					<?php
					$query = mysqli_query($con, "SELECT * FROM Seeds WHERE years<=1;");
					while($row = mysqli_fetch_assoc($query)){ ?>
					<tr>
						<td><?php echo $row['seed_id']; ?></td>
						<td><?php echo $row['SeedName']; ?></td>
						<td><?php echo $row['ExpireDate']; ?></td>
						<td><?php echo $row['quantity1']; ?></td>
					</tr> 
					<?php } ?>	
				</table>
			</div>
				</div>
			</div>
			
			<div>
				<a href="top5seeds.php" class="btn btn-success btn-sm text-decoration-none">Create Yearly Harvested/Wasted Report</a>
				<a href="performanceuser.php" class="btn btn-success btn-sm text-decoration-none">Create Performance Report</a>
				
				<a href="generate-report.php" class="btn btn-secondary btn-sm" type="button"><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Re-send Alert Emails</a>
				
					<?php mysqli_close($con);?>
		</div>
		</div>
		
		
		<!-- Option 1: Bootstrap Bundle with Popper -->
    	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
			integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
			crossorigin="anonymous"></script>
	</body>
</html>