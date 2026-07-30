<?php
require_once 'includes/auth.php';
$page_title = 'Login - PharmaShop';

if (is_logged_in()) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_POST) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 6) {
        $error = 'Invalid email or password.';
    } else {
        require 'config/database.php';
        
        $stmt = $pdo->prepare("SELECT id, username, password_hash, role FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Invalid email or password.';
        }
    }
}
?>
<?php include 'includes/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-lg border-0 animate-fade-in">
            <div class="card-body p-5">
                <h2 class="text-center mb-4"><i class="fas fa-sign-in-alt text-primary me-2"></i>Welcome Back</h2>
                
                <?php if ($error): ?>
                    <div class="alert alert-danger animate-shake"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <form method="POST" novalidate>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required autofocus>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-3 animate-pulse">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </button>
                </form>
                <p class="text-center">No account? <a href="register.php">Register here</a></p>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
