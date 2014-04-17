<?php 
	require_once("curl.php");
	require_once("globals.php");

	$data = array("ucid" => $_POST['ucid'], "pass" => $_POST['pass']);

  	// define URLs
	$url =  $back_url . "/login.php";


	$result = CurlPost($data, $url);
  
	//decode returned json
	$data = json_decode($result);

	//check if login was successfull
	if($data->allow == "Yes"){
		// do some session work
		session_start(); // start up session! 
		$sid = session_id();
		$_SESSION['type'] = "teacher"; // store session data
		$_SESSION['ucid'] = $data->ucid;
		$_SESSION['time'] = time();
		$_SESSION['name'] = $data->name;
		$_SESSION['sid'] = $sid;
		$_SESSION['allow'] = "Yes";



		echo json_encode($_SESSION);
	}else if($data->allow == "No"){
		//redirect to a ivalid login
		//does the front redirect or back?
		echo json_encode($data);
	}



?>