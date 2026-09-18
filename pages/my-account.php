<?php

/** @var mysqli $conn */
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

include "../database/database.php";

$userId = $_SESSION["user_id"];

$sql = "SELECT fullname, email FROM users WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $userId);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Account | CampusFound</title>

    <link rel="stylesheet" href="../css/login.css?v=3">

    <style>
        .account-card {
            width: 100%;
            max-width: 560px;
            background: #ffffff;
            padding: 42px;
            border-radius: 24px;
            border: 1px solid #e1ebe6;
            box-shadow: 0 15px 40px rgba(18, 59, 53, 0.08);
        }

        .account-profile {
            text-align: center;
            margin-bottom: 35px;
        }

        .account-avatar {
            width: 78px;
            height: 78px;
            margin: 0 auto 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #eaf8f1;
            color: #168653;
            font-size: 28px;
            font-weight: 800;
        }

        .account-profile h2 {
            margin: 0;
            color: #123b35;
            font-size: 28px;
        }

        .account-profile p {
            margin: 8px 0 0;
            color: #667875;
            font-size: 15px;
        }

        .account-info {
            margin-bottom: 28px;
        }

        .account-info-box {
            padding: 18px 20px;
            margin-bottom: 14px;
            background: #f7faf9;
            border: 1px solid #e4ece9;
            border-radius: 12px;
        }

        .account-info-box span {
            display: block;
            margin-bottom: 6px;
            color: #667875;
            font-size: 13px;
            font-weight: 600;
        }

        .account-info-box strong {
            color: #17322e;
            font-size: 16px;
            font-weight: 600;
        }

        .account-actions {
            display: flex;
            gap: 12px;
        }

        .account-actions a {
            flex: 1;
            display: block;
            padding: 13px 16px;
            border-radius: 9px;
            text-align: center;
            text-decoration: none;
            font-weight: 700;
        }

        .account-home {
            background: #20a66a;
            color: white;
        }

        .account-home:hover {
            background: #168653;
        }

        .account-logout {
            background: #ffffff;
            color: #168653;
            border: 1px solid #8fd7b6;
        }

        .account-logout:hover {
            background: #eaf8f1;
        }

        @media (max-width: 600px) {

            .account-card {
                padding: 30px 22px;
            }

            .account-actions {
                flex-direction: column;
            }

        }
    </style>

</head>

<body>

    <main class="login-page">

        <div class="account-card">

            <div class="account-profile">

                <div class="account-avatar">
                    <?php echo strtoupper(substr($user["fullname"], 0, 1)); ?>
                </div>

                <h2>My Account</h2>

                <p>Manage your CampusFound account.</p>

            </div>

            <div class="account-info">

                <div class="account-info-box">

                    <span>Full Name</span>

                    <strong>
                        <?php echo htmlspecialchars($user["fullname"]); ?>
                    </strong>

                </div>

                <div class="account-info-box">

                    <span>Email Address</span>

                    <strong>
                        <?php echo htmlspecialchars($user["email"]); ?>
                    </strong>

                </div>

            </div>

            <div class="account-actions">

                <a href="../index.php" class="account-home">
                    Back to Homepage
                </a>

                <a href="../php/logout.php" class="account-logout">
                    Logout
                </a>

            </div>

        </div>

    </main>

</body>

</html>