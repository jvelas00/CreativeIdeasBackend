<?php
require_once __DIR__. '/../../Models/Order.php';
require_once __DIR__. '/../../Models/OrderSummary.php';
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

	public function getCustomerOrders($customerId) {

		try{
			$query = "SELECT * FROM orders WHERE customer_id = :customer_id";
			$stmt = $this->pdo->prepare($query);
			$stmt->bindParam(':customer_id', $customerId, PDO::PARAM_INT);
			$orders = array();
			if($stmt->execute()) {
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					$order = new Order($row['order_id'],$row['customer_id'],$row['accepted'],$row['pending'],$row['date_ordered'],$row['total']);
					$orders[] = $order;
				}
				return $orders;
			} else {
				return null;
			}
		} catch (PDOException $e) {
			echo "Database error: " . $e->getMessage();
		}
	}

	public function getOrderSummaries(array $orders) {
		$details = array();

		$query = "SELECT INVENTORY.NAME,ORDER_DETAILS.QTY,ORDERS.TOTAL,ORDERS.ACCEPTED,ORDERS.PENDING 
		FROM ORDERS
	  	JOIN ORDER_DETAILS ON ORDERS.ORDER_ID = ORDER_DETAILS.ORDER_ID
	  	JOIN INVENTORY ON ORDER_DETAILS.INV_ID = INVENTORY.INV_ID
	  	WHERE ORDERS.ORDER_ID = :orderId";

	  	$stmt = $this->pdo->prepare($query);

		foreach($orders as $order) {
			$stmt->bindParam(':orderId',$order->order_id, PDO::PARAM_INT);

			if($stmt->execute()) {
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$status = "";
					if ($row['accepted'] === true && $row['pending'] === false) {
						$status = "Accepted";
					} elseif ($row['accepted'] === false && $row['pending'] === true) {
						$status = "Pending";
					} else {
						$status = "Rejected";
					}
					
					$orderDetail = new OrderSummary($row['name'],$row['qty'],$row['total'],$status);
					$details[] = $orderDetail;
				}

			}
		}
		return $details;
	}

	public function getOrder($orderId) {
		try{
			$query = "SELECT * FROM orders WHERE order_id = :order_id";
			$stmt = $this->pdo->prepare($query);
			$stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);

			if($stmt->execute()) {
				$row = $stmt->fetch(PDO::FETCH_ASSOC);

				if($row) {
					$order = new Order($row['order_id'],$row['customer_id'],$row['accepted'],$row['pending'],$row['date_ordered'],$row['total']);
					return $order;

				};
			} else {
				return null;
			}
		} catch (PDOException $e) {
			echo "Database error: " . $e->getMessage();
		}
	}

	public function addOrder($customerId, $total) {
		try{
			$query = "INSERT INTO orders (customer_id, accepted, pending, date_ordered, total)
			VALUES (:customer_id, :accepted, :pending, :date_ordered, :total)";
			$accepted = false;
			$pending = true;
			$dateOrdered = new DateTime();
			$formattedDate = $dateOrdered->format('Y-m-d');

			$stmt = $this->pdo->prepare($query);
			$stmt->bindParam(':customer_id', $customerId, PDO::PARAM_INT);
			$stmt->bindParam(':accepted', $accepted, PDO::PARAM_BOOL);
			$stmt->bindParam(':pending', $pending, PDO::PARAM_BOOL);
			$stmt->bindParam('date_ordered', $formattedDate);
			$stmt->bindParam(':total', $total, PDO::PARAM_STR);
			$stmt->execute();


		} catch (PDOException $e) {
			echo "Database error: " . $e->getMessage();
		}
	}

	public function addOrderDetail($orderId, $invId, $qty) {
		try {
			$query = "INSERT INTO order_details (ORDER_ID, INV_ID, QTY)
			VALUES (:orderId, :invId, :qty)";
			$stmt = $this->pdo->prepare($query);
			$stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
			$stmt->bindParam(':invId', $invId, PDO::PARAM_INT);
			$stmt->bindParam(':qty', $qty, PDO::PARAM_INT);

			$stmt->execute();

		} catch (PDOException $e) {
			echo "Database error: " . $e->getMessage();
		}
	}

	public function getLatestOrder($customerId) {
		try{
			$query = "SELECT * FROM orders WHERE CUSTOMER_ID = :customer_id ORDER BY DATE_ORDERED DESC LIMIT 1";
			$stmt = $this->pdo->prepare($query);
			$stmt->bindParam(':customer_id', $customerId, PDO::PARAM_INT);
			if($stmt->execute()) {
				$row = $stmt->fetch(PDO::FETCH_ASSOC);

				if($row) {
					$order = new Order($row['order_id'],$row['customer_id'],$row['accepted'],$row['pending'],$row['date_ordered'],$row['total']);
					return $order;

				}

			} else {
				return null;
			}		
		} catch (PDOException $e) {
			echo "Database error: " . $e->getMessage();
		}
	}

}
?>
