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
				
					<?php
				
						// save any errors to variables
						// these will be display later if msg unable to send
						$err_msg = error_reporting(E_ALL);
						$err_msg2 = ini_set("display_errors", 1);
			
					
					if (date("d") == 4) {
						echo "<b>Low Quantity Report:</b>" . "<br>";
						
						// Get employee email addresses from DB
						$email_sql = "SELECT email_address FROM user WHERE user_type = 'Administrator';";
						$email_result = mysqli_query($con, $email_sql);
						
						// declare variable;
						$email_list = "";
						
						// while loop through $email_result and add to $email_list
						while ($row = mysqli_fetch_assoc($email_result)) {
							$email_list .= $row['email_address'] . ' ';
						}
					
						// Get seeds from DB and add to $result
						$sql_quantity = "SELECT * FROM seeds_inventory WHERE quantity<1000;";
						$result = mysqli_query($con, $sql_quantity);
						$resultCheck = mysqli_num_rows($result);

						// check that $result is not empty
						if ($resultCheck > 0) {
							
							// declare variable;
							$msg = "";
							
							// while loop through $result and add row to $msg
							while ($row = mysqli_fetch_assoc($result)){
								$msg .= $row['seed_id'] . ' ' . $row['seed_name'] . ' | Qty: ' . $row['quantity'] . '<br>';
								
							}	

								
							// send emails too
							$to      = ".$email_list.";

							// email subject line
							$subject = 'Monthly Report';
						
							// wrap text of $msg longer than 70 char
							$message = wordwrap($msg, 70, "\r\n");
							echo $message;
							// email headers and formatting 
							$headers = 'From: webmaster@example.com'       . "\r\n" .
										'Reply-To: webmaster@example.com' . "\r\n" .
										'Content-type: text/html; charset=iso-8859-1' .
									 	'X-Mailer: PHP/' . phpversion();
	       
							// error check if email success or unsuccessful
							
							if (mail($to, $subject, $message, $headers))
							{
								echo "<br> The report has been generated sucessfully" . "<br>";
							}
							else
							{
								// if message cannot be sent display error message and error descriptions
								echo "<br> <b>Error: Message not sent to a user</b> <br>";
								echo $err_msg;
								echo $err_msg2;
								
							}
				
						}
						// echo $msg; <===used for testing to confirm output
						// echo $emails; <===used for testing to confirm output
				  	
					// if not report day, then print this message
					} else {
						echo "No report to run";
					}			
				
					?>
				
				
				<?php 
				// Get seeds from DB and add to $result
				$sql_expiry = "SELECT * FROM Seeds WHERE years<=1;";
				$result = mysqli_query($con, $sql_expiry);
				$resultCheckExpiry = mysqli_num_rows($result);


				// check that $result is not empty
				if ($resultCheckExpiry > 0) {
							
						// Get employee email addresses from DB
						$email_sql = "SELECT email_address FROM user WHERE user_type = 'Administrator';";
						$email_result = mysqli_query($con, $email_sql);
						
						// declare variable;
						$email_list = "";
						
						// while loop through $email_result and add to $email_list
						while ($row = mysqli_fetch_assoc($email_result)) {
							$email_list .= $row['email_address'] . ' ';
						}
					
					// declare variable;
					$msg = "";
							
					// while loop through $result and add row to $msg
					while ($row = mysqli_fetch_assoc($result)){
						$msg .= $row['seed_id'] . ' ' . $row['SeedName1'] . ' ' . $row['ExpireDate']. ' | Qty: ' . $row['quantity1'] . '<br>';
							
						}	

						// send emails too
						$to = "' $email_list '";
						
						// email subject line
						$subject = 'ALERT: Seed Expiry Date';
						
						// wrap text of $msg longer than 70 char
						$message = wordwrap($msg, 70, "\r\n");
					
						// email headers and formatting 
						$headers = 'From: webmaster@example.com'       . "\r\n" .
									'Reply-To: webmaster@example.com' . "\r\n" .
									'Content-type: text/html; charset=iso-8859-1' .
								 	'X-Mailer: PHP/' . phpversion();
	      
						// error check if email success or unsuccessful
							
						if (mail($to, $subject, $message, $headers))
						{
							echo "<br> The report has been generated sucessfully" . "<br>";
						}
						else
						{
							// if message cannot be sent display error message and error descriptions
							// echo "<br> <b>Error: Message not sent to a user</b> <br>";
							// echo $err_msg;
							// echo $err_msg2;
								
						}
				
					}
	
				?>
				
				<?php
				// Check if Quantity is less than 500.
				// Send email alert if less than 500
				$status = "";
				if ('quantity' < '500') {

					// send emails too
					$to = "john.munialo@email.kpu.ca";

					// email subject line
					$subject = 'ALERT: Low Quantity';

					// wrap text of $msg longer than 70 char
					$message = "<b>Seed Number:</b> " . $seed_number ;

					// email headers and formatting 
					$headers = 'From: webmaster@example.com'       . "\r\n" .
								'Reply-To: webmaster@example.com' . "\r\n" .
								'Content-type: text/html; charset=iso-8859-1' .
								'X-Mailer: PHP/' . phpversion();

					// error check if email success or unsuccessful
						if (mail($to, $subject, $message, $headers)) {		
									$status = "Alert Email Sent";
									//echo '<p style="color:#FF0000;">'.$status.'</p>';
								} else {		 
									$status = "There was an Error. Email not sent.";
									//echo '<p style="color:#FF0000;">'.$status.'</p>';	
								 }				
				}
				?>
				
				
			</div>
					<?php mysqli_close($con);?>
		</div>
		
		
		<!-- Option 1: Bootstrap Bundle with Popper -->
    	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
			integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
			crossorigin="anonymous"></script>
	</body>
</html>