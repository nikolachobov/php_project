<?php 
	if(isset($_FILES["file"]) && isset($_POST["profile"])){
		$profile = $_POST["profile"];
		$file = $_FILES["file"];
		$type = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
		
		if($type == "png" || $type == "jpg" || $type == "jpeg"){
			echo "The file is not image";
		}else{
			$imgData = addslashes(file_get_contents($file['tmp_name']));
			
			$res = mysql_query("INSERT INTO profile_pictures (`user`, `img`, `type`) VALUES ('$profile', '{$imgData}', '$type')");
			
			if($res){
				echo "Picture uploaded succesfully";
			}else{
				echo "Picture failed to be uploaded";
			}
		}
	}else{
		echo "Select picture first!";
	}
?>