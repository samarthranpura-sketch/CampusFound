<?php

/** @var mysqli $conn */
session_start();

if (!isset($_SESSION["admin_id"])) {
    header("Location: admin-login.php");
    exit();
}

include "../database/database.php";

/*DASHBOARD STATISTICS */

$userQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users");
$userData = mysqli_fetch_assoc($userQuery);
$totalUsers = $userData["total"];

$lostQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM lost_items");
$lostData = mysqli_fetch_assoc($lostQuery);
$totalLost = $lostData["total"];

$foundQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM found_items");
$foundData = mysqli_fetch_assoc($foundQuery);
$totalFound = $foundData["total"];

$totalReports = $totalLost + $totalFound;


/* RECENT REPORTS */

$recentReportsQuery = mysqli_query(
    $conn,
    "SELECT
        id,
        item_name,
        category,
        location,
        created_at,
        'Lost' AS report_type
     FROM lost_items

     UNION ALL

     SELECT
        id,
        item_name,
        category,
        location,
        created_at,
        'Found' AS report_type
     FROM found_items

     ORDER BY created_at DESC
     LIMIT 5"
);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard - CampusFound</title>

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
            font-size: 22px;
            font-weight: 800;
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .admin-info span {
            font-size: 14px;
            color: #c7d8d3;
        }

        .logout-btn {
            padding: 9px 16px;
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 9px;
            background: transparent;
            color: white;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            transition: 0.2s ease;
        }

        .logout-btn:hover {
            background: var(--green);
            border-color: var(--green);
        }


        /* MAIN CONTAINER */

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 45px 20px 60px;
        }


        /* WELCOME */

        .welcome {
            margin-bottom: 30px;
        }

        .welcome h1 {
            margin-bottom: 8px;
            color: var(--navy);
            font-size: 32px;
            font-weight: 800;
        }

        .welcome p {
            color: var(--text-light);
            font-size: 15px;
        }


        /* STATISTICS */

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            padding: 24px;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: var(--shadow);
        }

        .stat-card h3 {
            margin-bottom: 12px;
            color: var(--text-light);
            font-size: 14px;
            font-weight: 700;
        }

        .stat-card .number {
            color: var(--navy);
            font-size: 32px;
            font-weight: 800;
        }


        /* RECENT REPORTS */

        .dashboard-section {
            padding: 25px;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: var(--shadow);
        }

        .dashboard-section h2 {
            margin-bottom: 20px;
            color: var(--navy);
            font-size: 21px;
            font-weight: 800;
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
            padding: 14px 12px;
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

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background: #fbfdfc;
        }


        /* STATUS BADGES */

        .badge {
            display: inline-block;
            padding: 5px 11px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .lost {
            background: var(--red-light);
            color: var(--red);
        }

        .found {
            background: var(--green-light);
            color: var(--green-dark);
        }

        .empty {
            padding: 25px;
            color: var(--text-light);
            text-align: center;
        }


        /* MANAGEMENT */

        .management {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 25px;
        }

        .management a {
            padding: 17px;
            border: 1px solid var(--green);
            border-radius: 10px;
            background: var(--green);
            color: white;
            text-align: center;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            transition: 0.2s ease;
        }

        .management a:hover {
            background: var(--green-dark);
            border-color: var(--green-dark);
            transform: translateY(-2px);
        }


        /* RESPONSIVE */

        @media (max-width: 768px) {

            .navbar {
                padding: 0 18px;
            }

            .navbar h2 {
                font-size: 19px;
            }

            .admin-info span {
                display: none;
            }

            .container {
                padding: 35px 15px 45px;
            }

            .welcome h1 {
                font-size: 27px;
            }

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .dashboard-section {
                padding: 20px;
            }

            .management {
                grid-template-columns: 1fr;
            }

        }
    </style>

</head>

<body>

    <!-- NAVBAR -->

    <div class="navbar">

        <h2>CampusFound Admin</h2>

        <div class="admin-info">

            <span>
                Logged in as:
                <?php echo htmlspecialchars($_SESSION["admin_username"]); ?>
            </span>

            <a href="admin-logout.php" class="logout-btn">
                Logout
            </a>

        </div>

    </div>


    <!-- MAIN CONTENT -->

    <div class="container">

        <div class="welcome">

            <h1>Admin Dashboard</h1>

            <p>
                Monitor and manage the CampusFound platform.
            </p>

        </div>


        <!-- STATISTICS -->

        <div class="stats">

            <div class="stat-card">

                <h3>Total Users</h3>

                <div class="number">
                    <?php echo $totalUsers; ?>
                </div>

            </div>


            <div class="stat-card">

                <h3>Lost Reports</h3>

                <div class="number">
                    <?php echo $totalLost; ?>
                </div>

            </div>


            <div class="stat-card">

                <h3>Found Reports</h3>

                <div class="number">
                    <?php echo $totalFound; ?>
                </div>

            </div>


            <div class="stat-card">

                <h3>Total Reports</h3>

                <div class="number">
                    <?php echo $totalReports; ?>
                </div>

            </div>

        </div>


        <!-- RECENT REPORTS -->

        <div class="dashboard-section">

            <h2>Recent Reports</h2>

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>
                            <th>Item</th>
                            <th>Category</th>
                            <th>Location</th>
                            <th>Type</th>
                            <th>Date</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php if (mysqli_num_rows($recentReportsQuery) > 0): ?>

                            <?php while ($report = mysqli_fetch_assoc($recentReportsQuery)): ?>

                                <tr>

                                    <td>
                                        <?php echo htmlspecialchars($report["item_name"]); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($report["category"]); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($report["location"]); ?>
                                    </td>

                                    <td>

                                        <?php if ($report["report_type"] === "Lost"): ?>

                                            <span class="badge lost">
                                                Lost
                                            </span>

                                        <?php else: ?>

                                            <span class="badge found">
                                                Found
                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    <td>
                                        <?php echo date("d M Y", strtotime($report["created_at"])); ?>
                                    </td>

                                </tr>

                            <?php endwhile; ?>

                        <?php else: ?>

                            <tr>

                                <td colspan="5" class="empty">
                                    No reports available yet.
                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>


        <!-- MANAGEMENT -->

        <div class="management">

            <a href="users.php">
                Manage Users
            </a>

            <a href="lost-items.php">
                Manage Lost Items
            </a>

            <a href="found-items.php">
                Manage Found Items
            </a>

        </div>

    </div>

</body>

</html>