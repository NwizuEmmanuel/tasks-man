<?php
session_start();
include_once("../config.php");
if (isset($_POST['submit'])){
    $email = mysqli_real_escape_string($mysqli,$_POST['email']);
    $password = mysqli_real_escape_string($mysqli,$_POST['password']);

    $query = mysqli_query($mysqli, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($query) == 1){
        $fetch = mysqli_fetch_array($query);
        if (password_verify($password, $fetch['password'])){
            $_SESSION['firstname'] = $fetch['firstname'];
            $_SESSION['id'] = $fetch['id'];
            header("location: ../index.php");
            exit();
        }else{
            echo "<script>alert('incorrect password.')</script>";
        }
    }else{
        echo "<script>alert('user not found.')</script>";
    }
}
?>