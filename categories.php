<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'expense_tracker';

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch categories
$sql = "SELECT * FROM categories";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="categories.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        .card {
            background-color: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 800px;
            margin: 20px auto;
            font-size: 1.1rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
        }

        .edit-icon, .delete-icon {
            color: #007bff;
            cursor: pointer;
            font-size: 1.2rem;
            margin-right: 8px;
        }

        .delete-icon {
            color: #dc3545;
        }

        .edit-icon:hover {
            color: #0056b3;
        }

        .delete-icon:hover {
            color: #c82333;
        }

        .icon-container {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .dash {
            background-color: #f8f9fa;
            padding: 10px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .nav-link {
            color: black !important;
        }

        .btn-danger {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <!-- Navbar Section -->
    <body class="auth-container">
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
                    <li><a class="dropdown-item" href="income_report.php">View Income Report</a></li>
                    <li><a class="dropdown-item" href="expense_report.php">View Expense Report</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <!-- Categories Card Section -->
    <div class="card">
        <h2 style="font-weight:bold; text-align: center;">Categories</h2>
        <br>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th style="text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['name'] . "</td>
                            <td><span class='" . strtolower($row['type']) . "'>" . $row['type'] . "</span></td>
                            <td class='icon-container'>
                                <a href='edit_category.php?id=" . $row['id'] . "'>
                                    <i class='fas fa-edit edit-icon'></i>
                                </a>
                                <a href='delete_category.php?id=" . $row['id'] . "' onclick=\"return confirm('Are you sure you want to delete this category?');\">
                                    <i class='fas fa-trash-alt delete-icon'></i>
                                </a>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script src="assets/js/password-addon.js"></script>
</body>
</html>

<?php
$conn->close();
?>
