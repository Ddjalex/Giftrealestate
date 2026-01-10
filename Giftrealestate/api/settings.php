<?php
require_once 'db.php';
global $pdo;
if (!isset($pdo)) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection missing']);
    exit;
}
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        // Ensure table exists first if it doesn't
        $pdo->exec("CREATE TABLE IF NOT EXISTS settings (
            `key` VARCHAR(255) PRIMARY KEY,
            `value` TEXT,
            `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

        $stmt = $pdo->query("SELECT `key`, `value` FROM settings");
        $settings = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
        echo json_encode($settings ?: new stdClass());
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (!$data) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid data']);
        exit;
    }

    try {
        $pdo->beginTransaction();
        
        // Check if table 'settings' has a unique constraint on 'key'
        // For Postgres, it should be 'key'. For MySQL, it depends on the schema.
        // The error might be because 'ON CONFLICT' is Postgres specific while the project might be using MySQL in some contexts, 
        // but Replit usually uses Postgres for its DB tool.
        // Let's use a more universal approach if possible, or ensure it's correct for Postgres.
        $stmt = $pdo->prepare("INSERT INTO settings (`key`, `value`) VALUES (?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`), `updated_at` = CURRENT_TIMESTAMP");
        
        foreach ($data as $key => $value) {
            // Handle array/object values by encoding to JSON
            $val = is_array($value) ? json_encode($value) : $value;
            if ($val === null) $val = '';
            $stmt->execute([$key, $val]);
        }
        $pdo->commit();
        
        // Clear OPcache if enabled to ensure changes are picked up immediately
        if (function_exists('opcache_reset')) {
            opcache_reset();
        }
        
        echo json_encode(['status' => 'success']);
    } catch (Exception $e) {
        $pdo->rollBack();
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
    exit;
}
