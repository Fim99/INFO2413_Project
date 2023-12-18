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
    <title>Seed Page</title>
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="nicepage.css" media="screen">
	<link rel="stylesheet" href="Home---Gardener.css" media="screen">
	  
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
	rel="stylesheet" 
	integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
	crossorigin="anonymous">
	  
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Home - Gardener">
    <meta property="og:type" content="website">
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

    <section class="u-clearfix u-section-1" id="sec-2c68">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-expanded-width u-list u-list-1">
          <div class="u-repeater u-repeater-1">
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-1">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-1"></div>
                <img src="images/EnglishLong11.png" alt="" class="u-image u-image-default u-image-1" data-image-width="240" data-image-height="240" data-href="https://nicepage.com">
                <h6 class="u-text u-text-1">
                  <span style="font-weight: 700;font-size: 24px"> English
Long</span>
                  <br>
                </h6>
                <h4 class="u-text u-text-2">
                  <span style="font-weight: 400;">Cucumber</span>
                  <br>
                </h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/EnglishLong11.png" /><br />
    <input type="hidden" name="seedpass" value="101229" /><br />
	</form>
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-2">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-2"></div>
                <img src="images/AnnualBunching11.jpg" alt="" class="u-image u-image-default u-image-2" data-image-width="180" data-image-height="180" data-href="https://nicepage.com">
                <h6 class="u-text u-text-3"> Annual
Bunching</h6>
                <h4 class="u-text u-text-4">Onion</h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/AnnualBunching11.jpg" /><br />
    <input type="hidden" name="seedpass" value="140136" /><br />
	</form>
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-3">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-3"></div>
                <img src="images/DarkGreen11.jpg" alt="" class="u-image u-image-default u-image-3" data-image-width="180" data-image-height="180" data-href="https://nicepage.com">
                <h6 class="u-text u-text-5"> Dark
Green</h6>
                <h4 class="u-text u-text-6">Zucchini</h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/DarkGreen11.jpg" /><br />
    <input type="hidden" name="seedpass" value="140174" /><br />
	</form>
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-4">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-4"></div>
                <img src="images/Romaine11.jpg" alt="" class="u-image u-image-default u-image-4" data-image-width="180" data-image-height="180" data-href="https://nicepage.com">
                <h6 class="u-text u-text-7"> Romaine</h6>
                <h4 class="u-text u-text-8">Lettuce</h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/Romaine11.jpg" /><br />
    <input type="hidden" name="seedpass" value="140124" /><br />
	</form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="u-clearfix u-section-2" id="sec-a507">
      <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <div class="u-expanded-width u-list u-list-1">
          <div class="u-repeater u-repeater-1">
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-1">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-1"></div>
                <img src="images/Butternut11.jpg" alt="" class="u-image u-image-default u-image-1" data-image-width="180" data-image-height="180">
                <h6 class="u-text u-text-1"> Butternut<br>
                </h6>
                <h4 class="u-text u-text-2">Squash<br>
                </h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/Butternut11.jpg" /><br />
    <input type="hidden" name="seedpass" value="101624" /><br />
	</form>
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-2">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-2"></div>
                <img src="images/DetroitDarkRed11.jpg" alt="" class="u-image u-image-default u-image-2" data-image-width="180" data-image-height="180">
                <h6 class="u-text u-text-3"> Detroit
Dark Red</h6>
                <h4 class="u-text u-text-4">Beet</h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/DetroitDarkRed11.jpg" /><br />
    <input type="hidden" name="seedpass" value="101064" /><br />
	</form>
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-3">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-3"></div>
                <img src="images/EarlyCopenhagenMarket11.jpg" alt="" class="u-image u-image-default u-image-3" data-image-width="180" data-image-height="180">
                <h6 class="u-text u-text-5"> Early
Copenhagen Market</h6>
                <h4 class="u-text u-text-6">Cabbage</h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/EarlyCopenhagenMarket11.jpg" /><br />
    <input type="hidden" name="seedpass" value="132404" /><br />
	</form>
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-4">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-4"></div>
                <img src="images/ScarletNantes11.jpg" alt="" class="u-image u-image-default u-image-4" data-image-width="180" data-image-height="180">
                <h6 class="u-text u-text-7"> Scarlet
