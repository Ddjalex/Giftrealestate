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
                vision_image TEXT,
                ceo_image TEXT,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
            CREATE TABLE IF NOT EXISTS properties (
                id SERIAL PRIMARY KEY,
                title TEXT NOT NULL,
                description TEXT,
                price DECIMAL(15, 2),
                location TEXT,
                property_type TEXT,
                status TEXT,
                bedrooms INTEGER,
                bathrooms INTEGER,
                area_sqft DECIMAL(15, 2),
                featured INTEGER DEFAULT 0,
                main_image TEXT,
                gallery_images TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
            CREATE TABLE IF NOT EXISTS gallery (
                id SERIAL PRIMARY KEY,
                title TEXT NOT NULL,
                image_url TEXT NOT NULL,
                category TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
            CREATE TABLE IF NOT EXISTS news (
                id SERIAL PRIMARY KEY,
                title TEXT NOT NULL,
                content TEXT,
                image_url TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
            CREATE TABLE IF NOT EXISTS blog (
                id SERIAL PRIMARY KEY,
                title TEXT NOT NULL,
                content TEXT,
                image_url TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
            CREATE TABLE IF NOT EXISTS inquiries (
                id SERIAL PRIMARY KEY,
                property_id INTEGER,
                name TEXT NOT NULL,
                email TEXT,
                phone TEXT,
                message TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
            CREATE TABLE IF NOT EXISTS users (
                id SERIAL PRIMARY KEY,
                email TEXT UNIQUE NOT NULL,
                password TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
        ");
        
        // Seed admin user if not exists
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->execute(['timnit@gmail.com']);
        if ($stmt->fetchColumn() == 0) {
            $hashedPassword = password_hash('a1e2y3t4h5', PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
            $stmt->execute(['timnit@gmail.com', $hashedPassword]);
        }
        
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
