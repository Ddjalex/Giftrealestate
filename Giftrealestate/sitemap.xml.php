<?php
header("Content-Type: application/xml; charset=utf-8");
require_once 'api/db.php';
global $pdo;

$baseUrl = "https://realestatepropertyaddis.com";

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

// Homepage
echo "<url><loc>$baseUrl/</loc><priority>1.0</priority></url>";

// About
echo "<url><loc>$baseUrl/about.php</loc><priority>0.8</priority></url>";

// Contact
echo "<url><loc>$baseUrl/contact.php</loc><priority>0.8</priority></url>";

// Gallery
echo "<url><loc>$baseUrl/gallery.php</loc><priority>0.8</priority></url>";

// Properties Listing
echo "<url><loc>$baseUrl/properties.php</loc><priority>0.9</priority></url>";

// Properties Detail
$stmt = $pdo->query("SELECT id FROM properties");
while ($row = $stmt->fetch()) {
    echo "<url><loc>$baseUrl/property.php?id=" . $row['id'] . "</loc><priority>0.9</priority></url>";
}

// News/Blog Listing
echo "<url><loc>$baseUrl/news.php</loc><priority>0.8</priority></url>";

// News/Blog Detail
$stmt = $pdo->query("SELECT id FROM news");
while ($row = $stmt->fetch()) {
    echo "<url><loc>$baseUrl/news_detail.php?id=" . $row['id'] . "</loc><priority>0.7</priority></url>";
}

echo '</urlset>';
?>