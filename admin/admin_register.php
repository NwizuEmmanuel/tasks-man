<?php
$mysqli = mysqli_connect("localhost", "doe", "doe123", "task_db");
if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<?php
session_start();
include_once("config.php");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $firstname = mysqli_real_escape_string($mysqli, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($mysqli, $_POST['lastname']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);
    $role = "admin";
    $password = password_hash($password, PASSWORD_DEFAULT);

    $result = mysqli_query($mysqli, "INSERT INTO users(firstname, lastname, email, password, role) VALUES ('$firstname', '$lastname','$email','$password', '$role')");
    echo "<script>alert('Admin was registered.')</script>";
    header("location: admin_register.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
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