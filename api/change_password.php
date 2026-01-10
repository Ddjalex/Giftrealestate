<?php
session_start();
require_once 'db.php';
global $pdo;

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

if (!isset($pdo)) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection missing']);
    exit;
}
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (!isset($data['new_password'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing password']);
        exit;
    }

    // Since we don't have a real user session/auth system yet, 
    // we'll just update the first admin user's password.
    // In a real app, this would use the current session user ID.
    $hashed = password_hash($data['new_password'], PASSWORD_DEFAULT);
    
    try {
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->execute([$hashed, $_SESSION['admin_email']]);
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
    exit;
}
