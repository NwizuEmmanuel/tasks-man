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
</body>
</html>

<?php
session_start();
include_once("config.php");
if (isset($_POST['submit'])){
    $email = mysqli_real_escape_string($mysqli,$_POST['email']);
    $password = mysqli_real_escape_string($mysqli,$_POST['password']);

    $query = mysqli_query($mysqli, "SELECT * FROM users WHERE email='$email' AND role='user'");
    if (mysqli_num_rows($query) == 1){
        $fetch = mysqli_fetch_array($query);
        if (password_verify($password, $fetch['password'])){
            $_SESSION['firstname'] = $fetch['firstname'];
            $_SESSION['id'] = $fetch['id'];
            $_SESSION['role'] = $fetch['role'];
            header("location: index.php");
            exit();
        }else{
            echo "<script>alert('incorrect password.')</script>";
        }
    }else{
        echo "<script>alert('user not found.')</script>";
    }
}
?>