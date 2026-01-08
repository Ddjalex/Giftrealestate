<?php
$host = getenv('PGHOST');
$port = getenv('PGPORT');
$dbname = getenv('PGDATABASE');
$user = getenv('PGUSER');
$password = getenv('PGPASSWORD');

$pdo = null;
$db_error = null;

if ($host) {
    try {
        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";
        $pdo = new PDO($dsn, null, null, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_TIMEOUT => 2
        ]);
        
        // Ensure tables exist
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS settings (
                key TEXT PRIMARY KEY,
                value TEXT,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
            CREATE TABLE IF NOT EXISTS about_us (
                id SERIAL PRIMARY KEY,
                title TEXT,
                content TEXT,
                image_url TEXT,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
        ");
        
        // Seed about_us if empty
        $stmt = $pdo->query("SELECT COUNT(*) FROM about_us");
        if ($stmt->fetchColumn() == 0) {
            $pdo->exec("INSERT INTO about_us (title, content, image_url) VALUES ('About Us', 'Welcome to Gift Real Estate.', '')");
        }

    } catch (Exception $e) {
        $db_error = $e->getMessage();
    }
} else {
    $db_error = "Database environment variables missing";
}
