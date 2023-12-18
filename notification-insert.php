<?php
require("auth.php");
require('db.php');

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		
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
	<center>
		<?php

	    // servername => localhost
        // username => root
        // password => empty
        // database name => staff
        $con = mysqli_connect("localhost", "phpmyadmin", "root", "dynamic_seed_management");
          
        // Check connection
        if($con === false){
            die("ERROR: Could not connect. " 
                . mysqli_connect_error());
        }
		
		$transaction_id =$_REQUEST['transaction_id'];
		$id=$_REQUEST['id'];
		$username =$_REQUEST['username'];
		$full_name=$_REQUEST['full_name'];
		$email_address =$_REQUEST['email_address'];
		$seed_name =$_REQUEST['seed_name'];
		$seed_id =$_REQUEST['seed_id'];
		$quantity =$_REQUEST['quantity'];
		$date_assigned =$_REQUEST['date_assigned'];
		$date_completed =$_REQUEST['date_completed'];
		$isCompleted =$_REQUEST['isCompleted'];
		$message =$_REQUEST['message'];
		
		// insert query
		$sql = "INSERT INTO user_transactions VALUES ('$transaction_id','$username','$seed_name', '$seed_id', '$quantity' ,'$date_assigned','$date_completed','$isCompleted','$id', '$full_name', '$message')";
		
		if(mysqli_query($con, $sql)){
			echo "<h3>Your notificaiton for $username has been sent.<h3>";

			echo nl2br("\n$full_name\n $username\n "
				. "$email_address\n $message");
		} else{
			echo "ERROR: Uh Oh! Something went wrong! <br>."
				. mysqli_error($con);
		}
		
		// Close connection
		mysqli_close($con);
		?>
	</center>
</body>

</html>
