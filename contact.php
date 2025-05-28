<?php include('includes/config.php'); ?>
<?php include('includes/header.php'); ?>


<?php
$successMsg = '';
$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $subject = htmlspecialchars(trim($_POST['subject'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));

    // Validate inputs
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $errorMsg = 'All fields are required!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg = 'Invalid email format!';
    } else {
        // Database connection
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'dev_services';

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("INSERT INTO contacts (name, email, subject, message) 
                                  VALUES (:name, :email, :subject, :message)");
            
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':subject' => $subject,
                ':message' => $message
            ]);

            $successMsg = 'Message sent successfully!';
            // Clear form fields
            $name = $email = $subject = $message = '';
            
        } catch(PDOException $e) {
            $errorMsg = "Error: " . $e->getMessage();
        }
        $conn = null;
    }
}
?>












<main class="contact-page">
    <!-- Hero Section -->
    <section class="contact-hero bg-gradient">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="text-white display-4 mb-4 animate-on-scroll">Let's Build Something Amazing</h1>
                    <p class="lead text-white-50 animate-on-scroll">We're here to help you transform your digital vision into reality</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section-contact py-5">
        <div class="container">
            <div class="row">
                <!-- Contact Form -->
                <div class="col-lg-7 mb-5 mb-lg-0 animate-on-scroll">
                    <div class="contact-card p-4 p-md-5 shadow">
                        <h3 class="mb-4">Send Us a Message</h3>
                        <form id="contactForm" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Your Name</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Subject</label>
                                <input type="text" name="subject" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Message</label>
                                <textarea name="message" class="form-control" rows="5" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block mt-4">
                                <i class="fas fa-paper-plane mr-2"></i>Send Message
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-5 animate-on-scroll" style="animation-delay: 0.2s">
                    <div class="contact-info-card p-4 p-md-5 shadow">
                        <h3 class="mb-4">Contact Information</h3>
                        
                        <div class="contact-item mb-4">
                            <div class="icon-box bg-primary">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                            <div class="contact-details">
                                <h5>Office Address</h5>
                                <p class="text-muted mb-0">Multan, Pakistan</p>
                            </div>
                        </div>

                        <div class="contact-item mb-4">
                            <div class="icon-box bg-primary">
                                <i class="fas fa-phone text-white"></i>
                            </div>
                            <div class="contact-details">
                                <h5>Phone Number</h5>
                                <p class="text-muted mb-0">+92 307 8890235</p>
                            </div>
                        </div>

                        <div class="contact-item mb-4">
                            <div class="icon-box bg-primary">
                                <i class="fas fa-envelope text-white"></i>
                            </div>
                            <div class="contact-details">
                                <h5>Email Address</h5>
                                <p class="text-muted mb-0">noman2ac@gmail.com</p>
                            </div>
                        </div>

                        <div class="social-links mt-5">
                            <h5 class="mb-3">Connect With Us</h5>
                            <a href="#" class="social-icon"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-github"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map Section -->
            <div class="row mt-5">
                <div class="col-12 animate-on-scroll">
                    <div class="map-card shadow-lg">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d54375.87365832698!2d71.43336743125!3d30.1575004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x393b35c61dc6a365%3A0x4f6b4a5e2d4f4c3a!2sMultan%2C%20Punjab%2C%20Pakistan!5e0!3m2!1sen!2s!4v1689763162113!5m2!1sen!2s" 
                                width="100%" 
                                height="400" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy"
                                class="rounded">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
</main>

<style>
.contact-page {
    padding-top: 80px;
}

.bg-gradient {
    background: var(--gradient);
    padding: 6rem 0;
}

.contact-card,
.contact-info-card {
    background: white;
    border-radius: 15px;
}

.icon-box {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
}

.contact-item {
    display: flex;
    align-items: center;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 12px 15px;
    transition: all 0.3s;
}

.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(42,42,114,0.25);
}

.btn-primary {
    background: var(--gradient);
    border: none;
    padding: 12px 30px;
    border-radius: 8px;
    transition: transform 0.3s;
}

.btn-primary:hover {
    transform: translateY(-2px);
}

.social-icon {
    color: var(--primary-color);
    font-size: 1.4rem;
    margin-right: 15px;
    transition: all 0.3s;
}

.social-icon:hover {
    color: var(--secondary-color);
    transform: translateY(-3px);
}

.map-card {
    border-radius: 15px;
    overflow: hidden;
}
</style>

<?php include('includes/footer.php'); ?>