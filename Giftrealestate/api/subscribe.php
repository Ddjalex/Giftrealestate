<?php
require_once 'db.php';
global $pdo;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $email = filter_var($data['email'] ?? '', FILTER_VALIDATE_EMAIL);

    if (!$email) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid email address']);
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO subscribers (email) VALUES (?) ON CONFLICT (email) DO NOTHING");
        $stmt->execute([$email]);
        echo json_encode(['success' => true, 'message' => 'Subscribed successfully']);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
    exit;
}
