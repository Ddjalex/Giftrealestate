<?php
// Gift Real Estate - Ethiopia
// Minimal Entry Point

error_reporting(E_ALL);
ini_set('display_errors', 1);

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($path === '/health') {
    die("OK");
}

if (strpos($path, '/api/') === 0) {
    require_once 'api/db.php';
    if (strpos($path, '/api/properties') === 0) {
        require 'api/properties.php';
    } elseif (strpos($path, '/api/inquiries') === 0) {
        require 'api/inquiries.php';
    } else {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Not Found']);
    }
    exit;
}

if (strpos($path, '/admin') === 0) {
    if (file_exists('admin/index.html')) {
        include 'admin/index.html';
    } else {
        echo "Admin missing";
    }
    exit;
}

// Default to Frontend
if (file_exists('frontend/index.html')) {
    include 'frontend/index.html';
} else {
    echo "Frontend missing";
}