Nantes</h6>
                <h4 class="u-text u-text-8">Carrot</h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/ScarletNantes11.jpg" /><br />
    <input type="hidden" name="seedpass" value="139826" /><br />
	</form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="u-clearfix u-section-3" id="sec-4146">
      <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <div class="u-expanded-width u-list u-list-1">
          <div class="u-repeater u-repeater-1">
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-1">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-1"></div>
                <img src="images/MonstrousCarentan11.jpg" alt="" class="u-image u-image-default u-image-1" data-image-width="180" data-image-height="180">
                <h6 class="u-text u-text-1"> Monstrous
Carentan<br>
                </h6>
                <h4 class="u-text u-text-2">Leek<br>
                </h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/MonstrousCarentan11.jpg" /><br />
    <input type="hidden" name="seedpass" value="101375" /><br />
	</form>
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-2">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-2"></div>
                <img src="images/ImprovedGoldenWaxBush11.jpg" alt="" class="u-image u-image-default u-image-2" data-image-width="180" data-image-height="180">
                <h6 class="u-text u-text-3"> Improved
Golden Wax Bush</h6>
                <h4 class="u-text u-text-4">Bean</h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/ImprovedGoldenWaxBush11.jpg" /><br />
    <input type="hidden" name="seedpass" value="101008" /><br />
	</form>
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-3">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-3"></div>
                <img src="images/GoldRush11.jpg" alt="" class="u-image u-image-default u-image-3" data-image-width="180" data-image-height="180">
                <h6 class="u-text u-text-5"> Gold
Rush</h6>
                <h4 class="u-text u-text-6">Zucchini</h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/GoldRush11.jpg" /><br />
    <input type="hidden" name="seedpass" value="132401" /><br />
	</form>
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-4">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-4"></div>
                <img src="images/EliteHybrid11.png" alt="" class="u-image u-image-default u-image-4" data-image-width="240" data-image-height="240">
                <h6 class="u-text u-text-7"> Elite
Hybrid</h6>
                <h4 class="u-text u-text-8">Zucchini</h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/EliteHybrid11.png" /><br />
    <input type="hidden" name="seedpass" value="137817" /><br />
	</form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="u-clearfix u-section-4" id="sec-0225">
      <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <div class="u-expanded-width u-list u-list-1">
          <div class="u-repeater u-repeater-1">
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-1">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-1"></div>
                <img src="images/GreencropBush11.jpg" alt="" class="u-image u-image-default u-image-1" data-image-width="180" data-image-height="180">
                <h6 class="u-text u-text-1"> Green
crop Bush<br>
                </h6>
                <h4 class="u-text u-text-2">Bean</h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/GreencropBush11.jpg" /><br />
    <input type="hidden" name="seedpass" value="140097" /><br />
	</form>
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-2">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-2"></div>
                <img src="images/BeefSteakBush11.jpg" alt="" class="u-image u-image-default u-image-2" data-image-width="180" data-image-height="180">
                <h6 class="u-text u-text-3"> Beef
Steak Bush</h6>
                <h4 class="u-text u-text-4">Tomatoe</h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/BeefSteakBush11.jpg" /><br />
    <input type="hidden" name="seedpass" value="140163" /><br />
	</form>
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-3">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-3"></div>
                <img src="images/RainbowMix11.jpg" alt="" class="u-image u-image-default u-image-3" data-image-width="180" data-image-height="180">
                <h6 class="u-text u-text-5"> Rainbow
Mix</h6>
                <h4 class="u-text u-text-6">Carrot</h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/RainbowMix11.jpg" /><br />
    <input type="hidden" name="seedpass" value="141459" /><br />
	</form>
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-4">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-4"></div>
                <img src="images/VegetableSpaghettiPasta11.jpg" alt="" class="u-image u-image-default u-image-4" data-image-width="180" data-image-height="180">
                <h6 class="u-text u-text-7"> Vegetable
