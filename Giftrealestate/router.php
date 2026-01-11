<?php
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if ($uri === '/sitemap.xml') {
    if (file_exists(__DIR__ . '/sitemap.xml')) {
        header("Content-Type: application/xml; charset=utf-8");
        readfile(__DIR__ . '/sitemap.xml');
        exit;
    }
    include __DIR__ . '/sitemap.php';
    exit;
}

if (strpos($uri, 'google') !== false && file_exists(__DIR__ . $uri)) {
    return false;
}

if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false;
}

require_once __DIR__ . '/index.php';
