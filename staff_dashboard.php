<?php
require('config/db.php');
include("config/auth.php");

if ($_SESSION['role'] !== 'staff') {
    header("Location: login.php");
    exit();
}
?>
<h1>Welcome Staff</h1>