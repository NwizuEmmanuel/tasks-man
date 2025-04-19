<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <form action="" method="post">
        <input type="email" name="email" id="email" placeholder="Email" required>
        <br>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <br>
        <button type="submit" name="submit">Login</button>
    </form>
    <a href="register.php">I am new here. Register here.</a>
    <span> | </span>
    <a href="admin/admin_login.php">Login as admin.</a>
</body>
</html>

<?php
session_start();
require_once "./AuthenticateUser.php";

if (isset($_POST['submit'])){
    $auth = new AuthenticateUser();
    $auth->__set("email",$_POST["email"]);
    $auth->__set("password", $_POST["password"]);
    $auth->verifyUser();
}
?>