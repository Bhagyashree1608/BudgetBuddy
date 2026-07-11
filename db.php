<?php
$host = 'sql309.infinityfree.com'; // Database host
$user = 'if0_42386743'; // Database username
$password = 'eXiiejUmE8vIQ'; // Database password
$database = 'if0_42386743_bbuddy'; // Database name

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
