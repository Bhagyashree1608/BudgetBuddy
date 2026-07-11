<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BudgetBuddy</title>
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;700&family=Montserrat:wght@300;400;500;700&display=swap');
    </style>
</head>

<body class="auth-container" >

    <div class="dash" style="background:white; margin-top:0px;" >
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

            <!-- Banks Dropdown Section -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Banks
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="bank.php">Add Bank Details</a></li>
                    <li><a class="dropdown-item" href="account.php">Add Account Details</a></li>
                </ul>
            </li>

            <!-- View Records Dropdown Section -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    View Records
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="incomerecord.php">Income Records</a></li>
                    <li><a class="dropdown-item" href="exprecord.php">Expense Records</a></li>
                </ul>
            </li>

            <!-- View Reports Dropdown Section -->
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

</body>

</html>

<?php
session_start();

// Database Connection
$conn = new mysqli('localhost', 'root', '', 'expense_tracker');

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Insert Bank Details
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_bank'])) {
    $holder_name = $_POST['holder_name'];
    $account_number = $_POST['account_number'];
    $bank_name = $_POST['bank_name'];
    $branch = $_POST['branch'];
    $ifsc_code = $_POST['ifsc_code'];

    // Using Prepared Statement to Prevent SQL Injection
    $stmt = $conn->prepare("INSERT INTO bank_details (holder_name, account_number, bank_name, branch, ifsc_code) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $holder_name, $account_number, $bank_name, $branch, $ifsc_code);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Bank details added successfully!";
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
    }
    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Delete Record
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Using Prepared Statement to Prevent SQL Injection
    $stmt = $conn->prepare("DELETE FROM bank_details WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Bank record deleted successfully!";
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
    }
    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BudgetBuddy - Add Bank Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(to right, #4CAF50, #3F51B5);
        }

        .container {
            margin-top: 50px;
        }
        .detailcard{
            margin-left:25%;
        }

        .card {
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 600px;
        }
        .bankcard {
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
            margin-left:10%;
        }

        .btn-custom {
            background-color: #4CAF50;
            color: white;
            transition: 0.3s;
            width: 50% !important; 
            display:block;
            margin:0 auto;
            
        }

        .btn-custom:hover {
            background-color: #45a049;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c0392b;
        }

        table {
            background-color: white;
        }

        .alert {
            margin-top: 20px;
        }
        h4{
            text-align:center;
            padding:10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Display Success or Error Message -->
        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <i class='fa-solid fa-check-circle'></i> {$_SESSION['success']}
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                  </div>";
            unset($_SESSION['success']);
        }

        if (isset($_SESSION['error'])) {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <i class='fa-solid fa-exclamation-circle'></i> {$_SESSION['error']}
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                  </div>";
            unset($_SESSION['error']);
        }
        ?>

        <!-- Add Bank Details Form -->
        <div class="card p-4 detailcard">
            <h4 class="mb-3"><i class="fa-solid fa-university"></i> Add Bank Details</h4>
            <form method="POST" action="">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Account Holder Name</label>
                        <input type="text" name="holder_name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Account Number</label>
                        <input type="number" name="account_number" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Bank Name</label>
                        <input type="text" name="bank_name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Branch</label>
                        <input type="text" name="branch" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>IFSC Code</label>
                        <input type="text" name="ifsc_code" class="form-control" required>
                    </div>
                </div>

                <button type="submit" name="add_bank" class="btn btn-custom w-100" style="width:40px;">
                    <i class="fa-solid fa-plus"></i> Add Bank Details
                </button>
            </form>
        </div>

        <!-- Display Bank Details -->
        <div class="card p-4 mt-4 bankcard">
            <h4 class="mb-3"><i class="fa-solid fa-table"></i> Bank Details List</h4>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Sr. No</th>
                            <th>Account Holder Name</th>
                            <th>Account Number</th>
                            <th>Bank Name</th>
                            <th>Branch</th>
                            <th>IFSC Code</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM bank_details";
                        $result = $conn->query($sql);
                        $sr = 1;
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "
                                    <tr>
                                        <td>$sr</td>
                                        <td>{$row['holder_name']}</td>
                                        <td>{$row['account_number']}</td>
                                        <td>{$row['bank_name']}</td>
                                        <td>{$row['branch']}</td>
                                        <td>{$row['ifsc_code']}</td>
                                        <td>
                                            <a href='?delete={$row['id']}' class='btn btn-delete btn-sm' onclick='return confirm(\"Are you sure to delete this record?\")'>
                                                <i class='fa-solid fa-trash'></i> Delete
                                            </a>
                                        </td>
                                    </tr>";
                                $sr++;
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>No records found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
     
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="assets/js/password-addon.js"></script>
</body>

</html>
