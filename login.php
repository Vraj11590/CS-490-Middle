<?php 
	require_once("curl.php");
	require_once("globals.php");
	require_once("session_handler.php");

	$data = array("ucid" => $_POST['ucid'], "pass" => $_POST['pass']);

  	// define URLs
	$url =  $back_url . "/login.php";

	$result = CurlPost($data, $url);

	//decode returned json
	$data = json_decode($result);

	//check if login was successfull
	if($data->allow == "Yes"){
		// do some session work
		session_start();
		$sid = $data->ucid;
		$_SESSION['type'] = $data->type; // store session data
		$_SESSION['ucid'] = $data->ucid;
		$_SESSION['time'] = time();
		$_SESSION['name'] = $data->name;
		$_SESSION['allow'] = "Yes";

		$add = json_decode( on_session_write($sid, $_SESSION) ); 


		if($add->message == "session_begin"){
			echo json_encode($_SESSION);
		}
		if($add->message == "session_exists"){
			
			echo json_encode(array("message"=>"redirect"));
		}

		//over here if $test returns a good save to the db then we proceed.

	}else if($data->allow == "No"){
		//redirect to a ivalid login
		//does the front redirect or back?
		session_destroy();
		echo json_encode($data);
	}


?>