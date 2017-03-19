<?php 
	include("dbconfig.php");
	
	$profile = $_POST["profile"];
	$file = $_FILES["file"];
	$type = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
	
	if($type == "png" || $type == "jpg" || $type == "jpeg"){
		/* Prepare to insert img */
		$imgData = addslashes(file_get_contents($file['tmp_name']));
		
		$imgData = base64_encode($imgData);
			
		$query = "INSERT INTO `profile_pictures` (`img`, `type`, `user`) VALUES ('{$imgData}', '$type', '$profile')";
		
		$res = mysql_query($query);
		
		if($res){
			echo "File uploaded succesfully";
		}else{
			echo "File failed to upload";
		}
	}else{
		echo "This file is not an image";
	}
?>