<!DOCTYPE html>
<html>

<head>
    <title>Transaction Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="transaction.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .card {
            background-color: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 480px;
            padding: 30px;
            margin: 40px auto;
            font-size: 1rem;
        }

        .hidden {
            display: none !important;
        }
        label {
            font-size: 1.2rem;
            font-weight: bold;
        }
    </style>
</head>


<body class="auth-container" >
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

    <div class="back"style="background: linear-gradient(to right, #4CAF50, #3F51B5) !important;">>
    <div class="container mt-5" >
        <div class="card">
            <h2 class="text-center" style="font-weight: bold;">Transaction Details</h2>
            <form id="transactionForm" action="process_transaction.php" method="POST" enctype="multipart/form-data">

               
                <div class="form-group">
                   <b> <label for="type" style="font-size: 1.2rem;">Type</label></b>
                    <select id="type" name="type" class="form-control" onchange="updateFields()" required>
                        <option value="Income">Income</option>
                        <option value="Expense">Expense</option>
                    </select>
                </div>

                <div id="commonFields">
                    <div class="form-group">
                        <label for="category" style="font-size: 1.2rem;">Category</label>
                        <select id="category" name="category" class="form-control" required></select>
                    </div>

                    <div class="form-group">
                        <label for="date" style="font-size: 1.2rem;">Date</label>
                        <input type="date" id="date" name="date" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label for="mode" style="font-size: 1.2rem;"> Mode</label>
                        <select id="mode" name="mode" class="form-control">
                            <option value="Online">Online</option>
                            <option value="Cash">Cash</option>
                            <option value="Check">Check</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="amount" style="font-size: 1.2rem;">Amount</label>
                        <input type="number" id="amount" name="amount" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label for="bank" style="font-size: 1.2rem;">Select Bank</label>
                        <select id="bank" name="bank" class="form-control"></select>
                    </div>

                    <div class="form-group">
                        <label for="description" style="font-size: 1.2rem;">Details</label>
                        <input type="text" id="description" name="description" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="paymentDetails" style="font-size: 1.2rem;">Payment Details</label>
                        <input type="text" id="paymentDetails" name="paymentDetails" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="receipt" style="font-size: 1.2rem;">Upload Receipt</label>
                        <input type="file" id="receipt" name="receipt" class="form-control" accept="image/*" />
                    </div>

                </div>

                <div id="expenseFields" class="hidden">
                    <div class="form-row" id="accountRow">
                        <div class="form-group col-md-6">
                            <label for="account" style="font-size: 1.2rem;">Select Account</label>
                            <select id="account" name="account" class="form-control"></select>
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6" id="rateRow">
                            <label for="rate" style="font-size: 1.2rem;">Rate</label>
                            <input type="number" id="rate" name="rate" class="form-control" />
                        </div>
                        <div class="form-group col-md-6" id="quantityRow">
                            <label for="quantity" style="font-size: 1.2rem;">Quantity</label>
                            <input type="number" id="quantity" name="quantity" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group" id="paymentStatusRow">
                        <label for="paymentStatus" style="font-size: 1.2rem;">Payment Status</label>
                        <select id="paymentStatus" name="paymentStatus" class="form-control">
                            <option value="Pending">Pending</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>

                    
                </div>

                <button id="submitButton" type="submit" class="btn btn-success" style="width: 100%; margin-top: 20px;">Add Income</button>
            </form>
            </div>
        </div>
    </div>

    <script>
        function fetchCategories(type) {
            fetch('get_categories.php?type=' + type)
                .then(response => response.json())
                .then(data => {
                    const categorySelect = document.getElementById('category');
                    categorySelect.innerHTML = '';
                    data.forEach(category => {
                        const option = document.createElement('option');
                        option.value = category;
                        option.textContent = category;
                        categorySelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching categories:', error));
        }

        
        function fetchAccounts() {
            fetch('get_accounts.php')
                .then(response => response.json())
                .then(data => {
                    const accountSelect = document.getElementById('account');
                    accountSelect.innerHTML = '';
                    data.forEach(account => {
                        const option = document.createElement('option');
                        option.value = account;
                        option.textContent = account;
                        accountSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching accounts:', error));
        }

        
        function fetchBanks() {
            fetch('get_banks.php')
                .then(response => response.json())
                .then(data => {
                    const bankSelect = document.getElementById('bank');
                    bankSelect.innerHTML = '';
                    data.forEach(bank => {
                        const option = document.createElement('option');
                        option.value = bank;
                        option.textContent = bank;
                        bankSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching banks:', error));
        }

    
        function updateFields() {
            const type = document.getElementById('type').value;
            const expenseFields = document.getElementById('expenseFields');
            const submitButton = document.getElementById('submitButton');

    
            const accountField = document.getElementById('accountRow');
            const rateField = document.getElementById('rateRow');
            const quantityField = document.getElementById('quantityRow');
            const paymentStatusField = document.getElementById('paymentStatusRow');

            if (type === 'Expense') {
                expenseFields.classList.remove('hidden');
                submitButton.textContent = 'Add Expense';
                submitButton.classList.remove('btn-success');
                submitButton.classList.add('btn-danger');

                fetchCategories('Expense');
                fetchAccounts();
                fetchBanks();

                // Show specific fields for Expense
                accountField.classList.remove('hidden');
                rateField.classList.remove('hidden');
                quantityField.classList.remove('hidden');
                paymentStatusField.classList.remove('hidden');

            } else {
                expenseFields.classList.add('hidden');
                submitButton.textContent = 'Add Income';
                submitButton.classList.remove('btn-danger');
                submitButton.classList.add('btn-success');

                fetchCategories('Income');

            
                accountField.classList.add('hidden');
                rateField.classList.add('hidden');
                quantityField.classList.add('hidden');
                paymentStatusField.classList.add('hidden');
            }
        }


        document.addEventListener('DOMContentLoaded', () => {
            updateFields();
        });
    </script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/password-addon.js"></script>
    
</body>

</html>
