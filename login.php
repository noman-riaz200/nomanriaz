<?php 
session_start();
include('includes/config.php');

$error = ''; // Initialize error message variable

// Process login before any HTML output
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        header("Location: services.php");
        exit();
    } else {
        $error = 'Invalid credentials';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DevServices</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  
  
    <!-- Custom CSS -->
    <style>
         /* Modified body style */
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        /* Add spacing for content below header */
        .login-card {
            margin-top: 100px; /* Adjust this value as needed */
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            overflow: hidden;
            margin: 20px auto;
        }
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        /* Keep existing custom styles */
        .form-control:focus {
            border-color: #764ba2;
            box-shadow: 0 0 0 0.2rem rgba(118,75,162,0.25);
        }
        .btn-custom {
            background: #764ba2;
            color: white;
            transition: all 0.3s;
        }
        .btn-custom:hover {
            background: #5a3780;
            color: white;
        }
        .auth-logo {
            width: 80px;
            height: 80px;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <?php include('includes/header.php'); ?>

    <!-- Main Content -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="login-card bg-white">
                    <div class="card-body p-5">
                        <div class="text-center mb-5">
                            <img src="your-logo.png" alt="Logo" class="auth-logo mb-3">
                            <h3 class="mb-3">Welcome Back</h3>
                            <p class="text-muted">Please sign in to continue</p>
                        </div>

                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $email = $_POST['email'];
                            $password = $_POST['password'];

                            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
                            $stmt->bind_param("s", $email);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $user = $result->fetch_assoc();

                            if ($user && password_verify($password, $user['password'])) {
                                $_SESSION['user_id'] = $user['id'];
                                $_SESSION['user_email'] = $user['email'];
                                header("Location: services.php");
                                exit();
                            } else {
                                echo '<div class="alert alert-danger text-center">Invalid credentials</div>';
                            }
                        }
                        ?>

                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" 
                                       class="form-control" 
                                       id="email" 
                                       name="email" 
                                       required
                                       placeholder="Enter your email">
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" 
                                       class="form-control" 
                                       id="password" 
                                       name="password" 
                                       required
                                       placeholder="••••••••">
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-custom btn-lg">Sign In</button>
                            </div>

                            <div class="text-center">
                                <p class="text-muted mb-0">Don't have an account? 
                                    <a href="register.php" class="text-decoration-none">Create one</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>