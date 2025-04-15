<?php
include_once("../config.php");
if ($_SERVER['REQUEST_METHOD'] === "POST"){
    $task = mysqli_real_escape_string($mysqli, $_POST['task']);
    $status = mysqli_real_escape_string($mysqli, $_POST['status']);
    $duedate = mysqli_real_escape_string($mysqli, $_POST['duedate']);
    $id = mysqli_real_escape_string($mysqli, $_POST['id']);
    $user_id = mysqli_real_escape_string($mysqli,$_POST['user_id']);

    $result = mysqli_query($mysqli, "UPDATE tasks SET task='$task', status='$status', duedate='$duedate' WHERE id='$id' AND user_id='$user_id'");
    if ($result) {
        echo "<script>alert('Task was updated.')</script>";
        header("location: ../index.php");
        exit();
    } else {
        echo "<script>alert('Task was not updated.')</script>";
    }
}?>
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
            <input type="hidden" name="user_id" value="<?= $_GET['user_id'] ?>">
            <textarea name="task" id="task" placeholder="Tasks"><?= $_GET['task'] ?></textarea>
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