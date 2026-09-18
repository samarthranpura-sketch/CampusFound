<?php

/** @var mysqli $conn */
session_start();

if (!isset($_SESSION["admin_id"])) {
    header("Location: admin-login.php");
    exit();
}

include "../database/database.php";

$success = "";
$error = "";

/* Delete lost item */
if (isset($_GET["delete"])) {

    $deleteId = intval($_GET["delete"]);

    $stmt = mysqli_prepare($conn, "DELETE FROM lost_items WHERE id = ?");

    if ($stmt) {

        mysqli_stmt_bind_param($stmt, "i", $deleteId);

        if (mysqli_stmt_execute($stmt)) {
            $success = "Lost item deleted successfully.";
        } else {
            $error = "Failed to delete lost item.";
        }

        mysqli_stmt_close($stmt);
    } else {
        $error = "Database query error.";
    }
}

/* Fetch lost items */
$sql = "
    SELECT 
        lost_items.id,
        lost_items.item_name,
        lost_items.category,
        lost_items.date_lost,
        lost_items.location,
        lost_items.status,
        users.fullname
    FROM lost_items
    LEFT JOIN users ON lost_items.user_id = users.id
    ORDER BY lost_items.id DESC
";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Lost Items - CampusFound</title>

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

        /* HEADER */
        .header {
            min-height: 72px;
            padding: 0 30px;
            background: var(--navy-dark);
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .header h1 {
            color: white;
            font-size: 22px;
            font-weight: 800;
        }

        .header a {
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

        .header a:hover {
            background: var(--green);
            border-color: var(--green);
        }

        /* MAIN CONTAINER */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 45px 20px 60px;
        }

        /* TOP BAR */
        .top-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 30px;
        }

        .top-bar h2 {
            color: var(--navy);
            font-size: 30px;
            font-weight: 800;
        }

        .back-btn {
            padding: 9px 16px;
            border: 1px solid var(--green);
            border-radius: 9px;
            background: var(--green);
            color: white;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            transition: 0.2s ease;
        }

        .back-btn:hover {
            background: var(--green-dark);
            border-color: var(--green-dark);
            transform: translateY(-1px);
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

        /* TABLE */
        .table-container {
            padding: 25px;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: var(--shadow);
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 850px;
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

        /* STATUS */
        .status {
            display: inline-block;
            padding: 5px 11px;
            border-radius: 20px;
            background: var(--red-light);
            color: var(--red);
            font-size: 12px;
            font-weight: 700;
        }

        /* DELETE BUTTON */
        .delete-btn {
            padding: 7px 13px;
            border: 1px solid var(--red);
            border-radius: 8px;
            background: var(--red-light);
            color: var(--red);
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .delete-btn:hover {
            background: var(--red);
            color: white;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {

            .header {
                min-height: 65px;
                padding: 0 15px;
            }

            .header h1 {
                font-size: 18px;
            }

            .container {
                padding: 35px 15px 45px;
            }

            .top-bar {
                align-items: flex-start;
                flex-direction: column;
            }

            .top-bar h2 {
                font-size: 27px;
            }

            .table-container {
                padding: 18px;
            }

            th,
            td {
                padding: 12px 10px;
            }

        }
    </style>

</head>

<body>

    <div class="header">

        <h1>CampusFound Admin Panel</h1>

        <a href="admin-logout.php">Logout</a>

    </div>

    <div class="container">

        <div class="top-bar">

            <h2>Manage Lost Items</h2>

            <a href="dashboard.php" class="back-btn">
                ← Back to Dashboard
            </a>

        </div>

        <?php if ($success): ?>

            <div class="message success">
                <?php echo htmlspecialchars($success); ?>
            </div>

        <?php endif; ?>

        <?php if ($error): ?>

            <div class="message error">
                <?php echo htmlspecialchars($error); ?>
            </div>

        <?php endif; ?>

        <div class="table-container">

            <table>

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Item Name</th>
                        <th>Category</th>
                        <th>Date Lost</th>
                        <th>Location</th>
                        <th>Reported By</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                    <?php if ($result && mysqli_num_rows($result) > 0): ?>

                        <?php while ($row = mysqli_fetch_assoc($result)): ?>

                            <tr>

                                <td>
                                    <?php echo htmlspecialchars($row["id"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row["item_name"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row["category"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row["date_lost"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row["location"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row["fullname"] ?? "Unknown"); ?>
                                </td>

                                <td>
                                    <span class="status">
                                        <?php echo htmlspecialchars($row["status"]); ?>
                                    </span>
                                </td>

                                <td>

                                    <button
                                        class="delete-btn"
                                        onclick="deleteItem(<?php echo $row['id']; ?>)">
                                        Delete
                                    </button>

                                </td>

                            </tr>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="8" style="text-align:center;">
                                No lost item reports found.
                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

    <script>
        function deleteItem(id) {

            if (confirm("Are you sure you want to delete this lost item?")) {

                window.location.href = "lost-items.php?delete=" + id;

            }

        }
    </script>
</body>

</html>

<?php
mysqli_close($conn);

?>