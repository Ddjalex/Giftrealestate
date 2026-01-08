<?php
require_once 'db.php';
if (!isset($pdo)) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection missing']);
    exit;
}

header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $stmt = $pdo->prepare("SELECT * FROM properties WHERE id = ?");
            $stmt->execute([$_GET['id']]);
            $property = $stmt->fetch();
            echo json_encode($property);
        } else {
            $stmt = $pdo->query("SELECT * FROM properties ORDER BY created_at DESC");
            echo json_encode($stmt->fetchAll());
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid data']);
            break;
        }

        try {
            if (isset($data['id']) && !empty($data['id'])) {
                // Update
                $stmt = $pdo->prepare("UPDATE properties SET title=?, description=?, price=?, location=?, property_type=?, status=?, bedrooms=?, bathrooms=?, area_sqft=?, featured=?, main_image=?, gallery_images=? WHERE id=?");
                $stmt->execute([
                    $data['title'],
                    $data['description'] ?? '',
                    (float)($data['price'] ?? 0),
                    $data['location'] ?? '',
                    $data['property_type'] ?? 'Residential Apartments',
                    $data['status'] ?? 'For Sale',
                    (int)($data['bedrooms'] ?? 0),
                    (int)($data['bathrooms'] ?? 0),
                    (float)($data['area_sqft'] ?? 0),
                    (isset($data['featured']) && ($data['featured'] === true || $data['featured'] === 'on' || $data['featured'] === 1)) ? 1 : 0,
                    $data['main_image'] ?? null,
                    isset($data['gallery_images']) ? json_encode($data['gallery_images']) : null,
                    (int)$data['id']
                ]);
            } else {
                // Insert
                $stmt = $pdo->prepare("INSERT INTO properties (title, description, price, location, property_type, status, bedrooms, bathrooms, area_sqft, featured, main_image, gallery_images) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([
                    $data['title'],
                    $data['description'] ?? '',
                    (float)($data['price'] ?? 0),
                    $data['location'] ?? '',
                    $data['property_type'] ?? 'Residential Apartments',
                    $data['status'] ?? 'For Sale',
                    (int)($data['bedrooms'] ?? 0),
                    (int)($data['bathrooms'] ?? 0),
                    (float)($data['area_sqft'] ?? 0),
                    (isset($data['featured']) && ($data['featured'] === true || $data['featured'] === 'on' || $data['featured'] === 1)) ? 1 : 0,
                    $data['main_image'] ?? null,
                    isset($data['gallery_images']) ? json_encode($data['gallery_images']) : null
                ]);
            }
            echo json_encode(['status' => 'success']);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $stmt = $pdo->prepare("DELETE FROM properties WHERE id = ?");
            $stmt->execute([$_GET['id']]);
            echo json_encode(['status' => 'success']);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Missing ID']);
        }
        break;

    default:
        http_response_code(405);
        break;
}
