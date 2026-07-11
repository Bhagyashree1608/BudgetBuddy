<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="signup.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</head>
<body>
    <img src="images/back2.svg" id="back1"></img>
    <div class="dash">
        <ul class="nav nav-pills nav-fill">
            <li class="nav-item">
                <b>
                    <u>
                        <a class="nav-link" aria-current="page" href="index.php" style="color: black !important; text-decoration: none;">
                            <i class="fa-solid fa-wallet" style="margin-right: 8px;"></i> BudgetBuddy
                        </a>
                    </u>
                </b>
            </li>
        </ul>
    </div>

    <div class="card">
        <div class="insigncard">
            <h1>Sign Up</h1>
            <p>🔐 Create Your Account and Start Saving!</p>

            <form action="process_signup.php" method="POST">
            <div class="input-container">
    <i class="fa-solid fa-user"></i>
    <input type="text" name="username" placeholder="Username" required><br>
</div>

<div class="input-container">
    <i class="fa-solid fa-envelope"></i>
    <input type="email" name="email" placeholder="Email" required><br>
</div>

<div class="input-container">
    <i class="fa-solid fa-lock"style="top: 30px;"></i>
    <input type="password" id="password" name="password" placeholder="Password" required>
    <i class="fa-solid fa-eye" id="togglePassword"></i><br>
</div>


<div class="input-container">
    <i class="fa-solid fa-lock"style="top: 30px;"></i>
    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
    <i class="fa-solid fa-eye" id="toggleConfirmPassword" style="cursor: pointer; left:95%;"></i>
</div>

                <button type="submit" class="btn">Register</button>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
  

</body>
</html>
