<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'expense_tracker');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Get all banks from bank_details
$sql = "SELECT bank_name FROM bank_details";
$result = $conn->query($sql);

$banks = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $banks[] = $row['bank_name'];
    }
}

echo json_encode($banks);
$conn->close();
?>
