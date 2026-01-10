<?php
require_once 'db.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $email = $data['email'] ?? '';
    $password = $data['password'] ?? '';

    if ($pdo) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_hash($password, PASSWORD_DEFAULT) === $user['password']) {
            // In a real app, set session here
            echo json_encode(['success' => true]);
        } else if ($user && password_verify($password, $user['password'])) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}
