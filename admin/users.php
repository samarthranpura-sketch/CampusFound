<?php

/** @var mysqli $conn */
session_start();

if (!isset($_SESSION["admin_id"])) {
    header("Location: admin-login.php");
    exit();
}

include "../database/database.php";

$error = "";
$success = "";

/* DELETE USER */

if (isset($_GET["delete"])) {

    $userId = intval($_GET["delete"]);

    if ($userId > 0) {

        $stmt = mysqli_prepare($conn, "DELETE FROM users WHERE id = ?");

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "i", $userId);

            if (mysqli_stmt_execute($stmt)) {
                $success = "User deleted successfully.";
            } else {
                $error = "Unable to delete user.";
            }

            mysqli_stmt_close($stmt);
        } else {
            $error = "Database query error.";
        }
    }
}

/* ----GET USERS---- */

$userQuery = mysqli_query(
    $conn,
    "SELECT id, fullname, email, created_at
     FROM users
     ORDER BY id DESC"
);

if (!$userQuery) {
    die("Database query error: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Manage Users - CampusFound</title>

    <style>
        /* RESET */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        /* ROOT */

        :root {
            --green: #20a66a;
            --green-dark: #168653;
            --green-light: #eaf8f1;
            --navy: #123b35;
            --navy-dark: #0c2925;
            --text: #17322e;
            --text-light: #667875;
            --white: #ffffff;
            --background: #f7faf9;
            --border: #e4ece9;
            --red: #e05252;
            --red-light: #fff0f0;
            --shadow: 0 12px 30px rgba(18, 59, 53, 0.08);
        }


        /* BODY */

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: var(--background);
            color: var(--text);
        }


        /* NAVBAR */

        .navbar {
            min-height: 72px;
            padding: 0 30px;
            background: var(--navy-dark);
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .navbar h2 {
            color: white;
            font-size: 22px;
            font-weight: 800;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .back-btn,
        .logout-btn {
            padding: 9px 16px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: 0.2s ease;
        }

        .page-title-row {
            flex-wrap: wrap;
        }

        .page-title-row .back-btn {
            display: inline-block;
        }

        .back-btn:hover {
            background: var(--green);
            border-color: var(--green);
        }

        .logout-btn {
            color: white;
            background: var(--red);
            border: 1px solid var(--red);
        }

        .logout-btn:hover {
            background: #c63f3f;
            border-color: #c63f3f;
        }


        /* MAIN CONTAINER */

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 45px 20px 60px;
        }


        /* PAGE HEADER */

        .page-header {
            margin-bottom: 30px;
        }

        .page-title-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .page-title-row .back-btn {
            display: inline-block;
            color: white;
            background: var(--green);
            border: 1px solid var(--green);
        }

        .page-title-row .back-btn:hover {
            background: var(--green-dark);
            border-color: var(--green-dark);
        }

        .page-header h1 {
            margin-bottom: 8px;
            color: var(--navy);
            font-size: 32px;
            font-weight: 800;
        }

        .page-header p {
            color: var(--text-light);
            font-size: 15px;
        }


        /* MESSAGES */

        .message {
            padding: 14px 18px;
            margin-bottom: 20px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
        }

        .success {
            background: var(--green-light);
            color: var(--green-dark);
            border: 1px solid #c7ead9;
        }

        .error {
            background: var(--red-light);
            color: var(--red);
            border: 1px solid #f3cccc;
        }


        /* USERS TABLE */

        .table-card {
            padding: 25px;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: var(--shadow);
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 15px 12px;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        th {
            background: #f8fbfa;
            color: var(--text-light);
            font-size: 13px;
            font-weight: 700;
        }

        td {
            color: var(--text);
            font-size: 14px;
        }

        tbody tr {
            transition: 0.2s ease;
        }

        tbody tr:hover {
            background: #fbfdfc;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }


        /* DELETE BUTTON */

        .delete-btn {
            display: inline-block;
            padding: 7px 13px;
            border: 1px solid var(--red);
            border-radius: 8px;
            background: var(--red-light);
            color: var(--red);
            text-decoration: none;
            font-size: 12px;
            font-weight: 700;
            transition: 0.2s ease;
        }

        .delete-btn:hover {
            background: var(--red);
            color: white;
        }


        /* EMPTY */

        .empty {
            padding: 30px;
            color: var(--text-light);
            text-align: center;
        }


        /* RESPONSIVE */

        @media (max-width: 768px) {

            .navbar {
                min-height: 65px;
                padding: 0 15px;
            }

            .navbar h2 {
                font-size: 18px;
            }

            .page-title-row {
                flex-wrap: wrap;
            }

            .back-btn {
                display: inline-block;
            }

            .container {
                padding: 35px 15px 45px;
            }

            .page-header h1 {
                font-size: 27px;
            }

            .table-card {
                padding: 18px;
            }

            th,
            td {
                padding: 12px 10px;
                white-space: nowrap;
            }

        }
    </style>

</head>

<body>

    <!-- NAVBAR -->

    <div class="navbar">

        <h2>CampusFound Admin</h2>

        <div class="nav-right">

            <a
                href="admin-logout.php"
                class="logout-btn">
                Logout
            </a>

        </div>

    </div>


    <!-- MAIN CONTENT -->

    <div class="container">

        <div class="page-header">

            <div class="page-title-row">

                <h1>Manage Users</h1>

                <a
                    href="dashboard.php"
                    class="back-btn">
                    ← Back to Dashboard
                </a>

            </div>

            <p>
                View and manage registered CampusFound users.
            </p>

        </div>


        <!-- MESSAGES -->
        <?php if ($success !== ""): ?>
            <div class="message success">
                <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>


        <?php if ($error !== ""): ?>

            <div class="message error">
                <?php echo htmlspecialchars($error); ?>
            </div>

        <?php endif; ?>

        <!-- USERS TABLE -->

        <div class="table-card">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Registered On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (mysqli_num_rows($userQuery) > 0): ?>
                            <?php while ($user = mysqli_fetch_assoc($userQuery)): ?>
                                <tr>

                                    <td>
                                        <?php
                                        echo htmlspecialchars($user["id"]);
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo htmlspecialchars($user["fullname"]);
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo htmlspecialchars($user["email"]);
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo date(
                                            "d M Y",
                                            strtotime($user["created_at"])
                                        );
                                        ?>
                                    </td>

                                    <td>

                                        <a
                                            href="users.php?delete=<?php echo $user["id"]; ?>"
                                            class="delete-btn"
                                            onclick="return confirm('Are you sure you want to delete this user?');">
                                            Delete
                                        </a>

                                    </td>

                                </tr>

                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td
                                    colspan="5"
                                    class="empty">
                                    No registered users found.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>

<?php
mysqli_close($conn);
?>