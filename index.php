<?php
require_once 'api/db.php';

$request_uri = $_SERVER['REQUEST_URI'];
$path = parse_url($request_uri, PHP_URL_PATH);

if (strpos($path, '/api/properties') === 0) {
    require 'api/properties.php';
} elseif (strpos($path, '/api/inquiries') === 0) {
    require 'api/inquiries.php';
} elseif (strpos($path, '/admin') === 0) {
    include 'admin/index.html';
} else {
    include 'frontend/index.html';
}
