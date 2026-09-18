<?php

session_start();

include "database/database.php";

/* Get the 3 most recent lost and found reports */

$sql = "
    SELECT
        id,
        item_name,
        category,
        date_lost AS item_date,
        location,
        image,
        'Lost' AS report_type
    FROM lost_items

    UNION ALL

    SELECT
        id,
        item_name,
        category,
        date_found AS item_date,
        location,
        image,
        'Found' AS report_type
    FROM found_items

    ORDER BY item_date DESC
    LIMIT 3
";

$recentResult = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CampusFound - Lost & Found</title>

    <!-- CSS cache version -->
    <link rel="stylesheet" href="css/home.css?v=6">
</head>

<body>

    <!-- NAVBAR -->
    <header class="site-header">
        <nav class="navbar">

            <a href="index.php" class="logo">
                Campus<span>Found</span>
            </a>

            <button class="menu-toggle" id="menu-toggle" aria-label="Open menu">
                ☰
            </button>

            <ul class="nav-links">

                <li>
                    <a href="index.php" class="active">Home</a>
                </li>

                <li>
                    <a href="pages/report-lost.php">Report Lost</a>
                </li>

                <li>
                    <a href="pages/report-found.php">Report Found</a>
                </li>

                <li>
                    <a href="pages/search.php">Search</a>
                </li>

                <li>
                    <a href="pages/contact.php">Contact</a>
                </li>

            </ul>

            <div class="nav-buttons">

                <?php if (isset($_SESSION["user_id"])): ?>

                    <a href="pages/my-account.php" class="login-btn">
                        My Account
                    </a>

                    <a href="php/logout.php" class="register-btn">
                        Logout
                    </a>

                <?php else: ?>

                    <a href="pages/login.php" class="login-btn">
                        Login
                    </a>

                    <a href="pages/register.php" class="register-btn">
                        Register
                    </a>

                <?php endif; ?>

            </div>

        </nav>
    </header>

    <!--HERO SECTION-->
    <main>
        <section class="hero">

            <div class="hero-content">

                <div class="hero-badge">
                    🎓 Made for Campus
                </div>

                <h1>
                    Lost Something?
                    <span>We'll Help You Find It.</span>
                </h1>

                <p>
                    CampusFound makes it simple for students to report
                    lost and found items and reconnect belongings with
                    their rightful owners.
                </p>

                <div class="hero-buttons">

                    <a href="pages/report-lost.php" class="primary-btn">
                        Report Lost Item<span>→</span>
                    </a>

                    <a href="pages/report-found.php" class="secondary-btn">
                        Report Found Item <span>→</span>
                    </a>

                </div>

                <div class="hero-trust">

                    <div class="trust-item">
                        <strong>Easy</strong>
                        <span>to use</span>
                    </div>

                    <div class="trust-divider"></div>

                    <div class="trust-item">
                        <strong>Secure</strong>
                        <span>platform</span>
                    </div>

                    <div class="trust-divider"></div>

                    <div class="trust-item">
                        <strong>Campus</strong>
                        <span>focused</span>
                    </div>

                </div>

            </div>

            <div class="hero-visual">

                <div class="hero-circle circle-one"></div>
                <div class="hero-circle circle-two"></div>

                <div class="hero-card">

                    <div class="hero-card-icon">
                        🔎
                    </div>

                    <div>
                        <span>Looking for something?</span>
                        <strong>Let's find it.</strong>
                    </div>

                </div>

                <img
                    src="images/hero.svg"
                    alt="CampusFound Lost and Found Illustration">

                <div class="floating-card floating-card-one">
                    <span class="floating-icon green-icon">✓</span>
                    <div>
                        <strong>Item Found</strong>
                        <small>Ready to be claimed</small>
                    </div>
                </div>

                <div class="floating-card floating-card-two">
                    <span class="floating-icon red-icon">!</span>
                    <div>
                        <strong>Lost Item</strong>
                        <small>Looking for its owner</small>
                    </div>
                </div>

            </div>

        </section>

        <!--SEARCH CTA -->
        <section class="search-section">

            <div class="search-container">

                <div class="search-text">

                    <span class="section-label">FIND YOUR BELONGINGS</span>

                    <h2>Looking for a lost item?</h2>

                    <p>Search through reported lost and found items
                        from your campus.</p>
                </div>

                <form method="GET" action="pages/search.php" class="search-box">

                    <span class="search-icon">⌕</span>
                    <input
                        type="text"
                        name="search"
                        class="search-placeholder"
                        placeholder="Search for an item...">

                    <button type="submit" class="search-arrow">→</button>
                </form>

            </div>
        </section>

        <!-- RECENT LOST & FOUND -->
        <section class="recent-items">
            <div class="section-heading">
                <span class="section-label">RECENT REPORTS</span>
                <h2>Recent Lost & Found</h2>
                <p>See the latest items reported on campus.</p>
            </div>

            <div class="recent-items-grid">
                <?php if ($recentResult && mysqli_num_rows($recentResult) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($recentResult)): ?>
                        <div class="recent-item-card">
                            <div class="recent-item-image">
                                <?php if (!empty($row["image"])): ?>
                                    <img
                                        src="<?php echo htmlspecialchars($row["image"]); ?>"
                                        alt="<?php echo htmlspecialchars($row["item_name"]); ?>">
                                <?php else: ?>
                                    <div class="recent-no-image">
                                        No Image
                                    </div>
                                <?php endif; ?>

                            </div>

                            <div class="recent-item-content">

                                <div class="recent-item-top">

                                    <h3>
                                        <?php echo htmlspecialchars($row["item_name"]); ?>
                                    </h3>

                                    <span class="recent-status <?php echo strtolower($row["report_type"]); ?>">
                                        <?php echo htmlspecialchars($row["report_type"]); ?>
                                    </span>

                                </div>

                                <p>
                                    <strong>Category:</strong>
                                    <?php echo htmlspecialchars($row["category"]); ?>
                                </p>

                                <p>
                                    <strong>Location:</strong>
                                    <?php echo htmlspecialchars($row["location"]); ?>
                                </p>

                                <a
                                    href="pages/item-details.php?id=<?php echo $row["id"]; ?>&status=<?php echo $row["report_type"]; ?>"
                                    class="recent-view-btn">
                                    View Details →
                                </a>

                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="recent-empty">
                        No lost or found reports yet.
                    </p>
                <?php endif; ?>
            </div>
            <div class="recent-items-action">
                <a href="pages/search.php" class="recent-all-btn">
                    View All Lost & Found →
                </a>
            </div>
        </section>

        <!--HOW IT WORKS -->
        <section class="how-it-works">

            <div class="section-heading">

                <span class="section-label">SIMPLE PROCESS</span>

                <h2>How CampusFound Works</h2>

                <p>Getting your belongings back is easier than ever.</p>

            </div>

            <div class="steps">

                <div class="step-card">

                    <div class="step-number">01</div>

                    <div class="step-icon">📢</div>

                    <h3>Report Lost</h3>

                    <p>Lost something on campus?
                        Submit the details so others can help you find it.</p>

                    <a href="pages/report-lost.php"> Report an item →</a>

                </div>

                <div class="step-card featured-step">

                    <div class="step-number"> 02 </div>

                    <div class="step-icon">🤝</div>

                    <h3> Report Found</h3>

                    <p>Found someone's belongings?
                        Report them and help reconnect them with their owner.</p>

                    <a href="pages/report-found.php">Report found item →</a>

                </div>

                <div class="step-card">

                    <div class="step-number"> 03 </div>
                    <div class="step-icon"> 🔍</div>

                    <h3>Find & Claim </h3>

                    <p>Search reported items, view their details,
                        and contact the person who found them.</p>

                    <a href="pages/search.php">Search items →</a>

                </div>

            </div>
        </section>

        <!--WHY CHOOSE CAMPUSFOUND-->
        <section class="why-choose">

            <div class="section-heading">

                <span class="section-label">
                    WHY CAMPUSFOUND
                </span>

                <h2>
                    Built for Your Campus
                </h2>

                <p>
                    A simple and reliable way to manage lost and found
                    belongings within your college community.
                </p>

            </div>

            <div class="choose-container">

                <div class="choose-card">

                    <div class="choose-icon">
                        ⚡
                    </div>

                    <h3>
                        Easy to Use
                    </h3>

                    <p>
                        Simple forms and a clean interface make
                        reporting items quick and straightforward.
                    </p>

                </div>

                <div class="choose-card">

                    <div class="choose-icon">
                        🔒
                    </div>

                    <h3>
                        Secure Platform
                    </h3>

                    <p>
                        User accounts keep reports organized and
                        provide a secure way to manage information.
                    </p>

                </div>

                <div class="choose-card">

                    <div class="choose-icon">
                        🎓
                    </div>

                    <h3>
                        Made for Campus
                    </h3>

                    <p>
                        CampusFound is designed specifically to
                        help students and college communities.
                    </p>

                </div>

            </div>
        </section>

        <!--STATS -->
        <section class="stats-section">

            <div class="stats-container">

                <div class="stat-item">
                    <strong>01</strong>
                    <span>Simple Platform</span>
                </div>

                <div class="stat-item">
                    <strong>24/7</strong>
                    <span>Access to Reports</span>
                </div>

                <div class="stat-item">
                    <strong>100%</strong>
                    <span>Campus Focused</span>
                </div>

                <div class="stat-item">
                    <strong>1</strong>
                    <span>Goal — Reconnect Items</span>
                </div>

            </div>
        </section>
    </main>

    <!--FOOTER -->
    <footer class="site-footer">

        <div class="footer-container">
            <div class="footer-brand">
                <a href="index.php" class="footer-logo">
                    Campus<span>Found</span>
                </a>

                <p>
                    Helping students recover lost belongings
                    quickly and easily.
                </p>

            </div>

            <div class="footer-links-group">

                <h3>
                    Quick Links
                </h3>
                <a href="index.php">Home</a>
                <a href="pages/report-lost.php">Report Lost</a>
                <a href="pages/report-found.php">Report Found</a>
                <a href="pages/search.php">Search</a>

            </div>

            <div class="footer-links-group">

                <h3>
                    Account
                </h3>

                <a href="pages/login.php">Login</a>
                <a href="pages/register.php">Register</a>
                <a href="pages/contact.php">Contact Us</a>

            </div>

            <div class="footer-description">

                <h3>
                    CampusFound
                </h3>

                <p>
                    A campus-focused Lost & Found Management System
                    built to make recovering belongings easier.
                </p>

            </div>

        </div>

        <div class="footer-bottom">

            <p>
                © 2026 CampusFound. All rights reserved.
            </p>

            <a href="admin/admin-login.php">
                Admin Login
            </a>

        </div>
    </footer>
    <script src="js/main.js"></script>
</body>

</html>