<?php 
	include("dbconfig.php");
	
	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$id = trim($id);
		$id = mysql_real_escape_string($id);
		
		$res = mysql_query("SELECT `img`, `type` FROM `profile_pictures` WHERE `picture_id`= '$id'");
		
		$count = mysql_num_rows($res);
		
		if($count > 0){
			$img = mysql_fetch_assoc($res);
		
			header("Content-type: image/" . $img["type"]);
		
			echo $img["img"];
		}else{
			echo "No image";
		}	
	}else{
		echo "Invalid Link";
	}
?>