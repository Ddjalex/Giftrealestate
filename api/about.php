<?php
if (!isset($pdo)) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection missing']);
    exit;
}

header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $stmt = $pdo->query("SELECT * FROM about_us LIMIT 1");
        echo json_encode($stmt->fetch());
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        try {
            // First check if a row exists
            $stmt = $pdo->query("SELECT id FROM about_us LIMIT 1");
            $row = $stmt->fetch();
            
            if ($row) {
                $stmt = $pdo->prepare("UPDATE about_us SET title=?, content=?, image_url=?, updated_at=CURRENT_TIMESTAMP WHERE id=?");
                $stmt->execute([$data['title'], $data['content'], $data['image_url'], $row['id']]);
            } else {
                $stmt = $pdo->prepare("INSERT INTO about_us (title, content, image_url) VALUES (?, ?, ?)");
                $stmt->execute([$data['title'], $data['content'], $data['image_url']]);
            }
            echo json_encode(['status' => 'success']);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
        break;
}
