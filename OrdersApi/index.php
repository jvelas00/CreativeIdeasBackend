<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

if (isset($_SERVER['REQUEST_URI'])) {
    $uri = $_SERVER['REQUEST_URI'];
    $uriParts = explode('/', $uri);
	$uriParts = array_slice($uriParts, 2);
} else {
    $uriParts = [];
}
// Check if 
if (isset($uriParts[0])) {
	
	// Check for API endpoint
	if($uriParts[2] === 'Test'){
		require 'Logic/EndpointScripts/Test.php';
	} elseif($uriParts[2] === 'CreateOrder') {
		require 'Logic/EndpointScripts/CreateOrder.php';
	} elseif($uriParts[2] === 'GetOrders') {
		require 'Logic/EndpointScripts/GetOrders.php';
	} elseif($uriParts[2] === 'GetOrder') {
		require 'Logic/EndpointScripts/GetOrder.php'; 	
	} else {
		header('HTTP/1.1 404 Not Found');
		echo 'No endpoint for ';
		for($i = 0; $i < count($uriParts); $i++) {
			echo "/{$uriParts[$i]} + ";
		}
	}
} else {
    header('HTTP/1.1 404 Not Found');
	echo "No specified endpoint in URI";
	for($i = 0; $i < count($uriParts); $i++) {
		echo "/{$uriParts[$i]}";
	}
}
?>
