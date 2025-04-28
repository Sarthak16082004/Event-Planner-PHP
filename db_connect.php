<?php
// db_connect.php - Database connection
$host = "localhost";
$username = "root";  // Change as needed
$password = "";      // Change as needed
$database = "event_planner";

// Create connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>