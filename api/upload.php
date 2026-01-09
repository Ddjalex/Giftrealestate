<?php
require_once 'db.php';
global $pdo;
if (!isset($pdo)) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection missing']);
    exit;
}
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['images'])) {
        http_response_code(400);
        echo json_encode(['error' => 'No images uploaded']);
        exit;
    }

    $uploaded_urls = [];
    $upload_dir = __DIR__ . '/../uploads/';
    
    if (!file_exists($upload_dir)) {
        if (!mkdir($upload_dir, 0777, true)) {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to create upload directory']);
            exit;
        }
    }

    foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
        if ($_FILES['images']['error'][$key] !== UPLOAD_ERR_OK) continue;
        
        $file_name = time() . '_' . rand(100, 999) . '_' . basename($_FILES['images']['name'][$key]);
        $target_file = $upload_dir . $file_name;
        
        // Allow images and videos
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'video/mp4', 'video/webm', 'video/ogg'];
        $file_type = $_FILES['images']['type'][$key];
        
        if (move_uploaded_file($tmp_name, $target_file)) {
            $uploaded_urls[] = $file_name;
        }
    }

    echo json_encode(['urls' => $uploaded_urls]);
    exit;
}
