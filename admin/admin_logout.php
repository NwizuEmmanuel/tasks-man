<?php
session_start();
if (isset($_SESSION['firstname']) && isset($_SESSION['role'])){
    session_destroy();
    header("location: index.php");
    exit();
}