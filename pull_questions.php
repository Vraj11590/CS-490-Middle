<?php 

	require_once("curl.php");



	$data = $_POST;

	//echo json_encode($data);

	
	if($_POST['flag'] == "Pull Questions"){
	
			$url = "http://back.codingcat.vj/testbank.php";

		
			$result = CurlPost($data, $url);

			// $data = json_decode($result);
			// print_r($data);

			echo $result;			

	}


?>