<?php

	 // $url = $back_url."/session_handler.php";

			
	function on_session_write($key, $val) {


		//$key = sessionid
		//$val = all the session data

		//set up data array to store in the table
		$data = array('do'=>'create_session','sid'=>$key,'session_data'=>$val);

		// First we try to insert, if that doesn't succeed, it means
		// session is already in the table and we try to update
		// $result = CurlPost($data,$url);

		$url = "http://back.codingcat.vj/session_handler.php";

	 	$ch = curl_init();

		//curl settings
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
		curl_setopt ($ch, CURLOPT_POST, true);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);

		//curl_setopt ($ch, CURLOPT_HEADER, false);
		//header has to be commented out when sending multidimensional array
	    //curl_setopt ($ch, CURLOPT_HTTPHEADER, array("Content-type: multipart/form-data") );

		$result = curl_exec($ch);
		curl_close();


		return $result;

	}

	function on_session_destroy($token){
		$data = array('do'=>'delete_session','sid'=> $token );

		// First we try to insert, if that doesn't succeed, it means
		// session is already in the table and we try to update
		// $result = CurlPost($data,$url);

		$url = "http://back.codingcat.vj/session_handler.php";

	 	$ch = curl_init();
		//curl settings
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
		curl_setopt ($ch, CURLOPT_POST, true);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);

		//curl_setopt ($ch, CURLOPT_HEADER, false);
		//header has to be commented out when sending multidimensional array
	    //curl_setopt ($ch, CURLOPT_HTTPHEADER, array("Content-type: multipart/form-data") );

		$result = curl_exec($ch);
		curl_close();


		return $result;		

	}

?>