<?php
// PHP Entry Point for Gift Real Estate
error_reporting(E_ALL);
ini_set('display_errors', 1);

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Simple routing
if (strpos($path, '/public/') === 0) {
    $file = __DIR__ . $path;
    if (file_exists($file)) {
        $mime = mime_content_type($file);
        header("Content-Type: $mime");
        readfile($file);
        exit;
    }
}
if (strpos($path, '/api/') === 0) {
    require_once 'api/db.php';
    if (strpos($path, '/api/properties') === 0) {
        require 'api/properties.php';
    } elseif (strpos($path, '/api/gallery') === 0) {
        require 'api/gallery.php';
    } elseif (strpos($path, '/api/news') === 0) {
        require 'api/news.php';
    } elseif (strpos($path, '/api/inquiries') === 0) {
        require 'api/inquiries.php';
    } else {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Endpoint not found']);
    }
} elseif ($path === '/news') {
    include 'frontend/news.php';
} elseif ($path === '/gallery') {
    include 'frontend/index.php'; // Or a separate gallery page if preferred, but for now we scroll to section
} elseif ($path === '/properties') {
    include 'frontend/index.php';
} elseif ($path === '/contact') {
    include 'frontend/index.php';
} elseif (strpos($path, '/admin') === 0) {
    include 'admin/index.php';
} else {
    include 'frontend/index.php';
}
