<?php
header("Content-Type: application/xml; charset=utf-8");
require_once 'api/db.php';
global $pdo;

$baseUrl = "https://realestatepropertyaddis.com";

// Output XML declaration
echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

// Helper function to output URL
function outputUrl($loc, $priority) {
    echo "  <url>" . PHP_EOL;
    echo "    <loc>" . htmlspecialchars($loc) . "</loc>" . PHP_EOL;
    echo "    <priority>$priority</priority>" . PHP_EOL;
    echo "  </url>" . PHP_EOL;
}

// Homepage
outputUrl("$baseUrl/", "1.0");

// About
outputUrl("$baseUrl/about.php", "0.8");

// Contact
outputUrl("$baseUrl/contact.php", "0.8");

// Gallery
outputUrl("$baseUrl/gallery.php", "0.8");

// Properties Listing
outputUrl("$baseUrl/properties.php", "0.9");

// Properties Detail
try {
    $stmt = $pdo->query("SELECT id FROM properties");
    while ($row = $stmt->fetch()) {
        outputUrl("$baseUrl/property.php?id=" . $row['id'], "0.9");
    }
} catch (Exception $e) {}

// News/Blog Listing
outputUrl("$baseUrl/news.php", "0.8");

// News/Blog Detail
try {
    $stmt = $pdo->query("SELECT id FROM news");
    while ($row = $stmt->fetch()) {
        outputUrl("$baseUrl/news_detail.php?id=" . $row['id'], "0.7");
    }
} catch (Exception $e) {}

echo '</urlset>';
?>