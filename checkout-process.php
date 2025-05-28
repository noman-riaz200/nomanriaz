<?php
session_start();
include('includes/config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Validate cart and calculate total
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}

try {
    // Create order record first
    $userId = $_SESSION['user_id'];
    $stmt = $conn->prepare("INSERT INTO orders (user_id, total_amount, status, created_at) 
                           VALUES (?, ?, 'pending', NOW())");
    $stmt->bind_param("id", $userId, $total);
    $stmt->execute();
    $orderId = $conn->insert_id;

    // Initiate Payoneer payment
    $payoneerParams = [
        'payee_id' => 'YOUR_PAYONEER_ID',
        'amount' => $total,
        'currency' => 'USD',
        'description' => 'Order #'.$orderId,
        'return_url' => 'http://yourdomain.com/order-success.php',
        'cancel_url' => 'http://yourdomain.com/cart.php'
    ];

    // Redirect to Payoneer payment page
    $payoneerUrl = 'https://api.payoneer.com/v2/...?'.http_build_query($payoneerParams);
    header("Location: ".$payoneerUrl);
    exit;

} catch (Exception $e) {
    // Handle error
    $_SESSION['checkout_errors'] = ["Payment processing failed: " . $e->getMessage()];
    header('Location: cart.php');
    exit;
}