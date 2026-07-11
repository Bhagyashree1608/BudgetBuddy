<?php
// delete_transaction.php

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: incomerecord.php?msg=invalid_id");
    exit;
}

// Get transaction ID
$transaction_id = intval($_GET['id']);

// Connect to the database
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'expense_tracker';

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute delete query
$stmt = $conn->prepare("DELETE FROM transactions WHERE id = ?");
$stmt->bind_param("i", $transaction_id);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    header("Location: incomerecord.php?msg=deleted");
    exit;
} else {
    $stmt->close();
    $conn->close();
    header("Location: incomerecord.php?msg=delete_failed");
    exit;
}
?>
