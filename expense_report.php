<?php

$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'expense_tracker';

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT category, date, rate, quantity, description, mode, bank, amount FROM transactions WHERE type = 'Expense'";
$result = $conn->query($sql);

$transactions = [];
$totalAmount = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $transactions[] = $row;
        $totalAmount += $row['amount'];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Expense Report</title>
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <style>
        body {
            background: #f0f4f7;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .container {
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            padding-top: 30px;
        }
        .dataTables_wrapper .dt-buttons {
            margin-bottom: 15px;
        }
        .back{
            background: linear-gradient(to right, #4CAF50, #3F51B5) !important;
            height: 900px;
            padding-top: 30px; 
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

           
        </ul>
    </div>

<div class="back">
<div class="container mt-5">
    <h2>📊 Expense Report</h2>
    <table id="incomeTable" class="display nowrap table table-bordered table-striped" style="width:100%">
        <thead class="table-dark">
            <tr>
                <th>Category</th>
                <th>Date</th>
                <th>Rate</th>
                <th>Quantity</th>
                <th>Description</th>
                <th>Mode</th>
                <th>Bank</th>
                <th>Amount (₹)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $txn): ?>
            <tr>
                <td><?= htmlspecialchars($txn['category']) ?></td>
                <td><?= htmlspecialchars($txn['date']) ?></td>
                <td><?= htmlspecialchars($txn['rate']) ?></td>
                <td><?= htmlspecialchars($txn['quantity']) ?></td>
                <td><?= htmlspecialchars($txn['description']) ?></td>
                <td><?= htmlspecialchars($txn['mode']) ?></td>
                <td><?= htmlspecialchars($txn['bank']) ?></td>
                <td><?= number_format($txn['amount'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot class="table-light">
            <tr>
                <th colspan="7" style="text-align:right">Total Income:</th>
                <th><strong>₹<?= number_format($totalAmount, 2) ?></strong></th>
            </tr>
        </tfoot>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS and Extensions -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script>
$(document).ready(function() {
    $('#incomeTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Income_Report'
            },
            {
                extend: 'pdfHtml5',
                title: 'Income_Report'
            },
            {
                extend: 'print',
                title: 'Income Report',
                customize: function (win) {
                    $(win.document.body).css('font-size', '10pt');
                }
            }
        ],
        responsive: true,
        paging: true,
        scrollX: true
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/password-addon.js"></script>
</div>
</body>
</html>
