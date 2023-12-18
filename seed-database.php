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

// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT * FROM namesofpicture');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id__seed']);
$stmt->execute();
$stmt->bind_result($id_seed, $picturename);
$stmt->fetch();
$stmt->close();

?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Seed Database</title>
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
				<p>	View seeds in the database: <br>
					<i>A report will be generated on the 1st of every month.</i>			
				</p>
				<input type="text" id="myInput1" onkeyup="myFunction1()" placeholder="Search for Name.." title="Type in a name">
				<input type="text" id="myInput2" onkeyup="myFunction2()" placeholder="Search for Category.." title="Type in a category">
				<input type="text" id="myInput3" onkeyup="myFunction3()" placeholder="Search for Planting Time.." title="Type in a planting time">
				<input type="text" id="myInput4" onkeyup="myFunction4()" placeholder="Search for Expire Date.." title="Type in a expire date">
				<table id="myTable" class="table">
					<thead>
					<tr>
						<th scope="col">MoreInfo</th>
						<th scope="col">ID</th>
						<th scope="col">Seed Name</th>
						<th scope="col">Category</th>
						<th scope="col">Planting time</th>
						<th scope="col">Grow time</th>
						<th scope="col">Harvest date</th>
						<th scope="col">Years</th>
						<th scope="col">Expire date</th>
						<th scope="col">Purchase date</th>
						<th scope="col">QTY</th>
					</tr>
					</thead>
					<tbody>
					<?php
					$query = mysqli_query($con, "SELECT s.*, a.picturename FROM Seeds AS s JOIN namesofpicture AS a ON s.seed_id = a.seed_id order by seed_id");
					while($row = mysqli_fetch_assoc($query)){ ?>
						
						<? $pictuername=$_REQUEST['picturename']; ?>
					<tr>
						<td>
						<form action="product-details.php" method="post">
						<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
   						<input type="hidden" name="imagepath" value="images/<?php echo $row['picturename']; ?>" /><br />
						<input type="hidden" name="seedpass" value="<?php echo $row['seed_id']; ?>" /><br />
						</form>
						</td>
						<td><?php echo $row['seed_id']; ?></td>
						<td><?php echo $row['SeedName']; ?></td>
						<td><?php echo $row['SeedCategory']; ?></td>
						<td><?php echo $row['PlantingTime']; ?></td>
						<td><?php echo $row['GrowthTime']; ?></td>
						<td><?php echo $row['SeedHarvest']; ?></td>
						<td><?php echo $row['years']; ?></td>
						<td><?php echo $row['ExpireDate']; ?></td>
						<td><?php echo $row['PurchaseDate']; ?></td>
						<td><?php echo $row['quantity1']; ?></td>
						
					</tr> 
					<?php } ?>
					</tbody>
				</table>
				
				<script>
				function myFunction1() {
				  var input, filter, table, tr, td, i, txtValue;
				  input = document.getElementById("myInput1");
				  filter = input.value.toUpperCase();
				  table = document.getElementById("myTable");
				  tr = table.getElementsByTagName("tr");
				  for (i = 0; i < tr.length; i++) {
					td = tr[i].getElementsByTagName("td")[2];
					if (td) {
					  txtValue = td.textContent || td.innerText;
					  if (txtValue.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					  } else {
						tr[i].style.display = "none";
					  }
					}       
				  }
				}
				function myFunction2() {
				  var input, filter, table, tr, td, i, txtValue;
				  input = document.getElementById("myInput2");
				  filter = input.value.toUpperCase();
				  table = document.getElementById("myTable");
				  tr = table.getElementsByTagName("tr");
				  for (i = 0; i < tr.length; i++) {
					td = tr[i].getElementsByTagName("td")[3];
					if (td) {
					  txtValue = td.textContent || td.innerText;
					  if (txtValue.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					  } else {
						tr[i].style.display = "none";
					  }
					}       
				  }
				}
				function myFunction3() {
				  var input, filter, table, tr, td, i, txtValue;
				  input = document.getElementById("myInput3");
				  filter = input.value.toUpperCase();
				  table = document.getElementById("myTable");
				  tr = table.getElementsByTagName("tr");
				  for (i = 0; i < tr.length; i++) {
					td = tr[i].getElementsByTagName("td")[4];
					if (td) {
					  txtValue = td.textContent || td.innerText;
					  if (txtValue.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					  } else {
						tr[i].style.display = "none";
					  }
					}       
				  }
				}
				function myFunction4() {
				  var input, filter, table, tr, td, i, txtValue;
				  input = document.getElementById("myInput4");
				  filter = input.value.toUpperCase();
				  table = document.getElementById("myTable");
				  tr = table.getElementsByTagName("tr");
				  for (i = 0; i < tr.length; i++) {
					td = tr[i].getElementsByTagName("td")[8];
					if (td) {
					  txtValue = td.textContent || td.innerText;
					  if (txtValue.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					  } else {
						tr[i].style.display = "none";
					  }
					}       
				  }
				}
				</script>
				
			</div>
		</div>
		
		<!-- Option 1: Bootstrap Bundle with Popper -->
    	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
			integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
			crossorigin="anonymous"></script>
	</body>
</html>