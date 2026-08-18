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

    <link rel="stylesheet" href="../css/search.css">
</head>

<body>
    <section class="results">
        <div class="result-card">
            <h2>
                <?php echo htmlspecialchars($item["item_name"]); ?>
            </h2>
            <p>
                <strong>Status:</strong>
                <?php echo htmlspecialchars($status); ?>
            </p>
            <p>
                <strong>Category:</strong>
                <?php echo htmlspecialchars($item["category"]); ?>
            </p>
            <p>
                <strong>Location:</strong>
                <?php echo htmlspecialchars($item["location"]); ?>
            </p>
            <p>
                <strong>Date:</strong>
                <?php echo htmlspecialchars($item["item_date"]); ?>
            </p>
            <p>
                <strong>Description:</strong>
                <?php echo htmlspecialchars($item["description"]); ?>
            </p>
            <p>
                <strong>Contact Number:</strong>
                <?php echo htmlspecialchars($item["contact_number"]); ?>
            </p>
            <br>
            <a href="search.php" class="submit-btn">
                Back to Search
            </a>
        </div>

    </section>

</body>

</html>
