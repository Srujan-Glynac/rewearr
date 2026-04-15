<?php
// auth.php - Handles login and registration
require_once 'config.php';
header('Content-Type: application/json');

$action = $_POST['action'] ?? '';

if ($action === 'register') {
    $name     = trim(mysqli_real_escape_string($conn, $_POST['name'] ?? ''));
    $email    = trim(mysqli_real_escape_string($conn, $_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';
    $role     = in_array($_POST['role'] ?? 'buyer', ['buyer','seller']) ? $_POST['role'] : 'buyer';

    if (!$name || !$email || !$password) {
        echo json_encode(['success' => false, 'message' => 'All fields are required']);
        exit;
    }

    // Check duplicate
    $check = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email'");
    if (mysqli_num_rows($check) > 0) {
        echo json_encode(['success' => false, 'message' => 'Email already registered']);
        exit;
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);
    $sql  = "INSERT INTO users (name, email, password, role) VALUES ('$name','$email','$hash','$role')";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(['success' => true, 'message' => 'Account created! Please login.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Registration failed']);
    }

} elseif ($action === 'login') {
    $email    = trim(mysqli_real_escape_string($conn, $_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';

    if (!$email || !$password) {
        echo json_encode(['success' => false, 'message' => 'Email and password required']);
        exit;
    }

    $res  = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    $user = mysqli_fetch_assoc($res);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id']   = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];
        echo json_encode([
            'success' => true,
            'name'    => $user['name'],
            'role'    => $user['role'],
            'redirect'=> $user['role'] === 'admin' ? 'admin/index.php' : 'home.php'
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
    }

} elseif ($action === 'logout') {
    session_destroy();
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid action']);
}
?>
