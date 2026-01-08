<?php
// PHP Entry Point for Gift Real Estate
error_reporting(E_ALL);
ini_set('display_errors', 1);

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Simple routing
if (strpos($path, '/public/') === 0 || strpos($path, '/uploads/') === 0) {
    $file = __DIR__ . $path;
    if (file_exists($file)) {
        $mime = mime_content_type($file);
        header("Content-Type: $mime");
        readfile($file);
        exit;
    }
}

// Property Detail Routing
if (preg_match('/^\/property\/([0-9]+)/', $path, $matches)) {
    $_GET['id'] = $matches[1];
    require 'property.php';
    exit;
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
    } elseif (strpos($path, '/api/about') === 0) {
        require 'api/about.php';
    } elseif (strpos($path, '/api/settings') === 0) {
        require 'api/settings.php';
    } elseif (strpos($path, '/api/upload') === 0) {
        require 'api/upload.php';
    } elseif (strpos($path, '/api/change_password') === 0) {
        require 'api/change_password.php';
    } else {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Endpoint not found']);
    }
} elseif ($path === '/news') {
    include 'frontend/news.php';
} elseif ($path === '/about') {
    include 'frontend/about.php';
} elseif ($path === '/gallery') {
    include 'frontend/gallery.php';
} elseif ($path === '/properties') {
    include 'frontend/properties.php';
} elseif ($path === '/inquiries') {
    include 'frontend/inquiries.php';
} elseif ($path === '/contact') {
    include 'frontend/index.php';
} elseif (strpos($path, '/admin') === 0) {
    include 'admin/index.php';
} else {
    include 'frontend/index.php';
}
