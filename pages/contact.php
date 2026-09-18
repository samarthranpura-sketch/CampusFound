<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contact Us | CampusFound</title>

    <link rel="stylesheet" href="../css/contact.css?v=2">
</head>

<body>

    <!-- NAVBAR -->
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

                <?php if (isset($_SESSION["user_id"])): ?>

                    <a href="my-account.php" class="login-btn">
                        My Account
                    </a>

                    <a href="../php/logout.php" class="register-btn">
                        Logout
                    </a>

                <?php else: ?>

                    <a href="login.php" class="login-btn">
                        Login
                    </a>

                    <a href="register.php" class="register-btn">
                        Register
                    </a>

                <?php endif; ?>

            </div>

        </nav>
    </header>

    <!-- CONTACT -->
    <main>
        <section class="contact-section">

            <div class="contact-container">

                <div class="contact-heading">
                    <span class="section-label">GET IN TOUCH</span>

                    <h1>How Can We Help?</h1>

                    <p>
                        Have a question or need help with CampusFound?
                        Send us a message and we'll be happy to assist.
                    </p>
                </div>

                <div class="contact-layout">

                    <div class="contact-info-card">

                        <span class="info-icon">CF</span>

                        <h2>Contact Information</h2>

                        <p class="info-intro">
                            Reach out to the CampusFound team for questions,
                            suggestions, or assistance.
                        </p>

                        <div class="info-item">
                            <span class="info-item-icon">📍</span>

                            <div>
                                <strong>Address</strong>
                                <p>ABC College Campus</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <span class="info-item-icon">📧</span>

                            <div>
                                <strong>Email</strong>
                                <p>support@campusfound.com</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <span class="info-item-icon">📞</span>

                            <div>
                                <strong>Phone</strong>
                                <p>+91 9876543210</p>
                            </div>
                        </div>

                    </div>

                    <div class="contact-form-card">

                        <h2>Send Us a Message</h2>

                        <p class="form-intro">
                            Fill out the form below and let us know how we can help.
                        </p>
                        <form>
                            <div class="form-row">

                                <div class="form-group">
                                    <label for="fullname">Full Name</label>

                                    <input
                                        type="text"
                                        id="fullname"
                                        placeholder="Enter your name"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email Address</label>

                                    <input
                                        type="email"
                                        id="email"
                                        placeholder="Enter your email"
                                        required>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="subject">Subject</label>

                                <input
                                    type="text"
                                    id="subject"
                                    placeholder="Enter subject">
                            </div>

                            <div class="form-group">
                                <label for="message">Message</label>

                                <textarea
                                    id="message"
                                    rows="6"
                                    placeholder="Write your message"></textarea>
                            </div>

                            <button type="submit" class="submit-btn">
                                Send Message
                                <span>→</span>
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <footer>

        <div class="footer-content">

            <div class="footer-brand">
                <h2>CampusFound</h2>

                <p>
                    Helping students recover lost belongings
                    quickly and easily.
                </p>
            </div>

            <div class="footer-links">
                <a href="../index.php">Home</a>
                <a href="report-lost.php">Report Lost</a>
                <a href="report-found.php">Report Found</a>
                <a href="search.php">Search</a>
                <a href="contact.php">Contact</a>
            </div>

        </div>

        <div class="footer-bottom">
            <p>© 2026 CampusFound. All rights reserved.</p>
        </div>

    </footer>
    <script src="../js/main.js"></script>
</body>

</html>