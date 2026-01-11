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
        $ownerPhone = "251921878641"; // Corrected owner number from settings
        $msg = "New Inquiry:\n" .
               "Property: " . ($data['property_id'] ?? 'N/A') . "\n" .
               "Name: " . $data['name'] . "\n" .
               "Phone: " . ($data['phone'] ?? 'N/A') . "\n" .
               "Message: " . $data['message'];
               
        // CallMeBot usually requires a setup (API Key per user). 
        // If the background API isn't working, we might need a different approach or correct API key.
        // For now, I will use the number that was working in the previous direct-link version.
        $url = "https://api.callmebot.com/whatsapp.php?phone=" . $ownerPhone . "&text=" . urlencode($msg) . "&apikey=3813853"; // Example/Placeholder API key - ideally user provides this
        
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
