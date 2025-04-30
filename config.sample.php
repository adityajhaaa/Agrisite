<?php
session_start();

// Database Configuration
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'your_username');
define('DB_PASSWORD', 'your_password');
define('DB_NAME', 'agromart_db');

// Site Configuration
define('SITE_URL', 'http://localhost:8000'); // Change in production
define('SITE_NAME', 'AgroMart');
define('ADMIN_EMAIL', 'admin@yourdomain.com');

// File Upload Configuration
define('UPLOAD_DIR', __DIR__ . '/uploads');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'gif']);

// Connect to database
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
if ($conn->query($sql) === FALSE) {
    die("Error creating database: " . $conn->error);
}

$conn->select_db(DB_NAME);

// Create necessary tables if they don't exist
require_once 'database/schema.php';

// Common Functions
if (!function_exists('is_logged_in')) {
    function is_logged_in() {
        return isset($_SESSION['user_id']);
    }
}

// ... rest of your functions ...
?> 