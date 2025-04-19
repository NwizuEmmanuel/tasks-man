<?php
// Include database connection file
require_once __DIR__ . "/../TaskModel.php";

// Check if the ID is set in the request
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $task = new TaskModel();
    $task->deleteTask($id);
    echo "<script>alert('Task was deleted.')</script>";
    header("location: admin_page.php");
    exit();
}
?>