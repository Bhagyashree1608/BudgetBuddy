<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Login - BudgetBuddy</title>
</head>
<body>
    <!-- Navbar -->
    <div class="dash">
        <ul class="nav nav-pills nav-fill">
                <b>
                    <u>
                        <a class="nav-link" aria-current="page" href="index.php" style="color: black !important; text-decoration: none;">
                            <i class="fa-solid fa-wallet" style="margin-right: 8px;"></i> BudgetBuddy
                        </a>
                    </u>
                </b>
        </ul>
    </div>
    <div class="register-container">
    <a href="signup.php" class="register-btn">
        <i class="fas fa-user"></i> Register
    </a>
</div>

    <!-- Login Form -->
    <div class="login-container">
        <form action="process_login.php" method="POST" class="login-form">
            <h1>Login</h1>
            <p>Login to access your account</p>

            <!-- Email Field -->
            <div class="input-container">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Email" required />
            </div>

            <!-- Password Field -->
            <div class="input-container">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required />
            </div>

            <!-- Login Button -->
            <button type="submit" class="login-btn">Login</button>
        </form>
    </div>
</body>
</html>
