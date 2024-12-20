<?php
require('config.php');
include("auth.php");

if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>
<h1>Welcome Admin</h1>