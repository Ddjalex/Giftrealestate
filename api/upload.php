<?php
require_once 'db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['images'])) {
        http_response_code(400);
        echo json_encode(['error' => 'No images uploaded']);
        exit;
    }

    $uploaded_urls = [];
    $upload_dir = '../uploads/';
    
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
        $file_name = time() . '_' . $_FILES['images']['name'][$key];
        $target_file = $upload_dir . $file_name;
        
        if (move_uploaded_file($tmp_name, $target_file)) {
            $uploaded_urls[] = '/uploads/' . $file_name;
        }
    }

    echo json_encode(['urls' => $uploaded_urls]);
    exit;
}
