<?php 

	require_once("curl.php");


	//echo json_encode( array ( "middle" => "yes",$_POST['flag']) );

	$flag = $_POST['flag'];
	if($flag == "Quiz By ID"){


		//echo json_encode( array ( "middle" => "yes", "data" => $quizID) );


		$url = "http://osl82.njit.edu/~sjt5/las/takequiz.php";

		$result = CurlPost($_POST, $url);

		//$data = json_decode($result);
		// // print_r($data);

		echo $result;			

	}


?>