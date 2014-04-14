<?php 

	require_once("curl.php");



	$data = $_POST;

	//echo json_encode($data);

	
	if($_POST['flag'] == "Send Quizzes"){
	
			$url = "http://osl82.njit.edu/~sjt5/las/quizbank.php";

		
			$result = CurlPost($data, $url);

			// $data = json_decode($result);
			// print_r($data);

			echo $result;			

	}



?>