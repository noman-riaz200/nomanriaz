<?php
include('includes/config.php');
include('includes/header.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$userId = $_SESSION['user_id'];
$orders = $conn->query("SELECT * FROM orders WHERE user_id = $userId ORDER BY created_at DESC");
?>

<div class="container py-5">
    <h2>Order History</h2>
    
    <div class="row mt-4">
        <?php while($order = $orders->fetch_assoc()): ?>
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Order #<?= $order['id'] ?></h5>
                    <p class="card-text">
                        Total: $<?= number_format($order['total_amount'], 2) ?><br>
                        Date: <?= date('M d, Y H:i', strtotime($order['created_at'])) ?><br>
                        Status: <?= $order['status'] ?>
                    </p>
                    <a href="order-details.php?id=<?= $order['id'] ?>" class="btn btn-primary">
                        View Details
                    </a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include('includes/footer.php'); ?>