<?php
class Database
{
	private $host = 'localhost';
	private $username = 'root';
	private $password = '';
	private $database = 'mvc_demo';
	private $connection;

	public function __construct()
	{
		$this->connect();
	}

	private function connect()
	{
		$this->connection = new mysqli(
			$this->host,
			$this->username,
			$this->password,
			$this->database
		);

		if ($this->connection->connect_error) {
			die("Connection failed: " . $this->connection->connect_error);
		}
	}

	public function getConnection()
	{
		return $this->connection;
	}

	public function close()
	{
		if ($this->connection) {
			$this->connection->close();
		}
	}
}
?>