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
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Create Notification</title>
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
			<div class="content">
				<div>
					<?php	
					// set conditional based on day of the monnth
					if (date("d") == 5) {
						echo "<p>" . "<b><u>Report Summary</u></b>" . "</p>";
	
						// Get seeds from DB and add to $result
						$sql = "SELECT * FROM seed_inventory WHERE quantity<=1000;";
						$result = mysqli_query($con, $sql);
						$resultCheck = mysqli_num_rows($result);
						
						// check that $result is not empty
						if ($resultCheck > 0) {
							
							// loop through $result and add to $msg
							while ($row = mysqli_fetch_assoc($result)){
								$msg .= $row['seed_id'] . ' ' . $row['seed_name'] . ' ' . $row['quantity'] . '<br>';
								
							}	
						}
						echo $msg; 
						// echo $emails; <===used for testing to confirm output
				  	
					// if not report day, then print this message
					} else {
						echo "No report to run";
					}
				
					?>
					</div>
				
					<div>
						<table class="table">
						<thead>
						<tr>
							<th scope="col">Full Name</th>
							<th scope="col">Username</th>
							<th scope="col">ID</th>
							<th scope="col">Email</th>

						</tr>
						</thead>
						<?php
						$query = mysqli_query($con, "SELECT * FROM user WHERE user_type='Gardener'");
						while($row = mysqli_fetch_assoc($query)){ ?>
						<tr>
							<td><?php echo $row['full_name']; ?></td>
							<td><?php echo $row['username']; ?></td>
							<td><?php echo $row['id']; ?></td>
							<td><?php echo $row['email_address']; ?></td>					
						</tr> 
						<?php } ?>	
						</table>
					</div>
				
				</div>
			</div>
			<div class="container d-flex justify-content-center"> 			
			  <form method="post" action="notification-insert.php">
				 
		
				  <div class="mb-3">
				  <input type="text" id="transaction_id" name="transaction_id" placeholder="transaction id" value="<?php echo $row['transaction_id'];?>">
				  <input type="text" id="full_name" name="full_name" placeholder="Full Name" value="<?php echo $row['full_name'];?>">
				  <input type="text" min="1" username="username" name="username" placeholder="Username" value="<?php echo $row['username'];?>">
				  <input type="number" min="1" id="id" name="id" placeholder="ID" value="<?php echo $row['id'];?>" style="width:5%">
				  <input type="text" id="email_address" name="email_address" placeholder="Email Address" value="<?php echo $row['email_address'];?>"> 
				  </div>
					
				  <div class="col-md-12 row">
					  <div class="col-4">
					  <input class="form-control" type="text" id="seed_name" name="seed_name" placeholder="Seed Name" value="<?php echo $row['seed_name'];?>">
					  </div>
					  <div class="col-4">
					  <input class="form-control" type="number" min="0" id="seed_id" name="seed_id" placeholder="Seed ID" value="">
					  </div>
					  <div class="col-2">
					  <input class="form-control" type="number" id="quantity" name="quantity" placeholder="QTY" min="0" max="5000" step="10" value=""> 
					  </div>
				  </div>
	
				<div class="row">
					
				  <div class="col-md-4">
				  <label class="form-label">Date Assigned</label><br>
				  <input class="form-control" type="date" id="date_assigned" name="date_assigned" value="">	
				  </div>

				  <div class="col-md-4">
				  <label class="form-label">Date Completed</label><br>
				  <input class="form-control" type="date" id="date_completed" name="date_completed" value="">	
				  </div>	
			    </div>
	
				  <div class="col-md-4">
				  <label class="form-label">Planting Complete?</label><br>
				  <select class="form-select" id="isCompleted" name="isCompleted">
					<option value="no">No</option>   
					<option value="yes">Yes</option>
				  </select>
				  </div>		  

				  <div class="col-md-4">
				  <label class="form-label">Additional Information</label><br>
				  <textarea class="form-control" name="message" rows="5" cols="50">
				  </textarea>
				  </div>

				 <p class="mt-2">
					 <input class="btn btn-success btn-sm" name="submit" type="submit" value="Submit" />
					 <a href="notification.php?id=<?php echo $row["id"]; ?>" class="btn btn-secondary btn-sm text-decoration-none">Back</a>
				  </p>
			 </form>
			
		

</div>
		
		<!-- Option 1: Bootstrap Bundle with Popper -->
    	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
			integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
			crossorigin="anonymous"></script>
	</body>
</html>