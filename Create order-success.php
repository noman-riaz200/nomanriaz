<?php
include('includes/config.php');
include('includes/header.php');

if (!isset($_SESSION['order_success'])) {
    header('Location: cart.php');
    exit;
}

// Get the latest order for the user
$userId = $_SESSION['user_id'];
$order = $conn->query("SELECT * FROM orders WHERE user_id = $userId ORDER BY id DESC LIMIT 1")->fetch_assoc();

unset($_SESSION['order_success']);
?>

<div class="container py-5">
    <div class="alert alert-success text-center">
        <h4 class="alert-heading">Payment Successful!</h4>
        <p>Order ID: #<?= $order['id'] ?><br>
           Total Paid: $<?= number_format($order['total_amount'], 2) ?></p>
        <div class="mt-3">
            <a href="services.php" class="btn btn-primary">Browse More Services</a>
            <a href="order-history.php" class="btn btn-secondary">View Order History</a>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>