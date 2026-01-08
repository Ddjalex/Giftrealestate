<?php
// Main entry point for the real estate application
// This will eventually route to Frontend, Backend (API), or Admin Panel

$request_uri = $_SERVER['REQUEST_URI'];

if (strpos($request_uri, '/api/') === 0) {
    // Backend API Logic
    header('Content-Type: application/json');
    echo json_encode(['status' => 'success', 'message' => 'Welcome to the Real Estate API']);
} elseif (strpos($request_uri, '/admin') === 0) {
    // Admin Panel
    include 'admin/index.html';
} else {
    // Frontend
    include 'frontend/index.html';
}
