<?php
require('db.php');
include("auth.php");

if ($_SESSION['role'] !== 'customer') {
    header("Location: login.php");
    exit();
}
?>
<h1>Welcome Customer</h1>