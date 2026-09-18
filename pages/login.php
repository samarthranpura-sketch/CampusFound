<?php

session_start();

if (isset($_SESSION["user_id"])) {
    header("Location: my-account.php");
    exit();
}

$error = $_GET["error"] ?? "";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | CampusFound</title>

    <link rel="stylesheet" href="../css/login.css?v=3">
    <style>
        .login-error {
            margin: 0 0 20px;
            padding: 12px 14px;
            background: #fff0f0;
            border: 1px solid #f3c4c4;
            border-radius: 9px;
            color: #b42318;
            font-size: 14px;
            line-height: 1.5;
        }

        .login-error a {
            display: block;
            margin-top: 5px;
            color: #168653;
            font-weight: 700;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <main class="login-page">
        <div class="login-card">
            <div class="login-brand">
                <div class="brand-icon">CF</div>

                <h1>CampusFound</h1>

                <p>Lost something? Find it here.</p>
            </div>

            <div class="login-heading">
                <h2>Welcome Back!</h2>

                <p>Login to continue to your account.</p>
            </div>

            <?php if ($error === "notfound"): ?>

                <div class="login-error">
                    Account not found. Please register first.
                    <a href="register.php">Register Now →</a>
                </div>

            <?php elseif ($error === "wrongpassword"): ?>

                <div class="login-error">
                    Incorrect password. Please try again.
                </div>

            <?php endif; ?>

            <form action="../php/login-process.php" method="post" class="login-form">

                <div class="form-group">
                    <label for="email">Email Address</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Enter your email"
                        required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        required>
                </div>

                <button type="submit" class="login-button">
                    Login
                </button>

            </form>

            <div class="register-link">
                <span>Don't have an account?</span>
                <a href="register.php">Register here</a>
            </div>
        </div>
    </main>
</body>

</html>