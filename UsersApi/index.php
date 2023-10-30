<?php
if (isset($_SERVER['REQUEST_URI'])) {
    $uri = $_SERVER['REQUEST_URI'];
    $uriParts = explode('/', $uri);
	$uriParts = array_slice($uriParts, 4);
} else {
    $uriParts = [];
}
// Check if 

if (isset($uriParts[0])) {
	// Check for API endpoint
	if($uriParts[0] === 'Test'){
		require 'Logic/EndpointScripts/Test.php';
	} elseif($uriParts[0] === 'CreateUser') {
		require 'Logic/EndpointScripts/CreateUser.php';
	} elseif($uriParts[0] === 'GetUsers') {
		require 'Logic/EndpointScripts/GetUsers.php';
	} elseif($uriParts[0] === 'GetUser') {
		require 'Logic/EndpointScripts/GetUser.php'; 	
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
?>
