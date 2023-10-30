<?php
require_once __DIR__. '/../../Models/user.php';
require_once __DIR__. '/../../../Connection.php';

class UsersDA {
	private $pdo;
	
	public function __construct() {
		$this->pdo = Connection::createConnection();
		
		if(!$this->pdo) {
			echo "Unable to connect with the database";
			exit;
		}
	}
	
	public function getUsers() {

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

}
?>
