<?php
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Static files and direct file access
if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false;
}

// Redirect .php requests to clean URLs (only for browser requests, not internal includes)
if (preg_match('/\.php$/', $uri) && !isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    $clean_uri = preg_replace('/\.php$/', '', $uri);
    header("Location: $clean_uri", true, 301);
    exit;
}

// Define the root directory for inclusion
$baseDir = __DIR__;

// Routes mapping
$routes = [
    '/' => 'index.php',
    '/index' => 'index.php',
    '/about' => 'about.php',
    '/gallery' => 'gallery.php',
    '/properties' => 'properties.php',
    '/property' => 'property.php',
    '/news' => 'news.php',
    '/contact' => 'contact.php',
    '/sitemap.xml' => 'sitemap.php',
    '/admin' => 'admin/index.php',
    '/admin/' => 'admin/index.php',
    '/admin/login' => 'admin/login.php',
    '/admin/logout' => 'admin/logout.php',
];

if (isset($routes[$uri])) {
    include $baseDir . '/' . $routes[$uri];
    exit;
}

// Check if file exists with .php extension
if (file_exists($baseDir . $uri . '.php')) {
    include $baseDir . $uri . '.php';
    exit;
}

// Admin sub-routes
if (strpos($uri, '/admin/') === 0) {
    $admin_file = $baseDir . $uri . '.php';
    if (file_exists($admin_file)) {
        include $admin_file;
        exit;
    }
}

// API routes (keep .php for now to avoid breaking AJAX, or map them too)
if (strpos($uri, '/api/') === 0) {
    if (file_exists($baseDir . $uri . '.php')) {
        include $baseDir . $uri . '.php';
        exit;
    }
}

// Fallback to index
include $baseDir . '/index.php';
