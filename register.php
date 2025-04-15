<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
include_once("config.php");
if (isset($_POST['submit'])){
    $firstname = mysqli_real_escape_string($mysqli,$_POST['firstname']);
    $lastname = mysqli_real_escape_string($mysqli,$_POST['lastname']);
    $email = mysqli_real_escape_string($mysqli,$_POST['email']);
    $password = mysqli_real_escape_string($mysqli,$_POST['password']);
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    $result = mysqli_query($mysqli, "INSERT INTO users(firstname,lastname,email,password)VALUES('$firstname','$lastname','$email','$password_hashed')");
    echo "<script>alert('Registeration was succeful.')</script>";
    header("location: ../login/login.html");
    exit();
}
