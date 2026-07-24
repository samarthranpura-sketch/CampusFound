<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Lost | CampusFound</title>

    <link rel="stylesheet" href="../css/report-lost.css">
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
                <li><a href="report-lost.php" class="active">Report Lost</a></li>
                <li><a href="report-found.php">Report Found</a></li>
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

            <h1>Report Lost Item</h1>

            <p class="subtitle">
                Lost something on campus? Fill out the details below to help others find your item.
            </p>

            <form action="#" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label>Item Name</label>
                    <input type="text" placeholder="Enter Item Name" required>
                </div>

                <div class="form-group">
                    <label>Category</label>

                    <select required>

                        <option value="">Select Category</option>

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

                <div class="form-group">
                    <label>Date Lost</label>
                    <input type="date" required>
                </div>

                <div class="form-group">
                    <label>Location</label>
                    <input type="text" placeholder="Example: Library, Classroom A-201" required>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea rows="5" placeholder="Describe your lost item..." required></textarea>
                </div>

                <div class="form-group">
                    <label>Upload Image</label>
                    <input type="file" accept="image/*">
                </div>

                <div class="form-group">
                    <label>Contact Number</label>
                    <input type="tel" placeholder="Enter Contact Number" required>
                </div>
                <button type="submit" class="submit-btn">Submit Report</button>
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

    <script>
        const menuToggle = document.getElementById("menu-toggle");
        const navLinks = document.querySelector(".nav-links");
        const navButtons = document.querySelector(".nav-buttons");

        menuToggle.addEventListener("click", () => {

            navLinks.classList.toggle("active");
            navButtons.classList.toggle("active");

        });
    </script>

</body>

</html>