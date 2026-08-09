<?php
require_once 'includes/auth.php';
require_login();
$page_title = 'Dashboard - PharmaShop';

// Placeholder pharma stats (extend later with real data)
$total_sales = 12500;
$inventory_count = 450;
$low_stock = 12;
$orders_today = 25;

require 'config/database.php';

// Example: Fetch user info
$stmt = $pdo->prepare("SELECT username, role FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>
<?php include 'includes/header.php'; ?>

<div class="row mb-4">
    <div class="col-12">
        <h1 class="mb-3 animate-fade-in">
            <i class="fas fa-tachometer-alt text-primary me-2"></i>
            Welcome, <strong><?php echo htmlspecialchars($user['username']); ?></strong>! (<span class="badge bg-<?php echo $user['role'] == 'admin' ? 'danger' : 'success'; ?>"><?php echo ucfirst($user['role']); ?></span>)
        </h1>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 shadow-sm border-0 hover-lift animate-fade-in">
            <div class="card-body text-center">
                <i class="fas fa-dollar-sign fa-3x text-success mb-3"></i>
                <h3 class="text-success mb-1">$<?php echo number_format($total_sales); ?></h3>
                <p class="mb-0">Total Sales</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 shadow-sm border-0 hover-lift animate-fade-in">
            <div class="card-body text-center">
                <i class="fas fa-boxes fa-3x text-info mb-3"></i>
                <h3 class="text-info mb-1"><?php echo $inventory_count; ?></h3>
                <p class="mb-0">Inventory Items</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 shadow-sm border-0 hover-lift animate-fade-in">
            <div class="card-body text-center">
                <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                <h3 class="text-warning mb-1"><?php echo $low_stock; ?></h3>
                <p class="mb-0">Low Stock Alerts</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 shadow-sm border-0 hover-lift animate-fade-in" style="cursor: pointer;" onclick="window.location.href='dors-admin.php'">
            <div class="card-body text-center">
                <i class="fas fa-brain fa-3x text-primary mb-3"></i>
                <h3 class="text-primary mb-1">Dora AI</h3>
                <p class="mb-0">Knowledge Admin</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 shadow-sm border-0 hover-lift animate-fade-in">
            <div class="card-body text-center">
                <i class="fas fa-shopping-cart fa-3x text-primary mb-3"></i>
                <h3 class="text-primary mb-1"><?php echo $orders_today; ?></h3>
                <p class="mb-0">Orders Today</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 animate-fade-in">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Quick Stats Overview</h5>
            </div>
            <div class="card-body">
                <p class="lead">Welcome to your PharmaShop dashboard! Manage inventory, sales, and more.</p>
                <p><strong>Next features to add:</strong> Inventory list, sales reports, customer orders.</p>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 animate-fade-in">
            <div class="card-header bg-success text-white">
                <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Test Account</h6>
            </div>
            <div class="card-body">
                <p><strong>Email:</strong> admin@pharmashop.com</p>
                <p><strong>Password:</strong> admin123</p>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
