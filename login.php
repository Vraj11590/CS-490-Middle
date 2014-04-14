<?php 

	//include curl.php

	require_once("curl.php");

	$data = array("ucid" => $_POST['ucid'], "pass" => $_POST['pass']);

  	//define URLs
	$url = "http://osl81.njit.edu/~vp78/las/back_test/back.php";
	//$url = "http://osl81.njit.edu/~sjt5/las/back.php";


	$result = CurlPost($data, $url);

	//decode returned json
	$data = json_decode($result);


	//check if login was successfull
	if($data->	Login == "Success"){
		//do some session work
		session_start(); // start up session! 
		$_SESSION['type'] = "professor"; // store session data
		$_SESSION['ucid'] = $data->Name;

		echo json_encode($data);


	}else if($data->Login == "Failed"){
		echo json_encode($data);
	}


	curl_close($ch);

?>