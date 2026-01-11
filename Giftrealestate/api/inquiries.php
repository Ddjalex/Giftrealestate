<?php
require_once 'db.php';
global $pdo;
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($data['name'], $data['email'], $data['message'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing required fields']);
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO inquiries (property_id, name, email, phone, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['property_id'] ?? null,
            $data['name'],
            $data['email'],
            $data['phone'] ?? null,
            $data['message']
        ]);

        // Background WhatsApp Notification
        $ownerPhone = "251974408281"; // Target number from screenshot
        $msg = "New Inquiry:\n" .
               "Property: " . ($data['property_id'] ?? 'N/A') . "\n" .
               "Name: " . $data['name'] . "\n" .
               "Phone: " . ($data['phone'] ?? 'N/A') . "\n" .
               "Message: " . $data['message'];
               
        $url = "https://api.callmebot.com/whatsapp.php?phone=" . $ownerPhone . "&text=" . urlencode($msg) . "&apikey=123456"; 
        
        // Non-blocking call
        @file_get_contents($url);

        echo json_encode(['status' => 'success', 'message' => 'Inquiry sent successfully']);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}
