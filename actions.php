<?php

	include 'curl.php';

	//action
	$act = $_POST['action'];
	$data = $_POST;
	$url = "http://back.codingcat.vj/actions.php";

	if($act == "QuestionMakeOE"){
		$result = CurlPost($data,$url);
		echo $result;
	}
	if($act == "QuestionMakeMC"){
		$result = CurlPost($data,$url);
		echo $result;	
	}


?>