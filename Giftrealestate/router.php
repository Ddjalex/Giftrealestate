<?php
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Handle static files first
if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false;
}

// Redirect .php requests to clean URLs for public routes only
// We exclude /api/ and /admin/ if needed, but usually we just want to hide it from the browser.
if (preg_match('/\.php$/', $uri) && !isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    $clean_uri = preg_replace('/\.php$/', '', $uri);
    header("Location: $clean_uri", true, 301);
    exit;
}

// Route mapping
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
    '/admin/login' => 'admin/login.php',
    '/admin/logout' => 'admin/logout.php',
];

if (isset($routes[$uri])) {
    include __DIR__ . '/' . $routes[$uri];
    exit;
}

// Check if file exists with .php extension and serve it
if (file_exists(__DIR__ . $uri . '.php')) {
    include __DIR__ . $uri . '.php';
    exit;
}

// Handle admin sub-routes dynamically
if (strpos($uri, '/admin/') === 0) {
    $admin_file = __DIR__ . $uri . '.php';
    if (file_exists($admin_file)) {
        include $admin_file;
        exit;
    }
}

// Handle API routes
if (strpos($uri, '/api/') === 0) {
    $api_file = __DIR__ . $uri . '.php';
    if (file_exists($api_file)) {
        include $api_file;
        exit;
    }
}

// Fallback to index if nothing matches
include __DIR__ . '/index.php';