Spaghetti Pasta</h6>
                <h4 class="u-text u-text-8">Squash</h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/VegetableSpaghettiPasta11.jpg" /><br />
    <input type="hidden" name="seedpass" value="140147" /><br />
	</form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="u-clearfix u-section-5" id="sec-5ca8">
      <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <div class="u-expanded-width u-list u-list-1">
          <div class="u-repeater u-repeater-1">
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-1">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-1"></div>
                <img src="images/Iceberg11.jpg" alt="" class="u-image u-image-default u-image-1" data-image-width="180" data-image-height="180">
                <h6 class="u-text u-text-1"> Iceberg&nbsp;&nbsp;<br>
                </h6>
                <h4 class="u-text u-text-2">Lettuce<br>
                </h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/Iceberg11.jpg" /><br />
    <input type="hidden" name="seedpass" value="101419" /><br />
	</form>
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-2">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-2"></div>
                <img src="images/BellColor11.jpg" alt="" class="u-image u-image-default u-image-2" data-image-width="180" data-image-height="180">
                <h6 class="u-text u-text-3"> Bell
Color</h6>
                <h4 class="u-text u-text-4">Pepper</h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/BellColor11.jpg" /><br />
    <input type="hidden" name="seedpass" value="141482" /><br />
	</form>
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-3">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-3"></div>
                <img src="images/SanMarzano11.jpg" alt="" class="u-image u-image-default u-image-3" data-image-width="750" data-image-height="750">
                <h6 class="u-text u-text-5"> San
Marzano</h6>
                <h4 class="u-text u-text-6">Tomato</h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/SanMarzano11.jpg" /><br />
    <input type="hidden" name="seedpass" value="122343" /><br />
	</form>
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-4">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-4"></div>
                <img src="images/BlackBeauty11.jpg" alt="" class="u-image u-image-default u-image-4" data-image-width="180" data-image-height="180">
                <h6 class="u-text u-text-7"> Black
Beauty</h6>
                <h4 class="u-text u-text-8">Zucchini</h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/BlackBeauty11.jpg" /><br />
    <input type="hidden" name="seedpass" value="139773" /><br />
	</form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="u-clearfix u-section-6" id="sec-fb2e">
      <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <div class="u-expanded-width u-list u-list-1">
          <div class="u-repeater u-repeater-1">
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-1">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-1"></div>
                <img src="images/Sweetie11.jpg" alt="" class="u-image u-image-default u-image-1" data-image-width="180" data-image-height="180">
                <h6 class="u-text u-text-1"> Sweetie<br>
                </h6>
                <h4 class="u-text u-text-2">Tomato<br>
                </h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/Sweetie11.jpg" /><br />
    <input type="hidden" name="seedpass" value="139776" /><br />
	</form>
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-2">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-2"></div>
                <img src="images/ItalianSaladBlend11.jpg" alt="" class="u-image u-image-default u-image-2" data-image-width="180" data-image-height="180">
                <h6 class="u-text u-text-3"> Italian
Salad Blend</h6>
                <h4 class="u-text u-text-4">Lettuce</h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/ItalianSaladBlend11.jpg" /><br />
    <input type="hidden" name="seedpass" value="137829" /><br />
	</form>
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-3">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-3"></div>
                <img src="images/EarlySnowball11.jpg" alt="" class="u-image u-image-default u-image-3" data-image-width="180" data-image-height="180">
                <h6 class="u-text u-text-5"> Early
Snowball</h6>
                <h4 class="u-text u-text-6">Cauliflower</h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/EarlySnowball11.jpg" /><br />
    <input type="hidden" name="seedpass" value="101154" /><br />
	</form>
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-4">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-4"></div>
                <img src="images/Catskill11.jpg" alt="" class="u-image u-image-default u-image-4" data-image-width="180" data-image-height="180">
                <h6 class="u-text u-text-7"> Catskill</h6>
                <h4 class="u-text u-text-8">Brussel Sprouts</h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/Catskill11.jpg" /><br />
    <input type="hidden" name="seedpass" value="137147" /><br />
	</form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="u-clearfix u-section-7" id="sec-36cb">
      <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <div class="u-expanded-width u-list u-list-1">
          <div class="u-repeater u-repeater-1">
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-1">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-1"></div>
                <img src="images/NationalPickling11.jpg" alt="" class="u-image u-image-default u-image-1" data-image-width="180" data-image-height="180">
                <h6 class="u-text u-text-1"> National
