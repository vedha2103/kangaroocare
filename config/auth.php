<?php
// Start the session to access session variables
session_start(); 

// Check if the "username" session variable is set, which indicates the user is logged in
if(!isset($_SESSION["username"])) {
    header("Location: login.php"); 
    exit(); 
}
?>