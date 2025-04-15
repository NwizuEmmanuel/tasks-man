<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_task'])) {
    // Database connection
    $conn = new mysqli("localhost", "doe", "doe123", "task_db");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize and retrieve input data
    $task_id = intval($_POST['task_id']);
    $task = $conn->real_escape_string($_POST['task']);
    $status = $conn->real_escape_string($_POST['status']);
    $duedate = $conn->real_escape_string($_POST['duedate']);

    // Update query
    $stmt = $conn->prepare("UPDATE tasks SET task = ?, status = ?, duedate = ? WHERE id = ?");
    $stmt->bind_param("sssi", $task, $status, $duedate, $task_id);

    if ($stmt->execute()) {
        echo "Task updated successfully.";
    } else {
        echo "Error updating task: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
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
        <label for="task">Task:</label>
        <input type="text" name="task" id="task" required value="<?php echo isset($_GET['task']) ? htmlspecialchars($_GET['task']) : ''; ?>">
        <label for="status">Status:</label>
        <input type="text" name="status" id="status" required value="<?php echo isset($_GET['status']) ? htmlspecialchars($_GET['status']) : ''; ?>">
        <label for="duedate">Due Date:</label>
        <input type="date" name="duedate" id="duedate" required value="<?php echo isset($_GET['duedate']) ? htmlspecialchars($_GET['duedate']) : ''; ?>">
        <button type="submit" name="update_task">Update Task</button>
    </form>
    <br>
    <a href="admin_page.php">Back to Admin Page</a>
    <br>
</body>

</html>