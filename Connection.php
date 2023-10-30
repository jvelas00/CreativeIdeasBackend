<?php
class Connection {
	public static function createConnection() {
		try {
			$pdo = new PDO("pgsql:host=localhost;port=5432;dbname=sedb", "postgres", "sedb",[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
			return $pdo;
		} catch (PDOException $e) {
			echo "Database connection failed: " . $e->getMessage();
			die();
	}
	}
}


?>