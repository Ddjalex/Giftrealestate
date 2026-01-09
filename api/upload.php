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
    
    // Debug logging
    error_log("Upload request received. Files: " . print_r($_FILES, true));
    
    ob_start();
    try {
        if (!file_exists($upload_dir)) {
            if (!mkdir($upload_dir, 0777, true)) {
                ob_end_clean();
                http_response_code(500);
                echo json_encode(['error' => 'Failed to create upload directory']);
                exit;
            }
        }
        chmod($upload_dir, 0777);

    foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
        if ($_FILES['images']['error'][$key] !== UPLOAD_ERR_OK) continue;
        
        $file_name = time() . '_' . rand(100, 999) . '_' . basename($_FILES['images']['name'][$key]);
        $target_file = $upload_dir . $file_name;
        
        // Allow images and videos
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'video/mp4', 'video/webm', 'video/ogg'];
        $file_type = $_FILES['images']['type'][$key];
        
        // Use mime_content_type if type is not available or generic
        if (empty($file_type) || $file_type === 'application/octet-stream') {
            $file_type = mime_content_type($tmp_name);
        }

        if (move_uploaded_file($tmp_name, $target_file)) {
            chmod($target_file, 0644);
            $uploaded_urls[] = $file_name;
        } else {
            error_log("Failed to move uploaded file: " . $tmp_name . " to " . $target_file);
        }
    }

    ob_end_clean();
    echo json_encode(['urls' => $uploaded_urls]);
    exit;
}
