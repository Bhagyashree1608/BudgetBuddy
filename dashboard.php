<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="transaction.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<body class="auth-container" >
    <div class="dash" style="background:white;!important">
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/password-addon.js"></script>
</body>
</html>
<?php
// Include database connection
include('db.php');

// ✅ Today's Expense
$result = $conn->query("SELECT SUM(amount) AS todayExpense FROM transactions WHERE DATE(date) = CURDATE() AND type = 'expense'");
$row = $result->fetch_assoc();
$todayExpense = $row['todayExpense'] ?? 0;

// ✅ Monthly Expense
$result = $conn->query("SELECT SUM(amount) AS monthExpense FROM transactions WHERE MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE()) AND type = 'expense'");
$row = $result->fetch_assoc();
$monthExpense = $row['monthExpense'] ?? 0;

// ✅ Yearly Expense
$result = $conn->query("SELECT SUM(amount) AS yearExpense FROM transactions WHERE YEAR(date) = YEAR(CURDATE()) AND type = 'expense'");
$row = $result->fetch_assoc();
$yearExpense = $row['yearExpense'] ?? 0;

// ✅ Monthly Income
$result = $conn->query("SELECT SUM(amount) AS monthIncome FROM transactions WHERE MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE()) AND type = 'income'");
$row = $result->fetch_assoc();
$monthIncome = $row['monthIncome'] ?? 0;

// ✅ Yearly Income
$result = $conn->query("SELECT SUM(amount) AS yearIncome FROM transactions WHERE YEAR(date) = YEAR(CURDATE()) AND type = 'income'");
$row = $result->fetch_assoc();
$yearIncome = $row['yearIncome'] ?? 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Expense Tracker Dashboard</title>
    <
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Google Fonts & Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        
        body {
            font-family: 'Roboto', sans-serif;
            background-color:rgb(160, 160, 161);
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            margin: 20px auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        /* Card Design */
        .card {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            width: 100%;
        }
        .card h3 {
            margin-top: 0;
        }
        .icon {
            font-size: 24px;
            margin-right: 10px;
        }

        /* Grid Layout */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 20px;
        }

        /* Row Layout */
        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
        }
        .row .card {
            flex: 1;
            min-width: 400px;
        }

        /* Chart Styling */
        canvas {
            width: 100% !important;
            height: 300px !important;
        }
    </style>
</head>
<body>

<div class="container">
    <h2><i class="fas fa-chart-line"></i> Your Expenses & Income </h2>

    <!-- Row 1: Today's Expense Chart -->
    <div class="row">
        <div class="card">
            <h3><i class="fas fa-wallet icon" style="color: #4B8BF4;"></i> Today's Expense: ₹<?php echo $todayExpense; ?></h3>
            <canvas id="todayExpenseChart"></canvas>
        </div>
    </div>

    <!-- Row 2: Monthly Expense & Monthly Income -->
    <div class="row">
        <div class="card">
            <h3><i class="fas fa-calendar-alt icon" style="color: #FF5733;"></i> Monthly Expense: ₹<?php echo $monthExpense; ?></h3>
            <canvas id="monthExpenseChart"></canvas>
        </div>
        <div class="card">
            <h3><i class="fas fa-money-bill-wave icon" style="color: #58D68D;"></i> Monthly Income: ₹<?php echo $monthIncome; ?></h3>
            <canvas id="monthIncomeChart"></canvas>
        </div>
    </div>

    <!-- Row 3: Yearly Expense & Yearly Income -->
    <div class="row">
        <div class="card">
            <h3><i class="fas fa-calendar-check icon" style="color: #A569BD;"></i> Yearly Expense: ₹<?php echo $yearExpense; ?></h3>
            <canvas id="yearExpenseChart"></canvas>
        </div>
        <div class="card">
            <h3><i class="fas fa-hand-holding-usd icon" style="color: #F5B041;"></i> Yearly Income: ₹<?php echo $yearIncome; ?></h3>
            <canvas id="yearIncomeChart"></canvas>
        </div>
    </div>
</div>


<script>
// Today's Expense Chart
const todayExpenseCtx = document.getElementById('todayExpenseChart').getContext('2d');
new Chart(todayExpenseCtx, {
    type: 'bar',
    data: {
        labels: ['Today'],
        datasets: [{
            label: "Today's Expense",
            data: [<?php echo $todayExpense; ?>],
            backgroundColor: ['#4B8BF4'],
            borderWidth: 1
        }]
    }
});

// Monthly Expense Chart
const monthExpenseCtx = document.getElementById('monthExpenseChart').getContext('2d');
new Chart(monthExpenseCtx, {
    type: 'bar',
    data: {
        labels: ['This Month'],
        datasets: [{
            label: 'Monthly Expense',
            data: [<?php echo $monthExpense; ?>],
            backgroundColor: ['#FF5733'],
            borderWidth: 1
        }]
    }
});

// Yearly Expense Chart
const yearExpenseCtx = document.getElementById('yearExpenseChart').getContext('2d');
new Chart(yearExpenseCtx, {
    type: 'bar',
    data: {
        labels: ['This Year'],
        datasets: [{
            label: 'Yearly Expense',
            data: [<?php echo $yearExpense; ?>],
            backgroundColor: ['#A569BD'],
            borderWidth: 1
        }]
    }
});

// Monthly Income Chart
const monthIncomeCtx = document.getElementById('monthIncomeChart').getContext('2d');
new Chart(monthIncomeCtx, {
    type: 'bar',
    data: {
        labels: ['This Month'],
        datasets: [{
            label: 'Monthly Income',
            data: [<?php echo $monthIncome; ?>],
            backgroundColor: ['#58D68D'],
            borderWidth: 1
        }]
    }
});

// Yearly Income Chart
const yearIncomeCtx = document.getElementById('yearIncomeChart').getContext('2d');
new Chart(yearIncomeCtx, {
    type: 'bar',
    data: {
        labels: ['This Year'],
        datasets: [{
            label: 'Yearly Income',
            data: [<?php echo $yearIncome; ?>],
            backgroundColor: ['#F5B041'],
            borderWidth: 1
        }]
    }
});
</script>

</body>
</html>