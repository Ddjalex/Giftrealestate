<?php
// Database connection using environment variables
$host = getenv('PGHOST');
$port = getenv('PGPORT');
$dbname = getenv('PGDATABASE');
$user = getenv('PGUSER');
$password = getenv('PGPASSWORD');

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";
    $pdo = new PDO($dsn);
    // Use integer values directly if constants cause issues in this environment
    $pdo->setAttribute(3, 2); // PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION
    $pdo->setAttribute(19, 2); // PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC
} catch (PDOException $e) {
    // Handle error gracefully in production
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
    exit;
}
