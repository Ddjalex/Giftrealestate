<?php
require_once 'db.php';
global $pdo;
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $stmt = $pdo->prepare("SELECT * FROM blog WHERE id = ?");
            $stmt->execute([$_GET['id']]);
            echo json_encode($stmt->fetch());
        } else {
            $stmt = $pdo->query("SELECT * FROM blog ORDER BY created_at DESC");
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
                $stmt = $pdo->prepare("UPDATE blog SET title=?, content=?, image_url=? WHERE id=?");
                $stmt->execute([$data['title'], $data['content'] ?? '', $data['image_url'] ?? null, (int)$data['id']]);
            } else {
                $stmt = $pdo->prepare("INSERT INTO blog (title, content, image_url) VALUES (?, ?, ?)");
                $stmt->execute([$data['title'], $data['content'] ?? '', $data['image_url'] ?? null]);
            }
            echo json_encode(['status' => 'success']);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $stmt = $pdo->prepare("DELETE FROM blog WHERE id = ?");
            $stmt->execute([$_GET['id']]);
            echo json_encode(['status' => 'success']);
        }
        break;
}
