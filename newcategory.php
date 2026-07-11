<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
    <head>
    <title>Add Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="categories.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

</head>
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
    <div class="adnc">
    <form action="add_category.php" method="POST">
    <h2 class="bold-heading">Add New Category</h2>
<div class="inp">
    <b><label for="type">
    <i class="fa-solid fa-wallet" style="margin-right: 8px;"></i> Type:</label></b>
        <select name="type" id="type" required>
            <option value="Income">Income</option>
            <option value="Expense">Expense</option>
        </select>
</div>
<div class="inp">
        <b><label for="name">
        <i class="fa-solid fa-layer-group " style="margin-right: 8px;"></i>Name:</label></b>
        <input type="text" name="name" id="name" required></b>
        </div>
        <div class="adcbtn">
        <button type="submit" id="adc">Add Category</button>
</div>
    </form>
</div>
    <br>
    <a href="categories.php">View Categories</a>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script src="assets/js/password-addon.js"></script>
</body>
</html>
