-- ==============================
-- ReWear Database (FINAL READY)
-- ==============================

CREATE DATABASE IF NOT EXISTS rewear_db;
USE rewear_db;

SET FOREIGN_KEY_CHECKS = 0;
DROP DATABASE rewear_db;
CREATE DATABASE rewear_db;
USE rewear_db;
SET FOREIGN_KEY_CHECKS = 1;
-- ======================
-- Users Table
-- ======================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('buyer','seller','admin') DEFAULT 'buyer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ======================
-- Products Table
-- ======================
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    seller_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    category VARCHAR(100),
    size VARCHAR(20),
    condition_type VARCHAR(50),
    image VARCHAR(255),
    status ENUM('active','sold','pending') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (seller_id) REFERENCES users(id) ON DELETE CASCADE
);

-- ======================
-- Orders Table
-- ======================
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    buyer_id INT NOT NULL,
    product_id INT NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    status ENUM('pending','confirmed','shipped','delivered') DEFAULT 'pending',
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (buyer_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- ======================
-- Insert Default Admin
-- ======================
INSERT INTO users (name, email, password, role) 
VALUES (
    'Admin',
    'admin@rewear.com',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    'admin'
);

-- ======================
-- Insert Sample Sellers
-- ======================
INSERT INTO users (name, email, password, role) VALUES 
('Priya Sharma', 'priya@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'seller'),
('Arjun Mehta', 'arjun@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'seller');

-- ======================
-- Insert Sample Products
-- ======================
INSERT INTO products (seller_id, title, description, price, category, size, condition_type, image)
VALUES
(2, 'Denim Jacket', 'Stylish blue denim jacket', 1200.00, 'Clothing', 'M', 'Good', 'jacket.jpg'),
(3, 'Sneakers', 'Comfortable white sneakers', 1500.00, 'Footwear', '9', 'Like New', 'shoes.jpg');

-- ======================
-- Insert Sample Orders
-- ======================
INSERT INTO orders (buyer_id, product_id, total_price, address)
VALUES
(1, 1, 1200.00, 'Mumbai, India'),
(1, 2, 1500.00, 'Mumbai, India');