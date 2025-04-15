<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Admin</title>
</head>
<body>
    <h1>Welcome, <?=$_SESSION['firstname']?></h1>
    <div><a href="admin_logout.php">Logout</a></div>
    <h2>Tasks and users</h2>
    <table>
        <thead>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Task</th>
            <th>Status</th>
            <th>Duedate</th>
            <th>Action</th>
            <tbody>
                <?php
                // Database connection
                $conn = new mysqli("localhost", "doe", "doe123", "task_db");

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Query to join users and tasks tables
                $sql = "SELECT tasks.id, users.firstname, users.lastname, users.email, tasks.task, tasks.status, tasks.duedate 
                        FROM users 
                        INNER JOIN tasks ON users.id = tasks.user_id";
                $result = $conn->query($sql);

                // Display data in table rows
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['firstname']}</td>
                                <td>{$row['lastname']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['task']}</td>
                                <td>{$row['status']}</td>
                                <td>{$row['duedate']}</td>
                                <td><a href='edit_task.php?id={$row['id']}&task={$row['task']}&status={$row['status']}&duedate={$row['duedate']}'>Edit</a> | <a href='delete_task.php?id={$row['id']}'>Delete</a></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No data found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </thead>
    </table>
</body>
</html>