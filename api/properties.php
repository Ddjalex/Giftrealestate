<?php
require_once 'db.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Handle single property vs list
        if (isset($_GET['id'])) {
            $stmt = $pdo->prepare("SELECT * FROM properties WHERE id = ?");
            $stmt->execute([$_GET['id']]);
            $property = $stmt->fetch();
            if ($property) {
                // Fetch images
                $imgStmt = $pdo->prepare("SELECT image_url, is_main FROM property_images WHERE property_id = ?");
                $imgStmt->execute([$_GET['id']]);
                $property['images'] = $imgStmt->fetchAll();
                echo json_encode($property);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Property not found']);
            }
        } else {
            $stmt = $pdo->query("SELECT p.*, (SELECT image_url FROM property_images WHERE property_id = p.id AND is_main = TRUE LIMIT 1) as main_image FROM properties p ORDER BY created_at DESC");
            echo json_encode($stmt->fetchAll());
        }
        break;

    case 'POST':
        // Authentication check should go here
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid data']);
            break;
        }

        try {
            $stmt = $pdo->prepare("INSERT INTO properties (title, description, price, location, property_type, status, bedrooms, bathrooms, area_sqft, featured) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $data['title'],
                $data['description'] ?? null,
                $data['price'] ?? 0,
                $data['location'] ?? '',
                $data['property_type'] ?? 'Apartment',
                $data['status'] ?? 'For Sale',
                $data['bedrooms'] ?? 0,
                $data['bathrooms'] ?? 0,
                $data['area_sqft'] ?? 0,
                $data['featured'] ?? false
            ]);
            $propertyId = $pdo->lastInsertId();
            echo json_encode(['status' => 'success', 'id' => $propertyId]);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        break;
}
