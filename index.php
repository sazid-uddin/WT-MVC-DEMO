<?php
// Simple router implementation

try {
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