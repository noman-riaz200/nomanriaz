<?php
session_start();
include('includes/config.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $input = json_decode(file_get_contents('php://input'), true);
    $serviceId = $input['service_id'];

    // Get service details
    $stmt = $conn->prepare("SELECT * FROM services WHERE id = ?");
    $stmt->bind_param("i", $serviceId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $service = $result->fetch_assoc();
        
        // Initialize cart if not exists
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Check if service already in cart
        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $serviceId) {
                $item['quantity'] += 1;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $service['quantity'] = 1;
            $_SESSION['cart'][] = $service;
        }

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Service not found']);
    }
}


// <!-- In product/service listing page -->
if (isset($_SESSION['user_id'])): ?>
<button class="btn btn-primary add-to-cart" data-id="<?= $service['id'] ?>">Add to Cart</button>
<?php else: ?>
<button class="btn btn-primary require-login">Add to Cart</button>
<?php endif; 

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Login required']);
    exit;
}


?>

<script>
// Add to Cart with login check
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function() {
        // Existing add to cart logic
    });
});

document.querySelectorAll('.require-login').forEach(button => {
    button.addEventListener('click', function() {
        Swal.fire({
            icon: 'info',
            title: 'Login Required',
            text: 'Please login to add items to cart',
            showCancelButton: true,
            confirmButtonText: 'Login',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'login.php';
            }
        });
    });
});
</script>