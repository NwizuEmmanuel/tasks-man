<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Login</title>
</head>
<body>
    <h1>Admin Login</h1>

    <form action="" method="post">
        <input type="email" name="email" id="email" placeholder="Email" required>
        <br>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <br>
        <button type="submit" name="submit">Login</button>
    </form>
    <a href="admin_register.php">I am new here. Register here.</a>
</body>
</html>

<?php
session_start();

include_once __DIR__ . "/../AuthenticateUser.php";
if (isset($_POST['submit'])){
    $auth = new AuthenticateUser();
    $auth->__set("email",$_POST["email"]);
    $auth->__set("password", $_POST["password"]);
    // Check if the user is an admin
    // If the user is not an admin, redirect to the login page
    // If the user is an admin, redirect to the admin page
    $auth->verifyAdmin();

}
?>