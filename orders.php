<?php
// orders.php - Handle checkout and orders
require_once 'config.php';
header('Content-Type: application/json');

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($action === 'place') {
    if (!isLoggedIn()) {
        echo json_encode(['success' => false, 'message' => 'Please login to checkout']);
        exit;
    }

    $buyer_id   = (int)$_SESSION['user_id'];
    $product_id = (int)($_POST['product_id'] ?? 0);
    $address    = mysqli_real_escape_string($conn, $_POST['address'] ?? '');

    if (!$product_id || !$address) {
        echo json_encode(['success' => false, 'message' => 'Missing order details']);
        exit;
    }

    // Get product price
    $res     = mysqli_query($conn, "SELECT * FROM products WHERE id = $product_id AND status = 'active'");
    $product = mysqli_fetch_assoc($res);

    if (!$product) {
        echo json_encode(['success' => false, 'message' => 'Product not available']);
        exit;
    }

    // Place order
    $price = $product['price'];
    $sql   = "INSERT INTO orders (buyer_id, product_id, total_price, address) VALUES ($buyer_id, $product_id, $price, '$address')";

    if (mysqli_query($conn, $sql)) {
        // Mark product as sold
        mysqli_query($conn, "UPDATE products SET status = 'sold' WHERE id = $product_id");
        echo json_encode(['success' => true, 'message' => 'Order placed successfully! 🎉']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Order failed']);
    }

} elseif ($action === 'my_orders') {
    if (!isLoggedIn()) {
        echo json_encode(['success' => false, 'message' => 'Login required']);
        exit;
    }

    $buyer_id = (int)$_SESSION['user_id'];
    $sql = "SELECT o.*, p.title, p.image, p.price FROM orders o 
            JOIN products p ON o.product_id = p.id 
            WHERE o.buyer_id = $buyer_id 
            ORDER BY o.created_at DESC";

    $res    = mysqli_query($conn, $sql);
    $orders = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $orders[] = $row;
    }
    echo json_encode(['success' => true, 'orders' => $orders]);
}
?>
