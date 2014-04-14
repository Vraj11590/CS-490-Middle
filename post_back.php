<?php

	echo "post_back.php";

	function post_data($json_string, $key){
		
		$data = $json_string;
		
		$url = "osl81.njit.edu/~vp78/las/index.php";

		$curl = curl_init($url);
		
		curl_setopt($curl, CURLOPT_HEADER, false);

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //curl error SSL certificate problem, verify that the CA cert is OK

		$result = curl_exec($curl);

		//response from back
		$response = json_decode($result);

		//close curl connection
		curl_close($curl);

		//return the json that will be given back
		return var_dump($response);


	}
?>