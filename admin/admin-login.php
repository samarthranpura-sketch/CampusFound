<?php
/** @var mysqli $conn */
session_start();

if (isset($_SESSION["admin_id"])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $adminUsername = trim($_POST["username"] ?? "");
    $adminPassword = $_POST["password"] ?? "";

    include "../database/database.php";

    $sql = "SELECT id, username, password FROM admin WHERE username = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Database query error: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "s", $adminUsername);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($admin = mysqli_fetch_assoc($result)) {

        if (password_verify($adminPassword, $admin["password"])) {

            $_SESSION["admin_id"] = $admin["id"];
            $_SESSION["admin_username"] = $admin["username"];

            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login - CampusFound</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            background: #0f172a;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 1000px;
            min-height: 600px;
            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1fr;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.30);
        }

        /* Left side */

        .login-info {
            background: #12352f;
            color: white;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .login-info::before {
            content: "";
            position: absolute;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: rgba(34, 197, 94, 0.12);
            top: -100px;
            right: -100px;
        }

        .login-info::after {
            content: "";
            position: absolute;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: rgba(34, 197, 94, 0.08);
            bottom: -80px;
            left: -80px;
        }

        .brand {
            position: relative;
            z-index: 1;
            margin-bottom: 45px;
        }

        .brand-icon {
            width: 58px;
            height: 58px;
            background: #22c55e;
            color: #0f172a;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 27px;
            font-weight: bold;
            margin-bottom: 18px;
        }

        .brand h1 {
            font-size: 32px;
            margin-bottom: 10px;
            letter-spacing: -1px;
        }

        .brand p {
            color: #cbd5e1;
            font-size: 15px;
            line-height: 1.6;
        }

        .info-content {
            position: relative;
            z-index: 1;
        }

        .info-content h2 {
            font-size: 30px;
            line-height: 1.2;
            margin-bottom: 18px;
        }

        .info-content p {
            color: #cbd5e1;
            line-height: 1.7;
            font-size: 15px;
            max-width: 380px;
        }

        /* Right side */

        .login-form-area {
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-heading {
            margin-bottom: 35px;
        }

        .form-heading .small-title {
            color: #16a34a;
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin-bottom: 10px;
        }

        .form-heading h2 {
            color: #0f172a;
            font-size: 30px;
            margin-bottom: 8px;
        }

        .form-heading p {
            color: #64748b;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #334155;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            height: 50px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            padding: 0 15px;
            font-size: 15px;
            color: #0f172a;
            outline: none;
            transition: 0.2s;
        }

        .form-group input:focus {
            border-color: #22c55e;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.12);
        }

        .login-button {
            width: 100%;
            height: 50px;
            border: none;
            border-radius: 10px;
            background: #16a34a;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
            margin-top: 5px;
        }

        .login-button:hover {
            background: #15803d;
            transform: translateY(-1px);
        }

        .error-message {
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            padding: 12px 14px;
            border-radius: 9px;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .back-link {
            text-align: center;
            margin-top: 25px;
        }

        .back-link a {
            color: #475569;
            text-decoration: none;
            font-size: 14px;
        }

        .back-link a:hover {
            color: #16a34a;
        }

        .security-note {
            text-align: center;
            color: #94a3b8;
            font-size: 12px;
            margin-top: 35px;
        }

        /* Mobile */

        @media (max-width: 800px) {

            .login-wrapper {
                grid-template-columns: 1fr;
                max-width: 500px;
            }

            .login-info {
                padding: 40px;
                min-height: 300px;
            }

            .brand {
                margin-bottom: 25px;
            }

            .brand h1 {
                font-size: 27px;
            }

            .info-content h2 {
                font-size: 24px;
            }

            .login-form-area {
                padding: 40px;
            }

        }

        @media (max-width: 450px) {

            body {
                padding: 12px;
            }

            .login-wrapper {
                border-radius: 18px;
            }

            .login-info {
                padding: 30px 25px;
            }

            .login-form-area {
                padding: 30px 25px;
            }

            .form-heading h2 {
                font-size: 26px;
            }

        }
    </style>

</head>

<body>

    <div class="login-wrapper">

        <!-- Left Section -->

        <div class="login-info">

            <div class="brand">

                <div class="brand-icon">
                    CF
                </div>

                <h1>CampusFound</h1>

                <p>
                    Lost & Found Management System
                </p>

            </div>

            <div class="info-content">

                <h2>
                    Welcome to the Admin Portal
                </h2>

                <p>
                    Manage users, lost item reports and found item reports
                    from one secure administration panel.
                </p>

            </div>

        </div>

        <!-- Login Form -->

        <div class="login-form-area">

            <div class="form-heading">

                <div class="small-title">
                    Administration
                </div>

                <h2>
                    Admin Login
                </h2>

                <p>
                    Sign in to access the CampusFound dashboard.
                </p>

            </div>

            <?php if ($error): ?>

                <div class="error-message">
                    <?php echo htmlspecialchars($error); ?>
                </div>

            <?php endif; ?>

            <form method="POST">

                <div class="form-group">

                    <label for="username">
                        Username
                    </label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Enter admin username"
                        required>

                </div>

                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter admin password"
                        required>

                </div>

                <button type="submit" class="login-button">
                    Sign In
                </button>

            </form>

            <div class="back-link">

                <a href="../index.php">
                    ← Back to CampusFound
                </a>

            </div>

            <div class="security-note">
                Secure administrator access
            </div>

        </div>

    </div>

</body>

</html>