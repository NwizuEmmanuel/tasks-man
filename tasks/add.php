<?php
session_start();
include_once "../TaskModel.php";

if ($_SERVER['REQUEST_METHOD'] === "POST"){
    $task = new TaskModel();
    $task->__set("name", $_POST["name"]);
    $task->__set("description", $_POST["description"]);
    $task->__set("status", $_POST["status"]);
    $task->__set("duedate", $_POST["duedate"]);
    $task->__set("user_id", $_SESSION["userid"]);
    $task->addNewTask();

    header("location: ../index.php");
    exit();
}