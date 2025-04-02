<?php
include 'includes/db.php';
include 'includes/navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="estilos/styles.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/scripts.js" defer></script>
<title>Terms of Service</title>
<style>
    body {
        background-color: #f8f9fa;
        color: #212529;
    }
    .hero {
        background-color: #007BFF;
        color: white;
        padding: 50px 0;
        text-align: center;
    }
    .hero h1 {
        font-size: 3rem;
        margin: 0;
    }
    .content {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    footer {
        background-color: #007BFF;
        color: white;
        padding: 15px 0;
        text-align: center;
    }
</style>
</head>
<body>
    <header class="hero">
        <h1>Terms of Service</h1>
    </header>
    <main class="container my-5">
        <div class="content">
            <p>Welcome to our reservation system. By using our services, you agree to the following terms and conditions:</p>
            
            <h2 class="text-primary">1. Reservations</h2>
            <p>All reservations are subject to availability. We reserve the right to cancel or modify reservations at any time.</p>
            
            <h2 class="text-primary">2. User Responsibilities</h2>
            <p>You are responsible for providing accurate information during the reservation process. Any false or misleading information may result in the cancellation of your reservation.</p>
            
            <h2 class="text-primary">3. Payments</h2>
            <p>All payments must be made in accordance with the payment terms specified during the reservation process. Failure to make timely payments may result in the cancellation of your reservation.</p>
            
            <h2 class="text-primary">4. Cancellations and Refunds</h2>
            <p>Cancellations and refunds are subject to our cancellation policy. Please review the policy carefully before making a reservation.</p>
            
            <h2 class="text-primary">5. Limitation of Liability</h2>
            <p>We are not responsible for any damages, losses, or inconveniences caused by the use of our reservation system.</p>
            
            <h2 class="text-primary">6. Changes to Terms</h2>
            <p>We reserve the right to update or modify these terms of service at any time without prior notice. Please review these terms periodically for changes.</p>
            
            <p>By using our reservation system, you acknowledge that you have read, understood, and agreed to these terms of service.</p>
        </div>
    </main>
    <footer>
        <p>&copy; <?php echo date('Y'); ?> Reservation System. All rights reserved.</p>
    </footer>
</body>
</html>
