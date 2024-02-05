<?php

require __DIR__ . '/../vendor/autoload.php';

// Start a Session
if (!session_id()) {
	session_start();
}

// Handle the request
// Include the routing configuration
$routes = include __DIR__ . '/../config/routes.php';

// Get the requested path from the URL
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Get the request method
$method = $_SERVER['REQUEST_METHOD'];

// Check if the requested path and method are defined in the routes
if (array_key_exists($path, $routes) && array_key_exists($method, $routes[$path])) {
	// Call the corresponding controller method
	[$controllerClass, $controllerMethod] = $routes[$path][$method];
	$controller = new $controllerClass();
	$controller->$controllerMethod();

	unset($_SESSION['message_type']);
	unset($_SESSION['message']);
} else {
	// Handle 404 - Page Not Found
	http_response_code(404);
	echo '404 Not Found';
}
