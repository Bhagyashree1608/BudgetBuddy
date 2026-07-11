<?php
// Database connection
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'expense_tracker';

// Connect to MySQL
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}


$id = $_GET['id'];
$sql = "DELETE FROM categories WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header('Location: categories.php');
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
