<?php
include 'includes/db.php';
include 'includes/navbar.php';

// Privacy Policy for Reservation System
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" href="estilos/bootstrap.min.css">
    <link rel="stylesheet" href="estilos/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js" defer></script>
    <title>Privacy Policy</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        header {
            background-color: #007BFF;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
        header h1 {
            margin: 0;
            font-size: 2.5em;
        }
        main {
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #007BFF;
            margin-top: 20px;
        }
        ul {
            padding-left: 20px;
        }
        ul li {
            margin-bottom: 10px;
        }
        p {
            margin-bottom: 15px;
        }
        footer {
            text-align: center;
            padding: 10px 0;
            background-color: #007BFF;
            color: #fff;
            margin-top: 20px;
        }
        footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>Privacy Policy</h1>
    </header>
    <main>
        <p>Welcome to our Reservation System. Your privacy is important to us. This privacy policy explains how we collect, use, and protect your personal information.</p>

        <h2>Information We Collect</h2>
        <ul>
            <li>Personal Information: Name, email address, phone number, and other details provided during the reservation process.</li>
            <li>Usage Data: Information about how you use our website, including IP address, browser type, and access times.</li>
        </ul>

        <h2>How We Use Your Information</h2>
        <ul>
            <li>To process and manage your reservations.</li>
            <li>To communicate with you regarding your bookings or inquiries.</li>
            <li>To improve our website and services.</li>
        </ul>

        <h2>Sharing Your Information</h2>
        <p>We do not sell or share your personal information with third parties, except as required by law or to fulfill your reservation requests.</p>

        <h2>Data Security</h2>
        <p>We implement appropriate security measures to protect your personal information from unauthorized access, alteration, or disclosure.</p>

        <h2>Your Rights</h2>
        <p>You have the right to access, update, or delete your personal information. Please contact us if you wish to exercise these rights.</p>

        <h2>Changes to This Policy</h2>
        <p>We may update this privacy policy from time to time. Please review this page periodically for any changes.</p>

        <h2>Contact Us</h2>
        <p>If you have any questions about this privacy policy, please contact us at <a href="mailto:support@reservationsystem.com">support@reservationsystem.com</a>.</p>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Reservation System. All rights reserved.</p>
    </footer>
</body>
</html>