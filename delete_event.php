<?php
// Include database connection
require_once 'db_connect.php';

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// Delete event
$sql = "DELETE FROM events WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    header("Location: index.php");
} else {
    echo "Error deleting event: " . mysqli_error($conn);
    echo "<br><a href='index.php'>Go back to events</a>";
}
?>
