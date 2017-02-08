<?php
	
	// This phph file runs on my local Apache server installed via XAMPP.
	// It is fetched both by the Angular app and the jQuery app.
	
	// http://127.0.0.1:58460 is the origin location of the Angular app.
	// http://127.0.0.1:64853 is the origin location of the jQuery app.
	
	$httpOrig = $_SERVER['HTTP_ORIGIN'];
	$reqMethod = $_SERVER['REQUEST_METHOD'];
	
	if ($reqMethod === "OPTIONS") {
		if ($httpOrig === 'http://127.0.0.1:58460' || $httpOrig === 'http://127.0.0.1:64853') {
			header('Access-Control-Allow-Origin: *');
			header('Access-Control-Allow-Headers: Authorization');
		}
	} else if ($reqMethod === "GET") {
		$headers = apache_request_headers();
		if ($headers['Authorization'] === 'Bearer TOKEN123456789') {
			header('Access-Control-Allow-Origin: *');
			header('Content-type: application/json');

			$json = array(
				 array(
					"street" => "Martin Ennalsplein 1",
					"zip" => "1102AB",
					"city" => "Amsterdam"
				 ),
				 array(
					"street" => "Van Cranenborchstraat 7",
					"zip" => "6552BM",
					"city" => "Nijmegen"
				 ),
				 array(
					"street" => "Heiligenbos 55",
					"zip" => "5351SW",
					"city" => "Berghem"
				 )
			);

			echo json_encode( $json );
		}
	}
	
?>
