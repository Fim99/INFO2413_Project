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
<html style="font-size: 16px;">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Product 1 Title, Product 1 Title">
    <meta name="description" content="">
    <meta name="page_type" content="np-template-header-footer-from-plugin">
	<meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Product - Details">
    <meta property="og:type" content="website">
	  
    <title>Product - Details</title>
	  
    <link rel="stylesheet" href="nicepage.css" media="screen">
	<link rel="stylesheet" href="Product---Details.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 4.7.1, nicepage.com">
    <link id="u-theme-google-font" 
		  rel="stylesheet" 
		  href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
	
	  <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
	rel="stylesheet" 
	integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
	crossorigin="anonymous">
	  
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	  

  </head>
  <body class="u-body u-xl-mode loggedin">
	 		  
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
		
    <section class="u-clearfix u-section-1" id="sec-8364">
      <div class="u-clearfix u-sheet u-sheet-1"><!--product--><!--product_options_json--><!--{"source":"Corn"}--><!--/product_options_json--><!--product_item-->
        <div class="u-container-style u-expanded-width u-product u-white u-product-1">
          <div class="u-container-layout u-container-layout-1">
            <div class="u-container-style u-grey-10 u-group u-shape-rectangle u-group-1">
              <div class="u-container-layout u-container-layout-2">
                <div class="u-container-style u-group u-group-2">
                  <div class="u-container-layout">
<?php

$seed = $_POST['seedpass'];

$image = $_POST['imagepath'];

$sql = "SELECT * FROM Seeds WHERE seed_id = '$seed' ";
$result = $con->query($sql);

if ($result->num_rows > 0) 
{
  // output data of each row
  while($row = $result->fetch_assoc()) 
  {
	  ?>
					  
	  <p> <b>Name:</b> <?php echo $row['SeedName']; ?></p>
	  <p> <b>Category:</b> <?php echo $row['SeedCategory']; ?></p>
	  <p> <b>Seed ID:</b> <?php echo $row['seed_id']; ?></p>
	  <p> <b>Planting Time:</b> <?php echo $row['PlantingTime']; ?></p>
	  <p> <b>Growth Time:</b> <?php echo $row['GrowthTime']; ?></p>
	  <p> <b>Seed Harvest:</b> <?php echo $row['SeedHarvest']; ?></p>
	  <p> <b>Expire Date:</b> <?php echo $row['ExpireDate']; ?></p>
	  <p> <b>Purchase Date:</b> <?php echo $row['PurchaseDate']; ?></p>
	  <p> <b>Quantity:</b> <?php echo $row['quantity1']; ?></p>
	  
	  <?php
  }
} else {
  echo "0 results";
}
$con->close();
?>
                  </div>
                </div>
              </div>
            </div><!--product_image-->
            <img  class="u-image u-image-default u-product-control u-image-1" data-image-width="1280" data-image-height="853" src=" <?php echo $image ?> "><!--/product_image--><!--product_button--><!--options_json--><!--{"clickType":"add-to-cart","content":"Order"}--><!--/options_json-->
          </div>
        </div><!--/product_item--><!--/product-->
      </div>
    </section>
 
	  
		<!-- Option 1: Bootstrap Bundle with Popper -->
    	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
			integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
			crossorigin="anonymous"></script>
  </body>
