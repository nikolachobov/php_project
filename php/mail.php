<?php 
	include("dbconfig.php");
	
	if(isset($_POST["email"])){
		$val = $_POST["email"];
		$query = "SELECT `user_email` FROM users WHERE `user_email`='$val'";
		$result = mysql_query($query);
		$count = mysql_num_rows($result);
		
		if($count != 0){
			echo "true";
		}else{
			echo "false";
		}
	}else{
		echo "false";
	}
?>