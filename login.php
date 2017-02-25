<?php
session_start();
if(isset($_COOKIE['user_id'])) {
  header("Location: index.php");
}
require __DIR__ . "/libs/db.php";
$db = new Db();

if(isset($_POST['register_submit'])) {
  if($db->checkRow(array('username' => $_POST['username']), 'users')) {
    $error = true;
    $errorMsg = "Username already exists. Please try again.";
  }

  if($_POST['password'] != $_POST['password_conf']) {
    $error = true;
    $errorMsg = "Passwords do not match.";
  }

  if(!isset($error)) {
    $db->insert(array('username' => $_POST['username'], 'password' => md5($_POST['password'])), 'users');
    setcookie('user_id', $db->lastId(), time()+(3600*24));
    header("Location: index.php");
  }
}

if(isset($_POST['login_submit'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']);

  if(!$db->checkRow(array('username' => $username, 'password' => $password), 'users')) {
    $error = true;
    $errorMsg = "Username/Password combination does not exist.";
  }

  else {
    setcookie('user_id', $db->getValue('id', 'users', array('username' => $username)), time()+(3600*24));
    header("Location: index.php");
  }
}
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

<h1 class='page-title'>
  Online Shop
</h1>

<div class='login login-register-box'>
  <h1>Login</h1>
  <?php if(isset($_POST['login_submit']) && isset($errorMsg)) echo "<h2>{$errorMsg}</h2>"; ?>

  <form action='' method='post'>
    <input type='text' name='username' placeholder='Username' />
    <input type='password' placeholder='Password' name='password' />
    <input type='submit' value='Login' name='login_submit' />
  </form>
</div>

<div class='register login-register-box'>
  <h1>Register</h1>
  <?php if(isset($_POST['register_submit']) && isset($errorMsg)) echo "<h2>{$errorMsg}</h2>"; ?>
  <form action='' method='post'>
    <input type='text' name='username' placeholder='Username' />
    <input type='password' placeholder='Password' name='password' />
    <input type='password' placeholder='Password Confirmation' name='password_conf' />
    <input type='submit' value='Register' name='register_submit' />
  </form>
</div>
