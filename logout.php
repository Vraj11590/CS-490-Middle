<?php 
	include 'session_handler.php';


	$token = $_POST['token'];
	$do = on_session_destroy($token);

	echo $do;
?>