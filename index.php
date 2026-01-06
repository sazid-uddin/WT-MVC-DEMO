<?php
// Simple router implementation

try {
	// check if request is for API
	$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$is_api = str_contains($path, 'api');

	if ($is_api) {
		if (str_contains($path,'api/users')) {
			require_once 'api/users.php';
			exit();
		}
	}

	// Get path and remove base path
	$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$path = ltrim(str_replace('/mvc', '', $path), '/');
	$action = explode('/', $path)[0] ?: 'index';

	// Route to UserController
	require_once 'controllers/UserController.php';
	$userController = new UserController();

	if ($action === 'index') {
		$userController->index();
	} elseif ($action === 'login') {
		$userController->login();
	} elseif ($action === 'authenticate') {
		$userController->authenticate();
	} elseif ($action === 'create') {
		$userController->create();
	} elseif ($action === 'store') {
		$userController->store();
	} else {
		http_response_code(404);
		include 'views/errors/404.php';
	}
} catch (Exception $e) {
	http_response_code(500);
	error_log("MVC Error: " . $e->getMessage());

	if (ini_get('display_errors')) {
		echo "<h1>500 - Internal Server Error</h1>";
		echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
		echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
	} else {
		include 'views/errors/500.php';
	}
}
?>