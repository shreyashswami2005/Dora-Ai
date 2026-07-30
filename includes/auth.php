<?php
// Centralized Session & Auth Manager for PharmaShop
if (session_status() === PHP_SESSION_NONE) {
    // Session security & persistence settings
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    
    // Set 7-day session cookie lifetime across root path
    session_set_cookie_params([
        'lifetime' => 604800, // 7 days
        'path' => '/',
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    
    session_start();
}

/**
 * Require user to be logged in.
 * @param bool $require_admin Optional check for admin role
 */
function require_login($require_admin = false) {
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
    
    if ($require_admin && ($_SESSION['role'] ?? '') !== 'admin') {
        header('Location: dashboard.php?error=unauthorized');
        exit;
    }
}

/**
 * Check if current user is logged in
 * @return bool
 */
function is_logged_in() {
    return isset($_SESSION['user_id']);
}
?>
