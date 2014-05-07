<?php 
	
	session_start();

	if(isset($_SESSION['sid'])){
		echo json_encode(array('status'=> $_SESSION['allow'], 'sid' => $_SESSION['sid']));
	}else{
		echo json_encode(array('status'=> 'No'));
		session_destroy();
	}


?>