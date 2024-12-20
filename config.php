<?php
// Define database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kangaroocare";

// Create connection to the database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection was successful
if (!$conn) {
    // Display an error message and terminate script if connection fails
    die("Connection failed: " . mysqli_connect_error());
}

// For testing if success
// echo "Connected successfully";
?>