Pickling<br>
                </h6>
                <h4 class="u-text u-text-2">Cucumber<br>
                </h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/NationalPickling11.jpg" /><br />
    <input type="hidden" name="seedpass" value="140118" /><br />
	</form>
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-2">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-2"></div>
                <img src="images/PeachesandCream11.jpg" alt="" class="u-image u-image-default u-image-2" data-image-width="180" data-image-height="180">
                <h6 class="u-text u-text-3"> Peaches
and Cream</h6>
                <h4 class="u-text u-text-4">Corn</h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/PeachesandCream11.jpg" /><br />
    <input type="hidden" name="seedpass" value="139339" /><br />
	</form>
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-3">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-3"></div>
                <img src="images/GreenCurled11.jpg" alt="" class="u-image u-image-default u-image-3" data-image-width="180" data-image-height="180">
                <h6 class="u-text u-text-5"> Green
Curled</h6>
                <h4 class="u-text u-text-6">Kale</h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/GreenCurled11.jpg" /><br />
    <input type="hidden" name="seedpass" value="101083" /><br />
	</form>
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-4">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-4"></div>
                <img src="images/NantesTouchon11.jpg" alt="" class="u-image u-image-default u-image-4" data-image-width="180" data-image-height="180">
                <h6 class="u-text u-text-7"> Nantes
Touchon</h6>
                <h4 class="u-text u-text-8">Carrot</h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/NantesTouchon11.jpg" /><br />
    <input type="hidden" name="seedpass" value="101146" /><br />
	</form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="u-clearfix u-section-8" id="sec-feb7">
      <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <div class="u-expanded-width u-list u-list-1">
          <div class="u-repeater u-repeater-1">
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-1">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-1"></div>
                <img src="images/Buttercrunch11.jpg" alt="" class="u-image u-image-default u-image-1" data-image-width="180" data-image-height="180">
                <h6 class="u-text u-text-1"> Buttercrunch<br>
                </h6>
                <h4 class="u-text u-text-2">Lettuce</h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/Buttercrunch11.jpg" /><br />
    <input type="hidden" name="seedpass" value="141478" /><br />
	</form>
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-2">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-2"></div>
                <img src="images/DeCicco11.jpg" alt="" class="u-image u-image-default u-image-2" data-image-width="180" data-image-height="180">
                <h6 class="u-text u-text-3"> De
Cicco</h6>
                <h4 class="u-text u-text-4">Broccoli</h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/DeCicco11.jpg" /><br />
    <input type="hidden" name="seedpass" value="137822" /><br />
	</form>
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-3">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-3"></div>
                <img src="images/CaliforniaWonder11.jpg" alt="" class="u-image u-image-default u-image-3" data-image-width="180" data-image-height="180">
                <h6 class="u-text u-text-5"> California
Wonder</h6>
                <h4 class="u-text u-text-6">Pepper</h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/CaliforniaWonder11.jpg" /><br />
    <input type="hidden" name="seedpass" value="139790" /><br />
	</form>
              </div>
            </div>
            <div class="u-align-left u-container-style u-list-item u-repeater-item">
              <div class="u-container-layout u-similar-container u-container-layout-4">
                <div class="u-grey-10 u-shape u-shape-rectangle u-shape-4"></div>
                <img src="images/TendersweetLong11.jpg" alt="" class="u-image u-image-default u-image-4" data-image-width="180" data-image-height="180">
                <h6 class="u-text u-text-7"> Tendersweet
Long</h6>
                <h4 class="u-text u-text-8">Carrot</h4>
    <form action="product-details.php" method="post">
	<input type="submit" value = "Details" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1" />
    <input type="hidden" name="imagepath" value="images/TendersweetLong11.jpg" /><br />
    <input type="hidden" name="seedpass" value="101145" /><br />
	</form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
	  
	  <!-- Option 1: Bootstrap Bundle with Popper -->
    	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
			integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
			crossorigin="anonymous"></script>
  </body>
</html>