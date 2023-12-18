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

// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT * FROM user user_transactions');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id_user']);
$stmt->execute();
$stmt->bind_result($id_user);
$stmt->fetch();
$stmt->close();





?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>View</title>
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
		
		
		<div class="mt-3">
			<div class="container">
				<h2><?php echo $full_name ?>'s Notifications</h2>
				<p>Update once completed:</p>
				
					<?php	
					// set conditional based on day of the monnth
	
						// Get seeds from DB and add to $result
						$sql = "SELECT * FROM user_transactions;";
						$result = mysqli_query($con, $sql);
						$resultCheck = mysqli_num_rows($result);
						
						// check that $result is not empty
						if ($resultCheck > 0) {
							
							// loop through $result and add to $msg
							while ($row = mysqli_fetch_assoc($result)){
								
								// only show notifications for current user
								if($id == $row['id_user']){
								echo $row['seed_id'] . ' ' . $row['seed_name'] . ' ' . $row['quantity'] . ' ' . $row['message'] . '<br><br>';
								
								}
								
							}	
						}						
					?>			
					<?php
						$status = "";
						if(isset($_POST['new']) && $_POST['new']==1) {
							$seed_id=$_REQUEST['seed_id'];
							$id_user=$_REQUEST['id_user'];
							$seed_name =$_REQUEST['seed_name'];
							$isCompleted=$_REQUEST['isCompleted'];
							$quantity =$_REQUEST['quantity'];
							$date_completed =$_REQUEST['date_completed'];
							$full_name_transactions=$_REQUEST['full_name_transactions'];
							
							$update = "update user_transactions set isCompleted='".$isCompleted."', date_completed='".$date_completed."', quantity= quantity - '".$quantity."' where seed_id='".$seed_id."' AND id_user = '".$_SESSION['id']."' ";
							mysqli_query($con, $update) or die(mysqli_error());
							$status = "Record Updated Successfully.";
							echo '<p style="color:#FF0000;">'.$status.'</p>';
							/*if ($_SESSION['id'] >= 1 && $_SESSION['id'] <= 10) {
								echo "</br></br> <a href='users.php'>View Updated Record</a>";
							}*/
							}
							?>
							<div class="container">
							<form name="form" method="post" action="" class="row g-3">
							<input type="hidden" name="new" value="1" />
							
							<div class="col-md-4">
							<label for="seed_name" class="form-label">Seed Name:</label><br>
							<p><input type="text" class="form-control" name="seed_name" placeholder="Enter Seed Name" required value="" /></p>
							</div>
								
							<div class="col-md-4">
							<label for="seed_id" class="form-label">Seed ID:</label><br>
							<p><input type="number" class="form-control" name="seed_id"  min="0" placeholder="Seed ID" required value="" /></p>
							</div>
								
							<div class="col-md-4">
							<label for="quantity" class="form-label">Quantity:</label><br>
							<p><input type="number" class="form-control" name="quantity" min="0" placeholder="Enter Quantity" value="" /></p>
							</div>
								
							<div class="col-md-4">
							<label for="date_completed" class="form-label">Date Completed:</label>
							<p><input type="date" class="form-control" id="date_completed" name="date_completed"></p>
							</div>
								
							<div class="col-md-4">
							<label for="isCompleted" class="form-label">Planting Completed?</label><br>
								<p><select id="isCompleted" class="form-select" name="isCompleted">
									<option value="yes">yes</option>
									<option value="no">no</option>
								</select></p>
							</div>
								
							<p><input name="submit" type="submit" class="btn btn-success btn-sm" value="update" />
								<a href="notification.php?id=<?php echo $row["id"]; ?>" class="btn btn-secondary btn-sm text-decoration-none">Back</a>
							</p>					
							</form>				
					
			</div>
		</div>
		
		<!-- Option 1: Bootstrap Bundle with Popper -->
    	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
			integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
			crossorigin="anonymous"></script>
		
	</body>
</html>