<?php
$mysqli = mysqli_connect("localhost", "doe", "doe123", "task_db");
if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<?php
session_start();

include_once __DIR__ . "/../AdminModel.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $admin = new AdminModel();
    $admin->firstname = $_POST['firstname'];
    $admin->lastname = $_POST['lastname'];
    $admin->email = $_POST['email'];
    $admin->password = $_POST['password'];
    $admin->registerAdmin();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Admin Registration</title>
</head>

<body>
    <h1>Admin Registeration</h1>
    <form action="" method="post">
        <input type="text" name="firstname" id="" placeholder="Firstname" required>
        <br>
        <input type="text" name="lastname" id="" placeholder="Lastname" required>
        <br>
        <input type="email" name="email" id="" placeholder="Email" required>
        <br>
        <input type="password" name="password" id="" placeholder="Password" required>
        <br>
        <input type="submit" value="Register" name="submit">
    </form>
</body>

</html>