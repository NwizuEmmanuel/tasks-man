<?php
include_once("../config.php");
if ($_SERVER['REQUEST_METHOD'] === "POST"){
    $id = mysqli_real_escape_string($mysqli, $_POST['id']);

    $result = mysqli_query($mysqli, "DELETE FROM tasks WHERE id = '$id'");
    echo "<script>alert('Task was deleted.')</script>";
    header("location: ../index.php");
    exit();
}
else {
    echo "<script>alert('Task was not deleted.')</script>";
    header("location: ../index.php");
    exit();
}