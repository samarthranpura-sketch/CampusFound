<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | CampusFound</title>
    <link rel="stylesheet" href="../css/contact.css">
</head>

<body>
    <!-- Navbar -->
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
                <li><a href="search.php">Search</a></li>
                <li><a href="contact.php" class="active">Contact</a></li>
            </ul>

            <div class="nav-buttons">
                <a href="login.php" class="login-btn">Login
                <a href="register.php" class="register-btn">Register</a>
            </div>
        </nav>
    </header>

    <!-- Contact -->
    <section class="contact-section">
        <section class="contact-section">

            <div class="contact-card">
                <h1>Contact Us</h1>
                <p class="subtitle">Have a question or need help? We'd love to hear from you.</p>

                <form>
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" placeholder="Enter your name" required>
                    </div>

                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" placeholder="Enter your email" required>
                    </div>

                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" placeholder="Enter subject">
                    </div>

                    <div class="form-group">
                        <label>Message</label>
                        <textarea rows="6" placeholder="Write your message"></textarea>
                    </div>

                    <button type="submit" class="submit-btn">
                        Send Message
                    </button>

                </form>

                <div class="contact-info">
                    <h2>Contact Information</h2>
                    <p><strong>📍 Address:</strong> ABC College Campus</p>
                    <p><strong>📧 Email:</strong> support@campusfound.com</p>
                    <p><strong>📞 Phone:</strong> +91 9876543210</p>
                </div>
            </div>

        </section>
    </section>

    <!-- Footer -->
    <footer>

        <h2>CampusFound</h2>
        <p>Helping students recover lost belongings quickly and easily.</p>

        <div class="footer-links">
            <a href="../index.php">Home</a>
            <a href="report-lost.php">Report Lost</a>
            <a href="report-found.php">Report Found</a>
            <a href="search.php">Search</a>
            <a href="contact.php">Contact</a>
        </div>
    </footer>

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