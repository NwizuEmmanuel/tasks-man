<?php
include_once __DIR__ . "/../TaskModel.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $task = new TaskModel();
    $task->name = $_POST['name'];
    $task->description = $_POST['description'];
    $task->status = $_POST['status'];
    $task->duedate = $_POST['duedate'];
    $id = (int)$_POST['id'];

    $task->updateTaskById($id);
    echo "<script>alert('Task was updated.')</script>";
    header("location: ../index.php");
    exit();
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Edit Task</title>
</head>

<body>
    <h1>Edit Task</h1>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
        <input type="text" name="name" id="name" value="<?= $_GET['name'] ?>" placeholder="Name">
        <br>
        <textarea name="description" id="description" placeholder="Description"><?= $_GET['description'] ?></textarea>
        <br>
        <label for="status">
            Status
            <select name="status" id="" value="<?= $_GET['status'] ?>">
                <option value="done">Done</option>
                <option value="in progress">In progress</option>
                <option value="not started" selected>Not Started</option>
            </select>
        </label>
        <br>
        <label for="duedate">
            Duedate <input type="date" name="duedate" id="" value="<?= $_GET['duedate'] ?>">
        </label>
        <br>
        <input type="submit" value="Edit Task">
    </form>
</body>

</html>