<?php
include_once("../config.php");
include_once __DIR__ . "/../TaskModel.php";
if ($_SERVER['REQUEST_METHOD'] === "POST"){
    $task = new TaskModel();
    $task->deleteTask($_POST['id']);

    echo "<script>alert('Task was deleted.')</script>";
    header("location: ../index.php");
    exit();
}
else {
    echo "<script>alert('Task was not deleted.')</script>";
    header("location: ../index.php");
    exit();
}