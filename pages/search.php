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

            <form>
                <div class="form-group">
                    <label>Item Name</label>
                    <input type="text" placeholder="Search by Item Name">
                </div>

                <div class="form-group">
                    <label>Category</label>
                    <select>
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
    </section>

    <section class="results">

        <h2>Search Results</h2>
        <div class="result-card">

            <h3>📱 iPhone 13</h3>
            <p><strong>Status:</strong> Lost</p>
            <p><strong>Location:</strong> Library</p>
            <p><strong>Date:</strong> 12/05/2026</p>

            <button class="submit-btn">View Details</button>
        </div>

        <div class="result-card">

            <h3>🎒 Black Backpack</h3>
            <p><strong>Status:</strong> Found</p>
            <p><strong>Location:</strong> Canteen</p>
            <p><strong>Date:</strong> 14/05/2026</p>

            <button class="submit-btn">View Details</button>
        </div>
    </section>

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