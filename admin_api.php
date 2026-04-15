<?php
// admin_api.php - Admin panel backend
require_once 'config.php';
header('Content-Type: application/json');

// Basic admin check (in real app, verify session role)
// For demo, we'll allow access; in production add: if ($_SESSION['user_role'] !== 'admin') die(...)

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($action === 'stats') {
    $users    = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM users"))['c'];
    $products = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM products"))['c'];
    $orders   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM orders"))['c'];
    $sold     = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM products WHERE status='sold'"))['c'];

    echo json_encode(['success' => true, 'stats' => compact('users','products','orders','sold')]);

} elseif ($action === 'products') {
    $sql = "SELECT p.*, u.name AS seller_name FROM products p JOIN users u ON p.seller_id = u.id ORDER BY p.created_at DESC";
    $res = mysqli_query($conn, $sql);
    $products = [];
    while ($row = mysqli_fetch_assoc($res)) $products[] = $row;
    echo json_encode(['success' => true, 'products' => $products]);

} elseif ($action === 'users') {
    $res = mysqli_query($conn, "SELECT id, name, email, role, created_at FROM users ORDER BY created_at DESC");
    $users = [];
    while ($row = mysqli_fetch_assoc($res)) $users[] = $row;
    echo json_encode(['success' => true, 'users' => $users]);

} elseif ($action === 'orders') {
    $sql = "SELECT o.*, p.title AS product_title, u.name AS buyer_name 
            FROM orders o 
            JOIN products p ON o.product_id = p.id 
            JOIN users u ON o.buyer_id = u.id 
            ORDER BY o.created_at DESC";
    $res = mysqli_query($conn, $sql);
    $orders = [];
    while ($row = mysqli_fetch_assoc($res)) $orders[] = $row;
    echo json_encode(['success' => true, 'orders' => $orders]);

} elseif ($action === 'delete_product') {
    $id  = (int)($_POST['id'] ?? 0);
    $sql = "DELETE FROM products WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Delete failed']);
    }

} else {
    echo json_encode(['success' => false, 'message' => 'Invalid action']);
}
?>
