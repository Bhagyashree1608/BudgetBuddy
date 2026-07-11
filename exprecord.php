<?php

$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'expense_tracker';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM transactions WHERE type = 'Expense' ORDER BY date DESC";
$result = $conn->query($sql);

if (!$result) {
    die("Error in query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>expense Records</title>
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 30px auto;
        }
        h2 {
            padding:20px;
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .background-card {
            background-color:rgb(55, 55, 56);
            border-radius: 16px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            margin-bottom: 20px;
            padding: 20px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            transition: 0.3s;
        }
        .card:hover {
            box-shadow: 0 8px 18px rgba(0,0,0,0.15);
        }
        .card-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .card-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        .card-date {
            font-size: 14px;
            color: #777;
        }
        .label {
            font-weight: 600;
            color: #444;
        }
        .actions {
            margin-top: 15px;
        }
        .actions a {
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 6px;
            margin-right: 10px;
            font-size: 13px;
        }
        .btn-edit {
            background-color: #4CAF50;
            color: white;
        }
        .btn-delete {
            background-color: #f44336;
            color: white;
        }
        .nav-pills .nav-link {
            color: grey !important;
            font-weight: bold !important;
        }
        .navbar-custom .nav-link {
            color: grey !important;
            font-weight: bold !important;
            transition: background-color 0.3s ease;
            border-radius: 8px;
            padding: 10px 15px;
        }

        .navbar-custom .nav-link:hover {
            background-color: #d3d3d3 !important; /* Light grey box on hover */
            color: black !important; /* Optional: makes text clearer on light bg */
        }
        .back{
            background: linear-gradient(to right, #4CAF50, #3F51B5) !important;
        }
                .card-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
        }

        .content-left {
            flex: 1;
        }

        .content-right {
            flex: 0 0 auto;
            text-align: right;
        }

        .receipt-img {
            max-width: 150px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }


    </style>
</head>
<body class="auth-container">
<div class="dash">
    <ul class="nav nav-pills nav-fill navbar-custom">
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
                    <li><a class="dropdown-item" href="income_report.php">View Income Report</a></li>
                    <li><a class="dropdown-item" href="expense_report.php">View Expense Report</a></li>
                </ul>
            </li>
        </ul>
    </div>

 <div class="back">   
<div class="container">
    <h2 style="color:white;!important" >Expense Records</h2>

    <div class="background-card">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
            <div class="card">
                <div class="card-header">
                    <div class="card-title"><?php echo htmlspecialchars($row['description']); ?></div>
                    <div class="card-date"><?php echo date('d M Y', strtotime($row['date'])); ?></div>
                </div>
            <div class="card-content">
                <div class="content-left">
                    <p><span class="label">Category:</span> <?php echo htmlspecialchars($row['category']); ?></p>
                    <p><span class="label">Rate:</span> ₹<?php echo number_format($row['rate'], 2); ?></p>
                    <p><span class="label">Quantity:</span> <?php echo htmlspecialchars($row['quantity']); ?></p>
                    <p><span class="label">Bank:</span> <?php echo htmlspecialchars($row['bank']); ?></p>
                    <p><span class="label">Payment Details:</span> <?php echo htmlspecialchars($row['payment_details']); ?></p>
                    <p><span class="label">Amount:</span> ₹<?php echo number_format($row['amount'], 2); ?></p>
                </div>
                <div class="content-right">
                    <img src="receipt.jpg" alt="Receipt" class="receipt-img">
                </div>
            </div>
                <div class="actions">
                    <a href="edit_transaction.php?id=<?php echo $row['id']; ?>" class="btn-edit">Edit</a>
                    <a href="delete_transaction.php?id=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                </div>
            </div>
        <?php
            }
        } else {
            echo "<p style='text-align:center;'>No income records found.</p>";
        }

        $conn->close();
        ?>
    </div>

</div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="assets/js/password-addon.js"></script>
</body>
</html>
