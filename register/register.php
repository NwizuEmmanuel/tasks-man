<?php

include_once("../config.php");
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
