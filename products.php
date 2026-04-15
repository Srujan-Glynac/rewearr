<?php
// products.php - Product listing and adding
require_once 'config.php';
header('Content-Type: application/json');

$action = $_POST['action'] ?? $_GET['action'] ?? 'list';

if ($action === 'list') {
    $category = mysqli_real_escape_string($conn, $_GET['category'] ?? '');
    $search   = mysqli_real_escape_string($conn, $_GET['search'] ?? '');

    $where = "WHERE p.status = 'active'";
    if ($category) $where .= " AND p.category = '$category'";
    if ($search)   $where .= " AND (p.title LIKE '%$search%' OR p.description LIKE '%$search%')";

    $sql = "SELECT p.*, u.name AS seller_name 
            FROM products p 
            JOIN users u ON p.seller_id = u.id 
            $where 
            ORDER BY p.created_at DESC";

    $res  = mysqli_query($conn, $sql);
    $products = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $products[] = $row;
    }
    echo json_encode(['success' => true, 'products' => $products]);

} elseif ($action === 'add') {
    if (!isLoggedIn()) {
        echo json_encode(['success' => false, 'message' => 'Please login first']);
        exit;
    }

    $seller_id    = (int)$_SESSION['user_id'];
    $title        = mysqli_real_escape_string($conn, $_POST['title'] ?? '');
    $description  = mysqli_real_escape_string($conn, $_POST['description'] ?? '');
    $price        = (float)($_POST['price'] ?? 0);
    $category     = mysqli_real_escape_string($conn, $_POST['category'] ?? '');
    $size         = mysqli_real_escape_string($conn, $_POST['size'] ?? '');
    $condition    = mysqli_real_escape_string($conn, $_POST['condition_type'] ?? '');

    if (!$title || !$price) {
        echo json_encode(['success' => false, 'message' => 'Title and price are required']);
        exit;
    }

    // Handle image upload
    $image = 'default.jpg';
    if (!empty($_FILES['image']['name'])) {
        $ext      = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $allowed  = ['jpg','jpeg','png','webp','gif'];
        if (!in_array(strtolower($ext), $allowed)) {
            echo json_encode(['success' => false, 'message' => 'Invalid image type']);
            exit;
        }
        $filename = uniqid('product_') . '.' . $ext;
        $dest     = __DIR__ . '/uploads/' . $filename;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $dest)) {
            $image = $filename;
        }
    }

    $sql = "INSERT INTO products (seller_id, title, description, price, category, size, condition_type, image) 
            VALUES ($seller_id, '$title', '$description', $price, '$category', '$size', '$condition', '$image')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(['success' => true, 'message' => 'Product listed successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add product']);
    }

} elseif ($action === 'get') {
    $id  = (int)($_GET['id'] ?? 0);
    $sql = "SELECT p.*, u.name AS seller_name FROM products p JOIN users u ON p.seller_id = u.id WHERE p.id = $id";
    $res = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($res);
    if ($product) {
        echo json_encode(['success' => true, 'product' => $product]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Product not found']);
    }
}
?>
