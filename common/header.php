<?php
session_start();

// If the user is not logged in, then redirect him to the login page
if(!isset($_COOKIE['user_id'])) {
  header("Location: login.php");
}
require __DIR__ . "/../libs/db.php";
$db = new Db();
// Fetching the user information using the id stored in the cookie
// Below we are using a library -- and wherever else in the website as well
// For example, the getRow function takes as the first parameter, an array containing the checks to be made
// Below, it checks for a row with id = the id of the user stored in the cookie
// The second parameter is the table, and in this case the table is called "users"
$user = $db->getRow(array('id' => $_COOKIE['user_id']), 'users');
?>

<!DOCTYPE HTML>
<html>
<head>
  <link href='https://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta charset='utf-8'>
  <title>Online Shop</title>
  <link rel='stylesheet' href='public/css/screen.css' />
</head>
<body>

<div class='menu'>
  <ul>
    <li><a href='index.php'>Home</a></li>
    <li><a href='products.php'>Products</a></li>
    <li class='logout'><a href='logout.php'>Logout</a></li>
    <li class='logout'><a href='cart.php'>Cart</a></li>
    <li class='logout'><a href='#'>Welcome, <?php echo $user['username']; ?></a></li>
  </ul>
</div>
