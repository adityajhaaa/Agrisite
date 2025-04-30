<?php
session_start();

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'agromart_db');

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
if ($conn->query($sql) === FALSE) {
    die("Error creating database: " . $conn->error);
}

$conn->select_db(DB_NAME);

// Create cart table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS cart (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_cart_item (user_id, product_id)
)";

if ($conn->query($sql) === FALSE) {
    die("Error creating cart table: " . $conn->error);
}

// Common Functions
if (!function_exists('is_logged_in')) {
    function is_logged_in() {
        return isset($_SESSION['user_id']);
    }
}

if (!function_exists('get_user_data')) {
    function get_user_data() {
        global $conn;
        if (is_logged_in()) {
            $user_id = $_SESSION['user_id'];
            $sql = "SELECT * FROM users WHERE id = $user_id";
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
                return $result->fetch_assoc();
            }
        }
        return null;
    }
}

if (!function_exists('get_cart_items')) {
    function get_cart_items() {
        global $conn;
        if (is_logged_in()) {
            $user_id = $_SESSION['user_id'];
            $sql = "SELECT c.*, p.name, p.price, p.image 
                    FROM cart c 
                    JOIN products p ON c.product_id = p.id 
                    WHERE c.user_id = $user_id";
            $result = $conn->query($sql);
            $items = [];
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $items[] = $row;
                }
            }
            return $items;
        }
        return [];
    }
}

if (!function_exists('get_categories')) {
    function get_categories() {
        global $conn;
        $sql = "SELECT * FROM categories";
        $result = $conn->query($sql);
        $categories = [];
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
        }
        return $categories;
    }
}

if (!function_exists('get_products')) {
    function get_products($limit = 10, $category = null, $featured = false) {
        global $conn;
        
        $sql = "SELECT p.*, c.name as category_name FROM products p
                LEFT JOIN categories c ON p.category_id = c.id";
        
        if ($category) {
            $sql .= " WHERE p.category_id = $category";
        }
        
        if ($featured) {
            if (strpos($sql, "WHERE") !== false) {
                $sql .= " AND p.featured = 1";
            } else {
                $sql .= " WHERE p.featured = 1";
            }
        }
        
        $sql .= " LIMIT $limit";
        
        $result = $conn->query($sql);
        $products = [];
        
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }
        
        return $products;
    }
}
?> 