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

// Get form data
$email = $_POST['email'];
$password = $_POST['password'];

// Validate email and password
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    
    // Verify the password
    if (password_verify($password, $row['password'])) {
        // Login successful, redirect to transaction.php
        echo "<script>
            alert('Login successful! 🎉');
            window.location.href = 'transaction.php';
        </script>";
        exit();
    } else {
        // Incorrect password
        echo "<script>
            alert('Invalid email or password! ❌');
            window.location.href = 'login.php';
        </script>";
        exit();
    }
} else {
    // Email not found
    echo "<script>
        alert('Invalid email or password! ❌');
        window.location.href = 'login.php';
    </script>";
    exit();
}

// Close connection
$conn->close();
?>
