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
	if($act == "QuestionMakeTF"){
		$result = CurlPost($data,$url);
		echo $result;		
	}
	if($act == "QuestionMakeFB"){
		$result = CurlPost($data,$url);
		echo $result;			
	}
	if($act == "send_all_quizzes"){
		$result = CurlPost($data,$url);
		echo $result;			
	}
	if($act == "send_quiz_by_id"){
		// echo json_encode($_POST);
		$result = CurlPost($data,$url);
		echo $result;		
	}

?>


