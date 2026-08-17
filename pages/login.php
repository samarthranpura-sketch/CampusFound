<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login- CampusFound</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="login-container">
        <h1>CampusFound</h1>

        <h2>Welcome Back!</h2>

        <p>Login to Continue</p>

        <form action="../php/login-process.php" method="post">
            <label>Email:</label>
            <input type="email" name="email" placeholder="Enter your email" required><br>
           
            <label>Password:</label>
            <input type="password" name="password" placeholder="Enter your password" required><br>

            <button type="submit">Login</button>
        </form>

        <p>
            Don't have an account?
            <a href="register.php">Register here</a>
        </p>
    </div>
</body>
</html>