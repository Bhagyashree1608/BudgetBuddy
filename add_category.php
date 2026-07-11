<?php
require_once 'db.php';

// Get form data
$type = $_POST['type'];
$name = $_POST['name'];

// Insert data
$sql = "INSERT INTO categories (type, name) VALUES ('$type', '$name')";

if ($conn->query($sql) === TRUE) {
    echo "Category added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Redirect to categories page
header('Location: categories.php');
$conn->close();
?>
