<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Found | CampusFound</title>
    <link rel="stylesheet" href="../css/report-found.css">
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
                <li><a href="report-found.php" class="active">Report Found</a></li>
                <li><a href="search.php">Search</a></li>
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

            <h1>Report Found Item</h1>
            <p class="subtitle">Found an item on campus? Fill out the details below so the owner can claim it.</p>

            <form action="../php/report-found-process.php" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label>Item Name</label>
                    <input type="text" name="item_name" placeholder="Enter Item Name" required>
                </div>

                <div class="form-group">
                    <label>Category</label>

                    <select name="category" required>

                        <option value="">Select Category</option>
                        <option value="Mobile Phone">Mobile Phone</option>
                        <option value="Laptop">Laptop</option>
                        <option value="ID Card">ID Card</option>
                        <option value="Wallet">Wallet</option>
                        <option value="Bag">Bag</option>
                        <option value="Books">Books</option>
                        <option value="Keys">Keys</option>
                        <option value="Watch">Watch</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Date Found</label>
                    <input type="date" name="date_found" required>
                </div>

                <div class="form-group">
                    <label>Location Found</label>
                    <input type="text" name="location" placeholder="Example: Library, Classroom A-201" required>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="5" placeholder="Describe the item you found..." required></textarea>
                </div>

                <div class="form-group">
                    <label>Upload Image</label>
                    <input type="file" name="item_image" accept="image/*">
                </div>

                <div class="form-group">
                    <label>Contact Number</label>
                    <input type="tel" name="contact_number" placeholder="Enter Contact Number" required>
                </div>
                <button type="submit" class="submit-btn">Submit Found Item</button>
            </form>
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