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
    if (!isset($_FILES['images']) && empty($_POST)) {
        // This might happen if post_max_size is exceeded
        http_response_code(400);
        echo json_encode(['error' => 'No data received. File might be too large.']);
        exit;
    }

    if (!isset($_FILES['images'])) {
        http_response_code(400);
        echo json_encode(['error' => 'No images uploaded']);
        exit;
    }

    $uploaded_urls = [];
    $upload_dir = __DIR__ . '/../uploads/';
    
    // Ensure upload directory exists
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    chmod($upload_dir, 0777);

    // Filter out potential empty entries and handle single file vs array
    $files = $_FILES['images'];
    $file_count = is_array($files['name']) ? count($files['name']) : 1;

    for ($i = 0; $i < $file_count; $i++) {
        $tmp_name = is_array($files['tmp_name']) ? $files['tmp_name'][$i] : $files['tmp_name'];
        $error = is_array($files['error']) ? $files['error'][$i] : $files['error'];
        $name = is_array($files['name']) ? $files['name'][$i] : $files['name'];
        $type = is_array($files['type']) ? $files['type'][$i] : $files['type'];

        if ($error !== UPLOAD_ERR_OK) continue;
        
        $file_name = time() . '_' . rand(100, 999) . '_' . basename($name);
        $target_file = $upload_dir . $file_name;
        
        if (move_uploaded_file($tmp_name, $target_file)) {
            chmod($target_file, 0644);
            
            $file_ext = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            if (in_array($file_ext, ['mp4', 'webm', 'ogg'])) {
                $compressed_file = $upload_dir . 'compressed_' . $file_name;
                $cmd = "ffmpeg -i " . escapeshellarg($target_file) . " -vcodec libx264 -crf 38 -preset superfast -vf scale='trunc(iw/2)*2:trunc(ih/2)*2' -an -movflags +faststart " . escapeshellarg($compressed_file) . " 2>&1";
                exec($cmd, $output, $return_var);
                if ($return_var === 0) {
                    unlink($target_file);
                    rename($compressed_file, $target_file);
                }
            }
            $uploaded_urls[] = $file_name;
        }
    }

    echo json_encode(['urls' => $uploaded_urls]);
    exit;
}
