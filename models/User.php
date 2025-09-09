<?php
require_once 'config/database.php';

class User
{
	private $connection;

	public function __construct()
	{
		$database = new Database();
		$this->connection = $database->getConnection();
	}

	public function getAll()
	{
		$query = "SELECT * FROM users ORDER BY created_at DESC";
		$result = $this->connection->query($query);

		if ($result) {
			return $result->fetch_all(MYSQLI_ASSOC);
		}
		return [];
	}

	public function find($id)
	{
		$query = "SELECT * FROM users WHERE id = ?";
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("i", $id);
		$stmt->execute();

		$result = $stmt->get_result();
		return $result->fetch_assoc();
	}

	public function create($data)
	{
		$query = "INSERT INTO users (name, email, phone) VALUES (?, ?, ?)";
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("sss", $data['name'], $data['email'], $data['phone']);

		if ($stmt->execute()) {
			return $this->connection->insert_id;
		}
		return false;
	}

	public function checkLogin($email, $password)
	{
		$query = "SELECT * FROM users WHERE email = ? AND password = ?";
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("ss", $email, $password);
		$stmt->execute();

		$result = $stmt->get_result();
		return $result->num_rows > 0;
	}

	public function validate($data)
	{
		$errors = [];

		if (empty($data['name']) || strlen(trim($data['name'])) < 2) {
			$errors['name'] = 'Name must be at least 2 characters long';
		}

		if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			$errors['email'] = 'Please enter a valid email address';
		}

		if (!empty($data['phone']) && !preg_match('/^[\d\-\+\(\)\s]+$/', $data['phone'])) {
			$errors['phone'] = 'Please enter a valid phone number';
		}

		return $errors;
	}

	public function emailExists($email, $excludeId = null)
	{
		$query = "SELECT id FROM users WHERE email = ?";
		$params = [$email];
		$types = "s";

		if ($excludeId) {
			$query .= " AND id != ?";
			$params[] = $excludeId;
			$types .= "i";
		}

		$stmt = $this->connection->prepare($query);
		$stmt->bind_param($types, ...$params);
		$stmt->execute();

		$result = $stmt->get_result();
		return $result->num_rows > 0;
	}
}
?>