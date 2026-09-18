<?php

/** @var mysqli $conn */
include "../database/database.php";

$id = $_GET["id"] ?? "";
$status = $_GET["status"] ?? "";

if ($id === "" || ($status !== "Lost" && $status !== "Found")) {
    die("Invalid item.");
}

if ($status === "Lost") {

    $sql = "SELECT item_name, category, date_lost AS item_date,
                   location, description, contact_number, image
            FROM lost_items
            WHERE id = ?";
} else {

    $sql = "SELECT item_name, category, date_found AS item_date,
                   location, description, contact_number, image
            FROM found_items
            WHERE id = ?";
}

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$item = mysqli_fetch_assoc($result);

if (!$item) {
    die("Item not found.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Item Details | CampusFound</title>

    <link rel="stylesheet" href="../css/search.css?v=3">
</head>

<body>

    <main class="item-details-page">

        <div class="item-details-container">

            <a href="search.php" class="back-link">
                ← Back to Search
            </a>

            <div class="item-details-card">

                <div class="item-details-header">

                    <div>
                        <span class="status-badge <?php echo strtolower($status); ?>">
                            <?php echo htmlspecialchars($status); ?>
                        </span>

                        <h1>
                            <?php echo htmlspecialchars($item["item_name"]); ?>
                        </h1>

                        <p class="item-subtitle">
                            Item details and contact information
                        </p>
                    </div>

                </div>

                <div class="item-details-content">

                    <div class="item-details-image">

                        <?php if (!empty($item["image"])): ?>

                            <img
                                src="../<?php echo htmlspecialchars($item["image"]); ?>"
                                alt="<?php echo htmlspecialchars($item["item_name"]); ?>">

                        <?php else: ?>

                            <div class="no-item-image">
                                No Image Available
                            </div>

                        <?php endif; ?>

                    </div>

                    <div class="item-information">

                        <div class="info-row">
                            <span class="info-label">Category</span>
                            <span class="info-value">
                                <?php echo htmlspecialchars($item["category"]); ?>
                            </span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">
                                <?php echo $status === "Lost" ? "Location Lost" : "Location Found"; ?>
                            </span>
                            <span class="info-value">
                                <?php echo htmlspecialchars($item["location"]); ?>
                            </span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">
                                <?php echo $status === "Lost" ? "Date Lost" : "Date Found"; ?>
                            </span>
                            <span class="info-value">
                                <?php echo htmlspecialchars($item["item_date"]); ?>
                            </span>
                        </div>

                        <div class="description-box">
                            <span class="info-label">Description</span>

                            <p>
                                <?php echo htmlspecialchars($item["description"]); ?>
                            </p>
                        </div>

                        <div class="contact-box">
                            <div>
                                <span class="contact-label">
                                    Contact Number
                                </span>

                                <strong>
                                    <?php echo htmlspecialchars($item["contact_number"]); ?>
                                </strong>
                            </div>

                            <span class="contact-icon"> ☎</span>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>