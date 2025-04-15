<?php
session_start();
include_once("../config.php");

if ($_SERVER['REQUEST_METHOD'] === "POST"){
    $task = mysqli_real_escape_string($mysqli, $_POST['task']);
    $status = mysqli_real_escape_string($mysqli, $_POST['status']);
    $duedate = mysqli_real_escape_string($mysqli, $_POST['duedate']);
    $user_id = mysqli_real_escape_string($mysqli,$_SESSION['id']);

    $result = mysqli_query($mysqli, "INSERT INTO tasks(task, status, duedate, user_id) VALUES ('$task', '$status','$duedate','$user_id')");
    echo "<script>alert('Task was added.')</script>";
    header("location: ../index.php");
    exit();
}