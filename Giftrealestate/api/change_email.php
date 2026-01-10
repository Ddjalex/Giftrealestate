<?php
session_start();
require_once 'db.php';
global $pdo;

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $new_email = $data['new_email'] ?? '';
    $old_email = $_SESSION['admin_email'];

    if ($pdo && !empty($new_email)) {
        try {
            $stmt = $pdo->prepare("UPDATE users SET email = ? WHERE email = ?");
            if ($stmt->execute([$new_email, $old_email])) {
                $_SESSION['admin_email'] = $new_email;
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Update failed']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}
