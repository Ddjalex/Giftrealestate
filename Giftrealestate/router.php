<?php
ob_start();
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if ($uri === '/sitemap.xml') {
    if (ob_get_length()) ob_clean();
    require __DIR__ . '/sitemap.xml.php';
    exit;
}

if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    ob_end_clean();
    return false;
}

require_once __DIR__ . '/index.php';