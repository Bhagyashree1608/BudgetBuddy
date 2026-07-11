<?php
// Database connection
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'expense_tracker';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $_POST['type'];
    $name = $_POST['name'];
    $sql = "UPDATE categories SET type='$type', name='$name' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header('Location: categories.php');
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    $result = $conn->query("SELECT * FROM categories WHERE id=$id");
    $row = $result->fetch_assoc();
}
?>

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

        body {
            font-family: 'Montserrat', sans-serif;
            background: #f4f6f9;
        }

        .card {
            font-size:20px;
            max-width: 600px;
            height:500px;
            margin: 0px auto;
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 30px;
            background-color: #fff;
        }

        .card h2 {
            text-align: center;
            font-weight: 600;
            margin-bottom: 25px;
            color: #343a40;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 500;
            margin-bottom: 10px;
            display: block;
        }

        .form-group select,
        .form-group input {
            width: 100%;
            padding: 10px 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            transition: all 0.3s ease-in-out;
        }

        .form-group select:focus,
        .form-group input:focus {
            border-color:linear-gradient(to right, #4CAF50, #3F51B5);
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        button[type="submit"] {
            width: 100%;
            background-color: Green;
            color: #fff;
            border: none;
            padding: 12px;
            font-size: 16px;
            border-radius: 8px;
            transition: background 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color:linear-gradient(to right, #4CAF50, #3F51B5);
        }

        .icon {
            margin-right: 8px;
        }

        .dash {
            padding: 20px;
            background: #fff;
            border-bottom: 1px solid #ddd;
        }

        .nav-link {
            font-weight: 500;
            color: #000 !important;
        }

        .nav-link:hover {
            color:linear-gradient(to right, #4CAF50, #3F51B5);
        }
        .back{
            height: 800px;
            padding:40px;
        }
    </style>
</head>

<body>
    <div class="dash">
        <ul class="nav nav-pills nav-fill">
            <li class="nav-item" >
                <b><u><a class="nav-link" aria-current="page" href="index.php" style="color: black !important; text-decoration: none;"> 
                    <i class="fa-solid fa-wallet icon"style="color:black"></i>BudgetBuddy
                </a></u></b>
            </li>
            <li class="nav-item"><a class="nav-link" href="transaction.php">Add Transaction</a></li>
            <li class="nav-item"><a class="nav-link" href="newcategory.php">Add Category</a></li>
            <li class="nav-item"><a class="nav-link" href="categories.php">Categories</a></li>
            <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
            <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Banks</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="bank.php">Add Bank Details</a></li>
                    <li><a class="dropdown-item" href="account.php">Add Account Details</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">View Records</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="incomerecord.php">Income Records</a></li>
                    <li><a class="dropdown-item" href="exprecord.php">Expense Records</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">View Reports</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="inreports.php">View Income Report</a></li>
                    <li><a class="dropdown-item" href="expenserecord.php">View Expense Report</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="back"style="background: linear-gradient(to right, #4CAF50, #3F51B5) !important;">
    <div class="card">
        <h2><i class="fas fa-pen-to-square icon"></i>Edit Category</h2>
        <form method="POST">
            <div class="form-group">
                <label for="type"><i class="fas fa-list icon"></i>Type</label>
                <select name="type" required>
                    <option value="Income" <?php if ($row['type'] == 'Income') echo 'selected'; ?>>Income</option>
                    <option value="Expense" <?php if ($row['type'] == 'Expense') echo 'selected'; ?>>Expense</option>
                </select>
            </div>

            <div class="form-group">
                <label for="name"><i class="fas fa-tag icon"></i>Name</label>
                <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
            </div>

            <button type="submit"><i class="fas fa-check-circle icon"></i>Update Category</button>
        </form>
    </div>
    <div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php $conn->close(); ?>
</body>

</html>
