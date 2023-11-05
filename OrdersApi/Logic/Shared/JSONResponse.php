<?php
class JSONResponse {
    public function render($data) {
        header("Access-Control-Allow-Methods: GET, POST, PUT");
        header("Access-Control-Allow-Origin: http://localhost:8080/Pages/OrderPages/ViewOrderHistory.php");
        header('Content-Type: application/json');
        header('Access-Control-Allow-Headers: application/json');
        echo json_encode($data);
    }
}
?>