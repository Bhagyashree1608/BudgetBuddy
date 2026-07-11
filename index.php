<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BudgetBuddy</title>
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;700&family=Montserrat:wght@300;400;500;700&display=swap');
    </style>
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

    <div class="playgrd text-center">
        <h1 class="heading">Track <span style="color: white;">Your</span> Expenses Effortlessly</h1>
        <p class="sub-heading">Manage your finance smartly, save more, and stress less with BudgetBuddy</p>
        <div class="features">
            <div class="feature">
                <i class="fa-solid fa-money-bill-wave"></i>
                <p>Efficient Tracking</p>
            </div>
            <div class="feature">
                <i class="fa-solid fa-filter"></i>
                <p>Transactions Filtering</p>
            </div>
            <div class="feature">
                <i class="fa-solid fa-chart-bar"></i>
                <p>Insightful Reports</p>
            </div>
        </div>
        <button class="btn btn-success get-started" id="getStartedBtn">Get Started</button>
    </div>

    <div class="joinus">
        <h1>Ready to Take Control of Your Finance</h1>
        <p class="intext">
            <i class="fa-solid fa-piggy-bank" style="margin-right: 8px;"></i>Take control of your finances today and achieve your savings goals effortlessly!
        </p>
        <form action="signup.php" method="POST">
            <button class="btn btn-outline-primary signup" type="submit">Sign Up</button>
        </form>
    </div>
    <script>
    document.getElementById('getStartedBtn').addEventListener('click', function() {
        window.location.href = 'signup.php';
    });
</script>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/password-addon.js"></script>
</body>
</html>
