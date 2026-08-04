<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register- CampusFound</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/register.css">
</head>

<body>
    <div class="register-container">
        <h1>CampusFound</h1>

        <h2>Create Account</h2>

        <p>Register to get started</p>

        <form action="../php/register-process.php" method="POST">

            <label>Full Name:</label><br>
            <input type="text" name="fullname" placeholder="Enter your full name" required><br>

            <label>Email:</label><br>
            <input type="email" name="email" placeholder="Enter your email" required><br>

            <label>Password:</label><br>
            <input type="password" name="password" placeholder="Create password" required><br>

            <button type="submit">Register</button>

            <p>
                Already have an account?
                <a href="login.php">Login here</a>
            </p>

        </form>
    </div>
</body>

</html>