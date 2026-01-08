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
    require 'api/api.php';
    exit;
} elseif (strpos($path, '/admin') === 0) {
    include 'admin/index.html';
} else {
    include 'frontend/index.html';
}
