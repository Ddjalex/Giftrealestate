<?php
if (!isset($pdo)) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection missing']);
    exit;
}

header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];

// Helper to get JSON input
function getJsonInput() {
    return json_decode(file_get_contents('php://input'), true);
}

// Router based on path
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$parts = explode('/', trim($path, '/'));
$resource = $parts[1] ?? ''; // Assuming /api/resource

switch ($resource) {
    case 'properties':
        handleProperties($pdo, $method);
        break;
    case 'gallery':
        handleGallery($pdo, $method);
        break;
    case 'news':
        handleNews($pdo, $method);
        break;
    case 'inquiries':
        handleInquiries($pdo, $method);
        break;
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Resource not found']);
        break;
}

function handleProperties($pdo, $method) {
    switch ($method) {
        case 'GET':
            if (isset($_GET['id'])) {
                $stmt = $pdo->prepare("SELECT * FROM properties WHERE id = ?");
                $stmt->execute([$_GET['id']]);
                echo json_encode($stmt->fetch());
            } else {
                $stmt = $pdo->query("SELECT * FROM properties ORDER BY created_at DESC");
                echo json_encode($stmt->fetchAll());
            }
            break;
        case 'POST':
            $data = getJsonInput();
            if (!$data) { http_response_code(400); return; }
            try {
                if (isset($data['id']) && !empty($data['id'])) {
                    $stmt = $pdo->prepare("UPDATE properties SET title=?, description=?, price=?, location=?, property_type=?, status=?, bedrooms=?, bathrooms=?, area_sqft=?, featured=? WHERE id=?");
                    $stmt->execute([$data['title'], $data['description'] ?? '', $data['price'] ?? 0, $data['location'] ?? '', $data['property_type'] ?? 'Residential Apartments', $data['status'] ?? 'For Sale', $data['bedrooms'] ?? 0, $data['bathrooms'] ?? 0, $data['area_sqft'] ?? 0, (isset($data['featured']) && $data['featured']) ? true : false, $data['id']]);
                } else {
                    $stmt = $pdo->prepare("INSERT INTO properties (title, description, price, location, property_type, status, bedrooms, bathrooms, area_sqft, featured) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$data['title'], $data['description'] ?? '', $data['price'] ?? 0, $data['location'] ?? '', $data['property_type'] ?? 'Residential Apartments', $data['status'] ?? 'For Sale', $data['bedrooms'] ?? 0, $data['bathrooms'] ?? 0, $data['area_sqft'] ?? 0, (isset($data['featured']) && $data['featured']) ? true : false]);
                }
                echo json_encode(['status' => 'success']);
            } catch (PDOException $e) { http_response_code(500); echo json_encode(['error' => $e->getMessage()]); }
            break;
        case 'DELETE':
            if (isset($_GET['id'])) {
                $stmt = $pdo->prepare("DELETE FROM properties WHERE id = ?");
                $stmt->execute([$_GET['id']]);
                echo json_encode(['status' => 'success']);
            }
            break;
    }
}

function handleGallery($pdo, $method) {
    switch ($method) {
        case 'GET':
            if (isset($_GET['id'])) {
                $stmt = $pdo->prepare("SELECT * FROM gallery WHERE id = ?");
                $stmt->execute([$_GET['id']]);
                echo json_encode($stmt->fetch());
            } else {
                $stmt = $pdo->query("SELECT * FROM gallery ORDER BY created_at DESC");
                echo json_encode($stmt->fetchAll());
            }
            break;
        case 'POST':
            $data = getJsonInput();
            try {
                if (isset($data['id']) && !empty($data['id'])) {
                    $stmt = $pdo->prepare("UPDATE gallery SET title=?, image_url=?, category=? WHERE id=?");
                    $stmt->execute([$data['title'], $data['image_url'], $data['category'], $data['id']]);
                } else {
                    $stmt = $pdo->prepare("INSERT INTO gallery (title, image_url, category) VALUES (?, ?, ?)");
                    $stmt->execute([$data['title'], $data['image_url'], $data['category']]);
                }
                echo json_encode(['status' => 'success']);
            } catch (PDOException $e) { http_response_code(500); echo json_encode(['error' => $e->getMessage()]); }
            break;
        case 'DELETE':
            if (isset($_GET['id'])) {
                $stmt = $pdo->prepare("DELETE FROM gallery WHERE id = ?");
                $stmt->execute([$_GET['id']]);
                echo json_encode(['status' => 'success']);
            }
            break;
    }
}

function handleNews($pdo, $method) {
    switch ($method) {
        case 'GET':
            if (isset($_GET['id'])) {
                $stmt = $pdo->prepare("SELECT * FROM news WHERE id = ?");
                $stmt->execute([$_GET['id']]);
                echo json_encode($stmt->fetch());
            } else {
                $stmt = $pdo->query("SELECT * FROM news ORDER BY created_at DESC");
                echo json_encode($stmt->fetchAll());
            }
            break;
        case 'POST':
            $data = getJsonInput();
            try {
                if (isset($data['id']) && !empty($data['id'])) {
                    $stmt = $pdo->prepare("UPDATE news SET title=?, content=?, image_url=? WHERE id=?");
                    $stmt->execute([$data['title'], $data['content'], $data['image_url'], $data['id']]);
                } else {
                    $stmt = $pdo->prepare("INSERT INTO news (title, content, image_url) VALUES (?, ?, ?)");
                    $stmt->execute([$data['title'], $data['content'], $data['image_url']]);
                }
                echo json_encode(['status' => 'success']);
            } catch (PDOException $e) { http_response_code(500); echo json_encode(['error' => $e->getMessage()]); }
            break;
        case 'DELETE':
            if (isset($_GET['id'])) {
                $stmt = $pdo->prepare("DELETE FROM news WHERE id = ?");
                $stmt->execute([$_GET['id']]);
                echo json_encode(['status' => 'success']);
            }
            break;
    }
}

function handleInquiries($pdo, $method) {
    if ($method !== 'POST') { http_response_code(405); return; }
    $data = getJsonInput();
    if (!isset($data['name'], $data['email'], $data['message'])) { http_response_code(400); return; }
    try {
        $stmt = $pdo->prepare("INSERT INTO inquiries (property_id, name, email, phone, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$data['property_id'] ?? null, $data['name'], $data['email'], $data['phone'] ?? null, $data['message']]);
        echo json_encode(['status' => 'success']);
    } catch (PDOException $e) { http_response_code(500); echo json_encode(['error' => $e->getMessage()]); }
}
