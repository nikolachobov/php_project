<?php
	session_start();
	$unset = session_unset();
	$logout = session_destroy();
	/* Check if session is destroyed */
	if($unset == true && $logout == true){
		echo "true";
	}else{
		echo "false";
	}
?>