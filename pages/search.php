<?php

/** @var mysqli $conn */
include "../database/database.php";

$search = trim($_GET["search"] ?? "");
$category = $_GET["category"] ?? "";

$searchTerm = "%" . $search . "%";

if ($category === "" || $category === "All Categories") {
    $categoryTerm = "%";
} else {
    $categoryTerm = $category;
}

$sql = "
    SELECT id, item_name, category, date_lost AS item_date,
           location, description, contact_number, image,
           'Lost' AS status
    FROM lost_items
    WHERE item_name LIKE ? AND category LIKE ?

    UNION ALL

    SELECT id, item_name, category, date_found AS item_date,
           location, description, contact_number, image,
           'Found' AS status
    FROM found_items
    WHERE item_name LIKE ? AND category LIKE ?

    ORDER BY item_date DESC
";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "ssss",
    $searchTerm,
    $categoryTerm,
    $searchTerm,
    $categoryTerm
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Items | CampusFound</title>
    <link rel="stylesheet" href="../css/search.css">
</head>

<body>

    <!-- Header -->
    <header>
        <nav class="navbar">

            <div class="logo">
                <a href="../index.php">CampusFound</a>
            </div>

            <div class="menu-toggle" id="menu-toggle">
                ☰
            </div>

            <ul class="nav-links">
                <li><a href="../index.php">Home</a></li>
                <li><a href="report-lost.php">Report Lost</a></li>
                <li><a href="report-found.php">Report Found</a></li>
                <li><a href="search.php" class="active">Search</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>

            <div class="nav-buttons">
                <a href="login.php" class="login-btn">Login</a>
                <a href="register.php" class="register-btn">Register</a>
            </div>

        </nav>
    </header>

    <!-- Report Lost Section -->

    <section class="report-section">

        <div class="report-card">

            <h1>Search Items</h1>
            <p class="subtitle">Search lost and found items across the campus.</p>

            <form method="GET" action="search.php">

                <div class="form-group">
                    <label>Item Name</label>
                    <input type="text" name="search" placeholder="Search by Item Name">
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select name="category">
                        <option>All Categories</option>
                        <option>Mobile Phone</option>
                        <option>Laptop</option>
                        <option>ID Card</option>
                        <option>Wallet</option>
                        <option>Bag</option>
                        <option>Books</option>
                        <option>Keys</option>
                        <option>Watch</option>
                        <option>Other</option>
                    </select>
                </div>
                <button type="submit" class="submit-btn">Search</button>
            </form>
        </div>
    </section>

    <div class="results">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="result-card">
                    <h3>
                        <?php echo htmlspecialchars($row["item_name"]); ?>
                    </h3>
                    <p>
                        <strong>Status:</strong>
                        <?php echo htmlspecialchars($row["status"]); ?>
                    </p>
                    <p>
                        <strong>Category:</strong>
                        <?php echo htmlspecialchars($row["category"]); ?>
                    </p>
                    <p>
                        <strong>Location:</strong>
                        <?php echo htmlspecialchars($row["location"]); ?>
                    </p>
                    <p>
                        <strong>Date:</strong>
                        <?php echo htmlspecialchars($row["item_date"]); ?>
                    </p>
                    <a href="item-details.php?id=<?php echo $row["id"]; ?>&status=<?php echo $row["status"]; ?>"
                        class="submit-btn">
                        View Details
                    </a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No lost or found items found.</p>
        <?php endif; ?>
    </div>

    <!-- Footer -->

    <footer>

        <h2>CampusFound</h2>
        <p>
            Helping students recover lost belongings quickly and easily.
        </p>

        <div class="footer-links">
            <a href="../index.php">Home</a>
            <a href="report-lost.php">Report Lost</a>
            <a href="report-found.php">Report Found</a>
            <a href="search.php">Search</a>
            <a href="contact.php">Contact</a>
        </div>
    </footer>

    <!-- Mobile Menu Script -->

    <script src="../js/main.js"></script>

</body>

</html>