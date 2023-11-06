<?php
require_once __DIR__ . '/../../Models/inventory.php';
require_once __DIR__ . '/../../../Connection.php';

class InventoryDA
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

	public function getInventory()
	{

		try {
			$query = "SELECT * FROM inventory";
			$stmt = $this->pdo->prepare($query);
			$stmt->execute();
			$inventoryItems = array();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$inventory = new Inventory($row['inv_id'], $row['name'], $row['description'], $row['price'], $row['qty']);
				$inventoryItems[] = $inventory;
			}
			return $inventoryItems;
		} catch (PDOException $e) {
			echo "Database error: " . $e->getMessage();
		}
	}

	public function addItem($name, $description, $price, $qty)
	{

		try {
			$query = "INSERT INTO inventory (NAME, DESCRIPTION, PRICE, QTY)
			VALUES (:name, :description, :price, :qty);";
			$stmt = $this->pdo->prepare($query);
			$stmt->bindParam(':name', $name, PDO::PARAM_STR);
			$stmt->bindParam(':description', $description, PDO::PARAM_STR);
			$stmt->bindParam(':price', $price, PDO::PARAM_STR);
			$stmt->bindParam(':qty', $qty, PDO::PARAM_STR);
			$stmt->execute();

			if ($stmt->rowCount() > 0) {
				echo "Data inserted successfully.";
			} else {
				echo "Data did not update.";
			}
		} catch (PDOException $e) {
			echo "Database error: " . $e->getMessage();
		}
	}

	public function editQty($inv_id, $qty)
	{
		try {
			$query = "UPDATE inventory SET QTY = :qty WHERE INV_ID = :inv_id;";
			$stmt = $this->pdo->prepare($query);
			$stmt->bindParam(':qty', $qty, PDO::PARAM_STR);
			$stmt->bindParam(':inv_id', $inv_id, PDO::PARAM_STR);
			$stmt->execute();

			if ($stmt->rowCount() > 0) {
				echo "Data updated successfully.";
			} else {
				echo "Data did not update.";
			}
		} catch (PDOException $e) {
			echo "Database error: " . $e->getMessage();
		}
	}

	public function getItem($inv_id)
	{
		try {
			$query = "SELECT * FROM inventory WHERE inv_id = :inv_id";
			$stmt = $this->pdo->prepare($query);
			$stmt->bindParam(':inv_id', $inv_id, PDO::PARAM_STR);
			$stmt->execute();
			$inventoryItems = array();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$inventory = new Inventory($row['inv_id'], $row['name'], $row['description'], $row['price'], $row['qty']);
				$inventoryItems[] = $inventory;
			}
			return $inventoryItems;
		} catch (PDOException $e) {
			echo "Database error: " . $e->getMessage();
		}
	}
}
