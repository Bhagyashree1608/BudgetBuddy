<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'expense_tracker');

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Get form data
$type = $_POST['type'];
$amount = $_POST['amount'];
$category = $_POST['category'];
$date = $_POST['date'];
$description = $_POST['description'];
$mode = $_POST['mode'];
$bank = $_POST['bank'];
$rate = $_POST['rate'];
$quantity = $_POST['quantity'];
$payment_details = $_POST['paymentDetails'];

// Handle receipt upload
$receipt = '';
if (isset($_FILES['receipt']) && $_FILES['receipt']['error'] == UPLOAD_ERR_OK) {
    $receipt_dir = "uploads/";

    // Create uploads folder if it does not exist
    if (!is_dir($receipt_dir)) {
        mkdir($receipt_dir, 0777, true);
    }

    $receipt_name = basename($_FILES['receipt']['name']);
    $receipt_tmp = $_FILES['receipt']['tmp_name'];
    $receipt_path = $receipt_dir . $receipt_name;

    // Check if the file is an image (optional but recommended)
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    $file_extension = strtolower(pathinfo($receipt_name, PATHINFO_EXTENSION));

    if (in_array($file_extension, $allowed_types)) {
        // Move the uploaded file to the destination directory
        if (move_uploaded_file($receipt_tmp, $receipt_path)) {
            $receipt = $receipt_name; // Only store the file name
        } else {
            echo "<script>alert('Error uploading receipt. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.');</script>";
    }
}

// Insert transaction data into the database
$sql = "INSERT INTO transactions (type, amount, category, date, description, mode, bank, rate, quantity, payment_details, receipt)
        VALUES ('$type', '$amount', '$category', '$date', '$description', '$mode', '$bank', '$rate', '$quantity', '$payment_details', '$receipt')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
            alert('Transaction added successfully!');
            window.location.href = 'transaction.php';
          </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
