<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register | CampusFound</title>

    <link rel="stylesheet" href="../css/register.css?v=3">
</head>

<body>
    <main class="register-page">
        <div class="register-card">

            <div class="register-brand">
                <div class="brand-icon">CF</div>

                <h1>CampusFound</h1>

                <p>Lost something? Find it here.</p>
            </div>

            <div class="register-heading">
                <h2>Create Account</h2>

                <p>Register to get started.</p>
            </div>

            <form action="../php/register-process.php" method="POST" class="register-form">

                <div class="form-group">
                    <label for="fullname">Full Name</label>

                    <input
                        type="text"
                        id="fullname"
                        name="fullname"
                        placeholder="Enter your full name"
                        required>
                </div>

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
                        placeholder="Create your password"
                        required>
                </div>

                <button type="submit" class="register-button">
                    Create Account
                </button>

            </form>

            <div class="login-link">
                <span>Already have an account?</span>
                <a href="login.php">Login here</a>
            </div>

        </div>

    </main>
</body>
</html>