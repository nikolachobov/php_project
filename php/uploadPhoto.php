<?php 
	include("dbconfig.php");
	
	if(isset($_POST["profile"]) && isset($_FILES["file"])){
		$profile = $_POST["profile"];
		$file = $_FILES["file"];
		$type = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
		$size = $_FILES["file"]["size"];
		
		if($type == "png" || $type == "jpg" || $type == "jpeg"){
			if($size < 150000){
				/* Prepare to insert img */
				$imgData = addslashes(file_get_contents($file['tmp_name']));
					
				$query = "UPDATE `profile_pictures` SET `img`='{$imgData}', `type`='$type' WHERE `user`='$profile'";
				
				$res = mysql_query($query);
				
				if($res){
					echo "true";
				}else{
					echo "File failed to upload";
				}
			}else{
				echo "The file is too large";
			}
		}else{
			echo "This file is not an image";
		}
	}else{
		echo "No information";
	}
?>