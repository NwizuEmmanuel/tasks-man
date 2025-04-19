<?php
include_once __DIR__ . "/../TaskModel.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_task'])) {
    $id = $_POST['task_id'];
    $task = new TaskModel();
    $task->__set('name', $_POST['name']);
    $task->__set('description', $_POST['description']);
    $task->__set('status', $_POST['status']);
    $task->__set('duedate', $_POST['duedate']);
    $task->updateTaskById($id);
    echo "<script>alert('Task was updated.')</script>";
    header("location: admin_page.php");
    exit();
}
?>
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
    <form method="POST" action="">
        <input type="hidden" name="task_id" value="<?php echo isset($_GET['id']) ? intval($_GET['id']) : ''; ?>">
        <label for="task">Name:</label>
        <input type="text" name="name" id="name" required value="<?php echo isset($_GET['name']) ? htmlspecialchars($_GET['name']) : ''; ?>">
        <label for="description">Description:</label>
        <textarea name="description" id="description" required><?php echo isset($_GET['description']) ? htmlspecialchars($_GET['description']) : ''; ?></textarea>
        <label for="status">Status:</label>
        <select name="status" id="status" required>
            <option value="done" <?php echo (isset($_GET['status']) && $_GET['status'] === 'done') ? 'selected' : ''; ?>>Done</option>
            <option value="in progress" <?php echo (isset($_GET['status']) && $_GET['status'] === 'in progress') ? 'selected' : ''; ?>>In Progress</option>
            <option value="not started" <?php echo (isset($_GET['status']) && $_GET['status'] === 'not started') ? 'selected' : ''; ?>>Not Started</option>
        </select>
        <label for="duedate">Due Date:</label>
        <input type="date" name="duedate" id="duedate" required value="<?php echo isset($_GET['duedate']) ? htmlspecialchars($_GET['duedate']) : ''; ?>">
        <button type="submit" name="update_task">Update Task</button>
    </form>
    <br>
    <a href="admin_page.php">Back to Admin Page</a>
    <br>
</body>

</html>