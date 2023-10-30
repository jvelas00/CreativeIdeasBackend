<?php
require_once __DIR__. '/../../Models/Order.php';
require_once __DIR__. '/../../../Connection.php';

class OrdersDA {
	private $pdo;
	
	public function __construct() {
		$this->pdo = Connection::createConnection();
		
		if(!$this->pdo) {
			echo "Unable to connect with the database";
			exit;
		}
	}
	
	public function getOrders() {

		try {
			$query = "SELECT * FROM orders";
			$stmt = $this->pdo->prepare($query);
			$stmt->execute();
			$orders = array();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$order = new Order($row['order_id'], $row['customer_id'], $row['accepted'], $row['pending'], $row['date_ordered'], $row['total']);
				$orders[] = $order;
			}
			return $orders;
			
		} catch (PDOException $e) {
			echo "Database error: " . $e->getMessage();
		}
	}

}
?>
