<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'expense_tracker';

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'] ?? '';
$transaction = [];

if (!$id) {
    echo "Transaction ID is missing.";
    exit();
}

// Fetch transaction regardless of type
$sql = "SELECT * FROM transactions WHERE id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    $transaction = $result->fetch_assoc();
    $type = $transaction['type']; // save type for redirection
} else {
    echo "Invalid Transaction ID.";
    exit();
}

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = $_POST['category'];
    $date = $_POST['date'];
    $rate = $_POST['rate'];
    $quantity = $_POST['quantity'];
    $details = $_POST['description'];
    $mode = $_POST['mode'];
    $bank = $_POST['bank'];
    $amount = $rate * $quantity;

    $update = "UPDATE transactions SET category='$category', date='$date', rate='$rate', quantity='$quantity', 
               description='$details', mode='$mode', bank='$bank', amount='$amount' WHERE id='$id'";
    
    if ($conn->query($update)) {
        // Redirect to the appropriate page based on type
        if ($type === 'income') {
            header("Location: incomerecord.php?msg=updated");
        } else {
            header("Location: exprecord.php?msg=updated");
        }
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Edit Transaction</title>
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
           
            font-family: 'Montserrat', sans-serif;
            padding: 0px;
        }
        .card {
            animation: fadeIn 0.6s ease-in;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
            padding: 30px;
            background: white;
            max-width: 600px;
            margin: auto;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
        h2 {
            font-weight: 700;
        }
        .form-label {
            font-weight: 600;
        }
        .btn {
            padding: 10px 20px;
            font-weight: 500 bold;
        }
        .btn-secondary {
            background-color: #6c757d;
        }
        .btn1{
            background:rgb(36, 222, 70);;
        }
        .back{
           padding:10px;
            background:linear-gradient(to right, #4CAF50, #3F51B5) !important;
            height: 830px;
        }
        .container{
            padding:30px;
            height: 1200px; 
        }
    </style>
</head>
<body>
    <div class="dash">
        <ul class="nav nav-pills nav-fill">
            <li class="nav-item">
                <b>
                    <u><a class="nav-link" aria-current="page" href="index.php" style="color: black !important; text-decoration: none;">
                        <i class="fa-solid fa-wallet" style="margin-right: 8px;"></i> BudgetBuddy
                    </a></u>
                </b>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="transaction.php">Add Transaction</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="newcategory.php">Add Category</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="categories.php">Categories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="profile.php">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
            </li>

           
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Banks
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="bank.php">Add Bank Details</a></li>
                    <li><a class="dropdown-item" href="account.php">Add Account Details</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    View Records
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="incomerecord.php">Income Records</a></li>
                    <li><a class="dropdown-item" href="exprecord.php">Expense Records</a></li>
                </ul>
            </li>

            
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    View Reports
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="inreports.php">View Income Report</a></li>
                    <li><a class="dropdown-item" href="expenserecord.php">View Expense Report</a></li>
                </ul>
            </li>
        </ul>
    </div>

<div class="back">
<div class="container" >
    <div class="card">
        <h2 class="text-center mb-4">Edit Transaction</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Category</label>
                <input type="text" name="category" class="form-control" value="<?= htmlspecialchars($transaction['category']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Date</label>
                <input type="date" name="date" class="form-control" value="<?= htmlspecialchars($transaction['date']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Rate</label>
                <input type="number" step="0.01" name="rate" class="form-control" value="<?= htmlspecialchars($transaction['rate']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Quantity</label>
                <input type="number" name="quantity" class="form-control" value="<?= htmlspecialchars($transaction['quantity']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Details</label>
                <input type="text" name="description" class="form-control" value="<?= htmlspecialchars($transaction['description']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Mode</label>
                <input type="text" name="mode" class="form-control" value="<?= htmlspecialchars($transaction['mode']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Bank</label>
                <input type="text" name="bank" class="form-control" value="<?= htmlspecialchars($transaction['bank']) ?>" required>
            </div>
            <div class="d-flex justify-content-between">
                <a href="incomerecord.php" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn1">Update Transaction</button>
            </div>
        </form>
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="assets/js/password-addon.js"></script>
</body>
</html>
