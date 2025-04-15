<?php
session_start();
if (isset($_SESSION['firstname'])){
    session_destroy();
    header("location: index.php");
    exit();
}