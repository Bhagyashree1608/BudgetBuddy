<?php
include 'db.php';

$user_email = isset($_GET['email']) ? $_GET['email'] : ''; // Get email from URL
$user = null;

// Fetch user details if email is provided
if (!empty($user_email)) {
    $sql = "SELECT * FROM users WHERE email = '$user_email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "<script>alert('User not found!');</script>";
    }
}

// Handle form submission and update user data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $phone_number = $_POST['mobile_number'];
    $photo_folder = '';

    // Handle profile photo upload
    if (!empty($_FILES['profile_photo']['name'])) {
        $photo_name = $_FILES['profile_photo']['name'];
        $photo_tmp_name = $_FILES['profile_photo']['tmp_name'];
        $photo_folder = 'uploads/' . time() . '_' . $photo_name;

        // Move the uploaded photo to the "uploads" folder
        if (move_uploaded_file($photo_tmp_name, $photo_folder)) {
            // Update user info with new photo
            $update_sql = "UPDATE users SET username='$name', email='$email', mobilenumber='$phone_number', photo='$photo_folder' WHERE email='$email'";
        } else {
            echo "<script>alert('Error uploading photo.');</script>";
            exit();
        }
    } else {
        // Update without changing the photo
        $update_sql = "UPDATE users SET username='$name', email='$email', mobilenumber='$phone_number' WHERE email='$email'";
    }

    // Execute update query
    if ($conn->query($update_sql) === TRUE) {
        echo "<script>
            alert('Profile updated successfully!');
            window.location.href = 'profile.php'; // Redirect to clear fields after update
        </script>";
        exit();
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
<link rel="shortcut icon" href="assets/images/favicon.ico">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Profile Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            width: 60%;
            margin: 10px auto;
            background: #fff;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-photo-container {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0 auto 10px;
        }

        .profile-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #ddd;
            cursor: pointer;
        }

        #profile-photo-input {
            display: none;
        }

        .edit-icon {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background-color: #4CAF50;
            color: #fff;
            border-radius: 50%;
            padding: 5px;
            font-size: 12px;
            cursor: pointer;
        }

        h2,
        h3 {
            text-align: center;
        }

        .form-group {
            margin: 15px 0;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="file"],
        button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
        .back{
           background: linear-gradient(to right, #4CAF50, #3F51B5) !important;
           height:800px;
           padding:20px;
        }
    </style>
</head>

<body>
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

    <div class="back" >
    <div class="container" >
        <h2>Personal Details</h2>

        <!-- Profile Photo Circle -->
        <div class="profile-photo-container">
            <img src="<?php echo (!empty($user['photo']) && file_exists($user['photo'])) ? $user['photo'] : 'user.webp'; ?>"
                alt="Profile Photo" class="profile-photo" id="profile-photo"
                onclick="document.getElementById('profile-photo-input').click();">
            <span class="edit-icon" onclick="document.getElementById('profile-photo-input').click();">✏️</span>
        </div>

        <h3>
            <?php echo htmlspecialchars($user['username'] ?? ''); ?>
        </h3>

        <!-- Hidden File Input -->
        <form action="profile.php?email=<?php echo $user_email; ?>" method="POST" enctype="multipart/form-data">
            <input type="file" name="profile_photo" id="profile-photo-input" onchange="previewPhoto(this);">

            <div class="form-group">
                <label>Enter Email to Fetch Details</label>
                <input type="email" name="email" id="email-input" value="<?php echo htmlspecialchars($user_email); ?>"
                    onblur="fetchUserData()" required>
            </div>

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="username"
                    value="<?php echo htmlspecialchars($user['username'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="mobile_number"
                    value="<?php echo htmlspecialchars($user['mobilenumber'] ?? ''); ?>" required>
            </div>

            <button type="submit">Update Profile</button>
        </form>
    </div>
    </div>

    <script>
        // Preview photo before uploading
        function previewPhoto(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('profile-photo').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Fetch user data based on entered email
        function fetchUserData() {
            var email = document.getElementById('email-input').value;
            if (email !== '') {
                window.location.href = 'profile.php?email=' + email;
            }
        }
    </script>
       
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/password-addon.js"></script>
</body>

</body>

</html>
