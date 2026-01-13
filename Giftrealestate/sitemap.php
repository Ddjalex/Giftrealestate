<?php
header("Content-Type: application/xml; charset=utf-8");
require_once __DIR__ . '/api/db.php';

$baseUrl = "https://realestatepropertyaddis.com";

$output = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
$output .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

function getUrlXml($loc, $priority = "0.5") {
    $xml = "  <url>\n";
    $xml .= "    <loc>" . htmlspecialchars($loc, ENT_XML1) . "</loc>\n";
    $xml .= "    <priority>{$priority}</priority>\n";
    $xml .= "  </url>\n";
    return $xml;
}

/* Static Pages */
$output .= getUrlXml("$baseUrl/", "1.0");
$output .= getUrlXml("$baseUrl/about.php", "0.8");
$output .= getUrlXml("$baseUrl/contact.php", "0.8");
$output .= getUrlXml("$baseUrl/gallery.php", "0.8");
$output .= getUrlXml("$baseUrl/properties.php", "0.9");
$output .= getUrlXml("$baseUrl/news.php", "0.8");

/* Properties */
try {
    if (isset($pdo)) {
        $stmt = $pdo->query("SELECT id FROM properties");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $output .= getUrlXml("$baseUrl/property.php?id=" . $row['id'], "0.9");
        }
    }
} catch (Throwable $e) {}

/* News */
try {
    if (isset($pdo)) {
        $stmt = $pdo->query("SELECT id FROM news");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $output .= getUrlXml("$baseUrl/news_detail.php?id=" . $row['id'], "0.7");
        }
    }
} catch (Throwable $e) {}

$output .= '</urlset>';
echo $output;
exit;
