<?php session_start(); ?>
<?php include_once("config.php");?>
<?php
if (!isset($_SESSION['firstname']) && !isset($_SESSION['role'])){
    header("location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['firstname']; ?></h1>
    <div>
        <a href="logout.php">Logout</a>
    </div>
    <h2>Add Tasks</h2>
    <div>
        <form action="tasks/add.php" method="post">
            <textarea name="task" id="task" placeholder="Tasks" required></textarea>
            <br>
            <label for="status">
                Status
                <select name="status" id="" required>
                    <option value="done">Done</option>
                    <option value="in progress">In progress</option>
                    <option value="not started" selected>Not Started</option>
                </select>
            </label>
            <br>
            <label for="duedate">
                Duedate <input type="date" name="duedate" id="" required>
            </label>
            <br>
            <input type="submit" value="Add Task">
        </form>
    </div>
    <h2>Tasks</h2>
    <?php include_once("tasks/display.php"); ?>
</body>
</html>