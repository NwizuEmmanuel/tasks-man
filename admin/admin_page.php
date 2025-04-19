<?php
session_start();
include_once __DIR__ . "/../AdminModel.php";
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
    <?php
    $id = $_SESSION["userid"];
    if (!isset($id)) {
        header("location: admin_login.php");
        exit();
    }
    $id = (int)$id;
    $firstname=new AdminModel();
    $firstname = $firstname->getAdminFirstname($id);
    ?>
    <h1>Welcome, <?=$firstname;?></h1>
    <div><a href="admin_logout.php">Logout</a></div>
    <h2>Tasks and users</h2>
    <table>
        <thead>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Name</th>
            <th>Description</th>
            <th>Status</th>
            <th>Duedate</th>
            <th>Action</th>
            <tbody>
                <?php
                $result = new AdminModel();
                $result = $result->getUsersAndTasks();
                // Display data in table rows
                if (count($result) > 0) {
                    foreach ($result as $row) {
                        echo "<tr>
                                <td>{$row['firstname']}</td>
                                <td>{$row['lastname']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['description']}</td>
                                <td>{$row['status']}</td>
                                <td>{$row['duedate']}</td>
                                <td><a href='edit_task.php?id={$row['id']}&name={$row['name']}&description={$row['description']}&status={$row['status']}&duedate={$row['duedate']}'>Edit</a> | <a href='delete_task.php?id={$row['id']}'>Delete</a></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No data found</td></tr>";
                }
                ?>
            </tbody>
        </thead>
    </table>
</body>
</html>