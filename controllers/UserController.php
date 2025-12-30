<?php
require_once 'models/User.php';

class UserController
{
	private $userModel;

	public function __construct()
	{
		$this->userModel = new User();
	}

	public function index()
	{
		$users = $this->userModel->getAll();
		$this->loadView('users/index', ['users' => $users]);
	}

	public function login()
	{
		$this->loadView('users/login');
	}

	public function authenticate()
	{
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			header('Location: /mvc/login');
			exit;
		}

		$email = trim($_POST['email'] ?? '');
		$password = trim($_POST['password'] ?? '');

		$authentincated = $this->userModel->checkLogin($email, $password);
		if($authentincated) {
			session_start();
			$_SESSION['login_status'] = 'logged_in';
			header('Location: /mvc/');
			exit;
		} else {
			$this->loadView('users/login', ['error' => 'Invalid email or password.']);
			exit;
		}
	}
	public function create()
	{
		$this->loadView('users/create');
	}

	public function store()
	{
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			header('Location: /mvc/create');
			exit;
		}

		$data = [
			'name' => trim($_POST['name'] ?? ''),
			'email' => trim($_POST['email'] ?? ''),
			'phone' => trim($_POST['phone'] ?? '')
		];

		// Validate input
		$errors = $this->userModel->validate($data);

		// Check if email already exists
		if (empty($errors['email']) && $this->userModel->emailExists($data['email'])) {
			$errors['email'] = 'Email address already exists';
		}

		if (!empty($errors)) {
			$this->loadView('users/create', [
				'errors' => $errors,
				'old' => $data
			]);
			return;
		}

		// Create user
		$userId = $this->userModel->create($data);

		if ($userId) {
			// Set success message in session
			header('Location: /mvc/');
			exit;
		} else {
			$this->loadView('users/create', [
				'errors' => ['general' => 'Failed to create user. Please try again.'],
				'old' => $data
			]);
		}
	}

	private function loadView($view, $data = [])
	{
		// Extract data to variables
		extract($data);

		// Include the view file
		$viewFile = "views/{$view}.php";
		if (file_exists($viewFile)) {
			include $viewFile;
		} else {
			http_response_code(404);
			echo "View not found: {$view}";
		}
	}
}
?>