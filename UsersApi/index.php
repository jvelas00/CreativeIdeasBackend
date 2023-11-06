<?php
// Allow requests from any origin
header("Access-Control-Allow-Origin: *");

// Allow the following HTTP methods
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

// Allow the following headers to be sent with the request
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
	} elseif($uriParts[2] === 'CreateUser') {
		require 'Logic/EndpointScripts/CreateUser.php';
	} elseif($uriParts[2] === 'GetUsers') {
		require 'Logic/EndpointScripts/GetUsers.php';
	} elseif($uriParts[2] === 'Login') {
		require 'Logic/EndpointScripts/Login.php'; 	
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
