<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'expense_tracker');

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Get type from query parameter
$type = isset($_GET['type']) ? $_GET['type'] : '';

// Prepare and execute query based on type
if ($type === 'Income') {
    $sql = "SELECT name FROM categories WHERE type = 'Income'";
} elseif ($type === 'Expense') {
    $sql = "SELECT name FROM categories WHERE type = 'Expense'";
} else {
    $sql = "SELECT name FROM categories"; // Default to fetch all categories if type is not provided
}

$result = $conn->query($sql);

$categories = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row['name'];
    }
}
$categories[] = 'Other';
// Return categories as JSON
echo json_encode($categories);

$conn->close();
?>
