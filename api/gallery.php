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
            $stmt = $pdo->prepare("SELECT * FROM gallery WHERE id = ?");
            $stmt->execute([$_GET['id']]);
            echo json_encode($stmt->fetch());
        } else {
            $stmt = $pdo->query("SELECT * FROM gallery ORDER BY created_at DESC");
            echo json_encode($stmt->fetchAll());
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        try {
            if (isset($data['id']) && !empty($data['id'])) {
                $stmt = $pdo->prepare("UPDATE gallery SET title=?, image_url=?, category=? WHERE id=?");
                $stmt->execute([$data['title'], $data['image_url'], $data['category'], $data['id']]);
            } else {
                $stmt = $pdo->prepare("INSERT INTO gallery (title, image_url, category) VALUES (?, ?, ?)");
                $stmt->execute([$data['title'], $data['image_url'], $data['category']]);
            }
            echo json_encode(['status' => 'success']);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $stmt = $pdo->prepare("DELETE FROM gallery WHERE id = ?");
            $stmt->execute([$_GET['id']]);
            echo json_encode(['status' => 'success']);
        }
        break;
}
