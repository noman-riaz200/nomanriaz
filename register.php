<?php 
include('includes/config.php');
include('includes/header.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email already exists
    $check_email = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $result = $check_email->get_result();
    
    if($result->num_rows > 0) {
        $error = "Email already exists!";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);
        
        if ($stmt->execute()) {
            $success = "Registration successful! You can now login.";
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>

<main class="register-page">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <!-- Alert Messages -->
                <?php if(isset($error)): ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <?= $error ?>
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                
                <?php if(isset($success)): ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <?= $success ?>
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <!-- Registration Card -->
                <div class="card shadow-lg">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-5">
                            <i class="fas fa-user-plus fa-3x text-primary mb-4"></i>
                            <h2 class="h3 mb-3">Create Your Account</h2>
                            <p class="text-muted">Join our developer community</p>
                        </div>

                        <form method="POST">
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" 
                                       class="form-control"
                                       id="name"
                                       name="name" 
                                       required
                                       placeholder="John Doe"
                                       minlength="3">
                            </div>

                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" 
                                       class="form-control"
                                       id="email"
                                       name="email"
                                       required
                                       placeholder="john@example.com">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" 
                                       class="form-control"
                                       id="password"
                                       name="password"
                                       required
                                       placeholder="••••••••"
                                       minlength="6">
                            </div>

                            <button type="submit" 
                                    class="btn btn-primary btn-block btn-lg mt-4">
                                <i class="fas fa-user-plus mr-2"></i>Register Now
                            </button>

                            <div class="text-center mt-4">
                                <p class="text-muted mb-0">
                                    Already have an account? 
                                    <a href="login.php" class="text-primary">Login here</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.register-page {
    min-height: calc(100vh - 156px);
    padding-top: 80px;
}

.card {
    border: none;
    border-radius: 15px;
    overflow: hidden;
}

.form-control {
    height: 45px;
    border-radius: 8px;
    padding-left: 15px;
    transition: all 0.3s;
}

.form-control:focus {
    border-color: #2A2A72;
    box-shadow: 0 0 0 0.2rem rgba(42,42,114,0.25);
}

.btn-primary {
    background: linear-gradient(135deg, #2A2A72 0%, #009FFD 100%);
    border: none;
    border-radius: 8px;
    padding: 12px 20px;
    transition: transform 0.3s;
}

.btn-primary:hover {
    transform: translateY(-2px);
}
</style>

<?php include('includes/footer.php'); ?>