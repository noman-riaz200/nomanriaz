<?php
include('includes/config.php');
include('includes/header.php');

// Fetch all services
$result = $conn->query("SELECT * FROM services");
?>

<style>
    :root {
        --primary-color: #2A2A72;
        --secondary-color: #009FFD;
        --gradient: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    }

    .service-card {
        border: none;
        border-radius: 15px;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }

    .service-icon {
        font-size: 2.5rem;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .price-tag {
        font-size: 1.75rem;
        color: var(--primary-color);
        font-weight: 700;
        margin: 1rem 0;
    }

    .category-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: var(--gradient);
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
    }

    .toast-notification {
        position: fixed;
        bottom: 20px;
        right: 20px;
        min-width: 250px;
        background: var(--gradient);
        color: white;
        border-radius: 10px;
        padding: 1rem;
        display: none;
        z-index: 1000;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
</style>

<div class="container py-5">
    <h2 class="text-center mb-5 display-4">Our Premium Services</h2>
    
    <div class="row">
        <?php while($service = $result->fetch_assoc()): ?>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="service-card">
                <div class="card-body position-relative p-4">
                  <span class="category-badge"><?php echo htmlspecialchars($service['category'] ?? ''); ?></span>
                  
                    <!-- Service Icon -->
                    <div class="text-center">
                        <i class="fas <?= $service['icon'] ?> service-icon"></i>
                    </div>
                    
                    <!-- Service Details -->
                    <h3 class="h4 card-title text-center mb-3"><?= $service['title'] ?></h3>
                    <p class="card-text text-muted text-center mb-4"><?= $service['description'] ?></p>
                    
                    <!-- Pricing -->
                    <div class="text-center">
                        <div class="price-tag">
                            <span class="small">Starting at</span><br>
                            $<?= $service['price'] ?>
                        </div>
                    </div>
                    
                    <!-- Action Button -->
                    <div class="text-center mt-3">
                        <button class="btn btn-lg btn-primary add-to-cart" 
                                data-id="<?= $service['id'] ?>"
                                style="background: var(--gradient); border: none;">
                            <i class="fas fa-cart-plus mr-2"></i>Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<!-- Toast Notification -->
<div class="toast-notification">
    <i class="fas fa-check-circle mr-2"></i>
    <span class="message">Service added to cart!</span>
</div>

<script>
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function() {
        const serviceId = this.dataset.id;
        const button = this;
        
        // Add loading state
        button.innerHTML = `<i class="fas fa-spinner fa-spin"></i> Adding...`;
        button.disabled = true;

        fetch('add-to-cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ service_id: serviceId })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                // Show toast notification
                const toast = document.querySelector('.toast-notification');
                toast.style.display = 'block';
                setTimeout(() => {
                    toast.style.display = 'none';
                }, 3000);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        })
        .finally(() => {
            // Reset button state
            button.innerHTML = `<i class="fas fa-cart-plus mr-2"></i>Add to Cart`;
            button.disabled = false;
        });
    });
});
</script>

<?php include('includes/footer.php'); ?>