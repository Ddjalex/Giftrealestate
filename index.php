<?php
// PHP Entry Point for Gift Real Estate
error_reporting(E_ALL);
ini_set('display_errors', 1);

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Simple routing
if (strpos($path, '/api/') === 0) {
    require_once 'api/db.php';
    if (strpos($path, '/api/properties') === 0) {
        require 'api/properties.php';
    } elseif (strpos($path, '/api/inquiries') === 0) {
        require 'api/inquiries.php';
    } else {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Endpoint not found']);
    }
} elseif (strpos($path, '/admin') === 0) {
    include 'admin/index.html';
} else {
    include 'frontend/index.html';
}
