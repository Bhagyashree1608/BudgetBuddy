<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'expense_tracker';


$conn = new mysqli($host, $user, $password, $dbname);


if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if ($password !== $confirm_password) {
    echo "<script>
    alert('Passwords do not match! ❌');
    window.location.href = 'signup.php'; 
</script>";
}


$hashed_password = password_hash($password, PASSWORD_DEFAULT);


$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
        alert('Registration successful! 🎉');
        window.location.href = 'login.php'; // Redirect to login page
    </script>";
    exit();
} else {
    echo "<script>
    alert('Passwords do not match! ❌');
    window.location.href = 'signup.php'; // Redirect to signup page
</script>";
exit(); 
}


$conn->close();
?>
