<?php
require("auth.php");
require('db.php');

$id=$_REQUEST['id'];
$query = "DELETE FROM user WHERE id=$id"; 
$result = mysqli_query($con, $query) or die ( mysqli_error());
header('Location: users.php');

$user_id=$_REQUEST['user_id'];
$query = "DELETE FROM top_5_gardeners WHERE user_id=$id"; 
$result = mysqli_query($con, $query) or die ( mysqli_error());
header('Location: users.php');

// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT * FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($username, $password, $email);
$stmt->fetch();
$stmt->close();

// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT * FROM top_5_gardeners');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$stmt->bind_result($user_id, $name, $seed_harvest);
$stmt->fetch();
$stmt->close();
?>