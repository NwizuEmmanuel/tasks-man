<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <form action="" method="post">
        <input type="text" name="firstname" id="firstname" placeholder="Firstname" required>
        <br>
        <input type="text" name="lastname" id="lastname" placeholder="Lastname" required>
        <br>
        <input type="email" name="email" id="email" placeholder="Email" required>
        <br>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <br>
        <button type="submit" name="submit">Register</button>
    </form>
</body>
</html>
<?php
require_once __DIR__ . "/UserModel.php";

if (isset($_POST['submit'])){
    $user = new UserModel();
    $user->__set("firstname", $_POST["firstname"]);
    $user->__set("lastname", $_POST["lastname"]);
    $user->__set("email", $_POST["email"]);
    $user->__set("password", $_POST["password"]);
    $user->addNewUser();
    header("location: login.php");
    exit();
}
