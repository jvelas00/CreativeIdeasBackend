<?php
if (isset($_SERVER['REQUEST_URI'])) {
    $uri = $_SERVER['REQUEST_URI'];
    $uriParts = explode('/', $uri);
	$uriParts = array_slice($uriParts, 3);
} else {
    $uriParts = [];
}
// Check if 

if (isset($uriParts[1])) {
	// Check for API endpoint
	if($uriParts[1] === 'Test'){
		require 'Logic/EndpointScripts/Test.php';
	} elseif($uriParts[1] === 'getInventory') {
		require 'Logic/EndpointScripts/getInventory.php';
	} elseif($uriParts[1] === 'editQty') {
		require 'Logic/EndpointScripts/editQty.php';
	} elseif($uriParts[1] === 'addItem') {
		require 'Logic/EndpointScripts/addItem.php'; 	
	} else {
		header('HTTP/1.1 404 Not Found');
		echo 'No endpoint for';
		for($i = 0; $i < count($uriParts); $i++) {
			echo "/{$uriParts[$i]}";
		}
	}
} else {
    header('HTTP/1.1 404 Not Found');
	echo "No specified endpoint in URI";
	for($i = 0; $i < count($uriParts); $i++) {
		echo "/{$uriParts[$i]}";
	}
}
