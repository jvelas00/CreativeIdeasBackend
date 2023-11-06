<?php
class JSONResponse {
    public function render($data) {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
?>