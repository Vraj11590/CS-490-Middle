<?php
	
	include 'post_back.php';


	$options = array(
	    'http' => array(
	        'method'  => 'POST',
	        'content' => json_encode( "test" ),
	        'header'=>  "Content-Type: application/json\r\n" .
	                    "Accept: application/json\r\n"
	      )
	);

	$data = json_encode($options);


	$test = post_data($options,"t");

	echo $test;

?>