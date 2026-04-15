<?php
// config.php - Database Configuration for XAMPP
define('DB_HOST', 'localhost');
define('DB_USER', 'root');       // XAMPP default
define('DB_PASS', '');           // XAMPP default (empty)
define('DB_NAME', 'rewear_db');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed: ' . mysqli_connect_error()]));
}

// Start session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Helper: check if logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Helper: get current user
function getUser($conn) {
    if (!isLoggedIn()) return null;
    $id = (int)$_SESSION['user_id'];
    $res = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
    return mysqli_fetch_assoc($res);
}
?>
