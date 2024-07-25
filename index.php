<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');  // Allow requests from any origin
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');  // Allow specific HTTP methods
header('Access-Control-Allow-Headers: Content-Type, Authorization');  // Allow specific headers
header('Cache-Control: no-cache');

$base_url = 'http://localhost:8000/';

$path = trim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');

$routes = glob(__DIR__ . "/api/*.json");

foreach ($routes as $route) {

    if ($path ===  basename($route, ".json")) {

        http_response_code(200);
        require($route);

        return;
    }
}


http_response_code(404);
echo json_encode(['message' => 'route Not Found']);
