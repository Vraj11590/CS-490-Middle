<?php 

	$data = $_POST;

	$str = http_build_query($data);


	$url = "http://osl82.njit.edu/~sjt5/las/quiz.php";

 	$ch = curl_init();


	//curl settings
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
	curl_setopt ($ch, CURLOPT_POST, true);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, $str);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt ($ch, CURLOPT_HEADER, false);
    
	//header has to be commented out when sending multidimensional array
   //curl_setopt ($ch, CURLOPT_HTTPHEADER, array("Content-type: multipart/form-data") );


	$result = curl_exec($ch);

	echo $result;

	curl_close($ch);	


?>