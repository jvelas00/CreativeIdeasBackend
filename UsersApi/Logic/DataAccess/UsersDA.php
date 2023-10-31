<?php
require_once __DIR__ . '/../../Models/user.php';
require_once __DIR__ . '/../../../Connection.php';

class UsersDA
{
	private $pdo;

	public function __construct()
	{
		$this->pdo = Connection::createConnection();

		if (!$this->pdo) {
			echo "Unable to connect with the database";
			exit;
		}
	}

	public function getUsers()
	{

		try {
			$query = "SELECT * FROM customers";
			$stmt = $this->pdo->prepare($query);
			$stmt->execute();
			$users = array();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$user = new User($row['customer_id'], $row['username'], $row['password'], $row['name']);
				$users[] = $user;
			}
			return $users;
		} catch (PDOException $e) {
			echo "Database error: " . $e->getMessage();
		}
	}

	public function login($username, $password)
	{

		try {
			$query = "SELECT * FROM customers WHERE username = :username AND password = :password";
			$stmt = $this->pdo->prepare($query);
			$stmt->bindParam(':username', $username, PDO::PARAM_STR);
			$stmt->bindParam(':password', $password, PDO::PARAM_STR);
			$stmt->execute();
			$users = array();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$user = new User($row['customer_id'], $row['username'], $row['password'], $row['name']);
				$users[] = $user;
			}
			if ($users) {
				return $users;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo "Database error: " . $e->getMessage();
		}
	}

	public function createUser($username, $password, $name)
	{
		try {
			$query = "INSERT INTO customers (username, password, name) VALUES (:username, :password, :name)";
			$stmt = $this->pdo->prepare($query);
			$stmt->bindParam(':username', $username, PDO::PARAM_STR);
			$stmt->bindParam(':password', $password, PDO::PARAM_STR);
			$stmt->bindParam(':name', $name, PDO::PARAM_STR);
			$stmt->execute();
			$users = array();

			// Check if the INSERT was successful
			if ($stmt->rowCount() > 0) {
				echo "Data inserted successfully.";
			} else {
				echo "Data insertion failed.";
			}
		} catch (PDOException $e) {
			echo "Database error: " . $e->getMessage();
		}
	}
}
