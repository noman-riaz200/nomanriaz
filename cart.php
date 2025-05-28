<?php
include('includes/config.php');
include('includes/header.php');
// session_start(); 












?>

<style>
    .cart-item {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        padding: 20px;
    }
    .quantity-controls button {
        width: 40px;
        height: 40px;
        border: none;
        background: var(--gradient);
        color: white;
        border-radius: 50%;
    }
    .quantity-display {
        font-size: 1.2rem;
        margin: 0 15px;
    }
    .total-section {
        background: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
</style>

<div class="container py-5">
    <h2 class="mb-4 display-5">Your Cart</h2>
    
    <div class="row">
        <div class="col-lg-8">
            <?php if (!empty($_SESSION['cart'])): ?>
                <?php foreach ($_SESSION['cart'] as $item): ?>
                <div class="cart-item">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h4><?= $item['title'] ?></h4>
<span class="category-badge"><?php echo htmlspecialchars($service['category'] ?? ''); ?></span>                        </div>
                        <div class="col-md-6 text-md-right">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="quantity-controls">
                                    <button class="decrease-quantity" data-id="<?= $item['id'] ?>">-</button>
                                    <span class="quantity-display"><?= $item['quantity'] ?></span>
                                    <button class="increase-quantity" data-id="<?= $item['id'] ?>">+</button>
                                </div>
                                <div class="ml-3">
                                    <h5 class="mb-0">$<?= number_format($item['price'] * $item['quantity'], 2) ?></h5>
                                    <small>$<?= $item['price'] ?> per unit</small>
                                </div>
                                <button class="btn btn-danger ml-3 remove-item" data-id="<?= $item['id'] ?>">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-info">Your cart is empty</div>
            <?php endif; ?>
        </div>
        
        <div class="col-lg-4">
            <div class="total-section">
                <h4 class="mb-4">Cart Summary</h4>
                <?php 
                $total = 0;
                if (!empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $item) {
                        $total += $item['price'] * $item['quantity'];
                    }
                }
                ?>
                <div class="d-flex justify-content-between mb-3">
                    <span>Subtotal:</span>
                    <span>$<?= number_format($total, 2) ?></span>
                </div>
                <button class="btn btn-primary btn-block mt-4" style="background: var(--gradient);">
                    Proceed to Checkout
                </button>
            </div>
        </div>
    </div>
</div>
















<script>
document.querySelectorAll('.quantity-controls button, .remove-item').forEach(button => {
    button.addEventListener('click', function() {
        const serviceId = this.dataset.id;
        const action = this.classList.contains('increase-quantity') ? 'increase' :
                     this.classList.contains('decrease-quantity') ? 'decrease' : 
                     'remove';

        fetch('update-cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                service_id: serviceId,
                action: action
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload(); // Refresh the page to update values
            }
        });
    });
});
</script>


<!-- /*checkout model */ -->
<!-- Checkout Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Payment Information</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="checkoutForm" method="POST" action="checkout-process.php">
                <div class="modal-body">
                    <?php if (!empty($_SESSION['checkout_errors'])): ?>
                        <div class="alert alert-danger">
                            <?php foreach ($_SESSION['checkout_errors'] as $error): ?>
                                <p class="mb-1"><?= $error ?></p>
                            <?php endforeach; ?>
                        </div>
                        <?php unset($_SESSION['checkout_errors']); ?>
                    <?php endif; ?>

                    <div class="form-group">
                        <label>Cardholder Name</label>
                        <input type="text" name="cardholder_name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Card Number</label>
                        <input type="text" name="card_number" class="form-control" 
                               pattern="\d{16}" placeholder="4242424242424242" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Expiry Date</label>
                                <div class="row">
                                    <div class="col">
                                        <input type="text" name="expiry_month" 
                                              class="form-control" placeholder="MM" 
                                              pattern="\d{2}" required>
                                    </div>
                                    <div class="col">
                                        <input type="text" name="expiry_year" 
                                              class="form-control" placeholder="YY" 
                                              pattern="\d{2}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>CVC</label>
                                <input type="text" name="cvc" class="form-control" 
                                      pattern="\d{3}" placeholder="123" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Complete Payment</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Update checkout button in cart.php
document.querySelector('.proceed-checkout').addEventListener('click', function(e) {
    e.preventDefault();
    $('#checkoutModal').modal('show');
});
</script>

<!-- /*checkout model */ -->

<?php include('includes/footer.php'); ?>