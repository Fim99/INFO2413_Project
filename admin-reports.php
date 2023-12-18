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
		<title>Admin Reports</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h2 style="color:white">Dynamic Seed Database</h2>
				<a href="home.php">Home</a>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="seed-page.php"> Seed Details</a>
				<?php
				if ($isAdmin == 'yes') {
				echo '<a href="users.php"><i class="fas fa-users"></i>Users</a>',
					 '<a href="seed-database.php">Database</a>';
				}
				if ($isAdmin == 'yes' || $user_type == 'Employee'){
				echo '<a href="notification.php">Notification</a>';
				}
				?>
				<a href="inventory.php">Inventory</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
				
			</div>
		</nav>
		<div class="content">
			<h2>Admin Reports</h2>
			
			<div>
				<p>Top 5 Seeds Harvested:</p>
				<table>
					<tr>
						<th>Seed ID</th>
						<th>Seed Name</th>
						<th>Amount Harvested</th>	
					</tr>
					<?php
					$query = mysqli_query($con, "SELECT * FROM top_5_harvested ORDER BY amount_seed_harvest DESC LIMIT 5");
					while($row = mysqli_fetch_assoc($query)){ ?>
					<tr>
						<td><?php echo $row['harvested_id_seed']; ?></td>
						<td><?php echo $row['harvested_name_seed']; ?></td>
						<td><?php echo $row['amount_seed_harvest']; ?></td>
					</tr> 
					<?php } ?>	
				</table>
			</div>
			
			<div>
				<p>Top 5 Seeds Wasted:</p>
				<table>
					<tr>
						<th>Seed ID</th>
						<th>Seed Name</th>
						<th>Amount Wasted</th>	
					</tr>
					<?php
					$query = mysqli_query($con, "SELECT * FROM top_5_wasted ORDER BY amount_seed_wasted DESC LIMIT 5");
					while($row = mysqli_fetch_assoc($query)){ ?>
					<tr>
						<td><?php echo $row['wasted_id_seed']; ?></td>
						<td><?php echo $row['wasted_name_seed']; ?></td>
						<td><?php echo $row['amount_seed_wasted']; ?></td>
					</tr> 
					<?php } ?>	
				</table>
			</div>
			
			<div>
				<p>Gardener Performance Rankings:</p>
				<table>
					<tr>
						<th>User ID</th>
						<th>Name</th>
						<th>Seeds Harvested</th>	
					</tr>
					<?php
					$query = mysqli_query($con, "SELECT * FROM top_5_gardeners ORDER BY seed_harvest DESC");
					while($row = mysqli_fetch_assoc($query)){ ?>
					<tr>
						<td><?php echo $row['user_id']; ?></td>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['seed_harvest']; ?></td>
					</tr> 
					<?php } ?>	
				</table>
			</div>
			
		</div>
	</body>
</html>