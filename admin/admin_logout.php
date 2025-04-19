<?php
session_start();
session_destroy();
header("location: admin_page.php");
exit();
