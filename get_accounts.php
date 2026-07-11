<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'expense_tracker');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Get all accounts from account_details
$sql = "SELECT account_name FROM account_details";
$result = $conn->query($sql);

$accounts = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $accounts[] = $row['account_name'];
    }
}

echo json_encode($accounts);
$conn->close();
?>
