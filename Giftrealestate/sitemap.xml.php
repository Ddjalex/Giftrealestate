<?php
header("Content-Type: application/xml; charset=utf-8");
require_once __DIR__ . '/api/db.php';

$baseUrl = "https://realestatepropertyaddis.com";

echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

function outputUrl($loc, $priority = "0.5") {
    echo "  <url>" . PHP_EOL;
    echo "    <loc>" . htmlspecialchars($loc, ENT_XML1, 'UTF-8') . "</loc>" . PHP_EOL;
    echo "    <priority>{$priority}</priority>" . PHP_EOL;
    echo "  </url>" . PHP_EOL;
}

/* Static pages */
outputUrl("$baseUrl/", "1.0");
outputUrl("$baseUrl/about.php", "0.8");
outputUrl("$baseUrl/contact.php", "0.8");
outputUrl("$baseUrl/gallery.php", "0.8");
outputUrl("$baseUrl/properties.php", "0.9");
outputUrl("$baseUrl/news.php", "0.8");

/* Property detail pages */
if (!empty($pdo)) {
    try {
        $stmt = $pdo->query("SELECT id FROM properties");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            outputUrl("$baseUrl/property.php?id=" . $row['id'], "0.9");
        }
    } catch (Throwable $e) {}
}

/* News detail pages */
if (!empty($pdo)) {
    try {
        $stmt = $pdo->query("SELECT id FROM news");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            outputUrl("$baseUrl/news_detail.php?id=" . $row['id'], "0.7");
        }
    } catch (Throwable $e) {}
}

echo '</urlset>';
