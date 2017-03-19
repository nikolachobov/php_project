<?php 
	include("dbconfig.php");
	
	$msg = "";
	
	if(isset($_POST["profile"]) && isset($_FILES["file"])){
		
		$profile = $_POST["profile"];
		
		$song_name = $_POST["song_name"];
		
		$file = $_FILES["file"];
		
		$temp_name = $file["tmp_name"];
		
		var_dump($file);
		
		if(!empty($file) && !empty($song_name)){
			/* File Error msg */
			switch($_FILES["file"]["error"]){
				case 0:
					$msg .= "Everything is OK";
					break;
				case 1:
					$msg .= "The uploaded file exceeds the upload_max_filesize directive";
					break;
				case 2:
					$msg .= "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.";
					break;
				case 3:
					$msg .= "The uploaded file was only partially uploaded.";
					break;
				case 4:
					$msg .= "No file was uploaded.";
					break;
				case 6:
					$msg .= "Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.";
					break;
				case 7: 
					$msg .= "Failed to write file to disk. Introduced in PHP 5.1.0.";
					break;
				case 8:
					$msg .= "File upload stopped by extension. Introduced in PHP 5.2.0.";
					break;
				default:
					$msg .= "Undefined Error";
			};
			/* File uploading */
			if($file["error"] == 0){
				
				$ext = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
				
				if($ext == "mp3" || $ext == "mp4" || $ext == "wav"){
					
					$res = mysql_query("SELECT COUNT(`file_id`) as id FROM `uploads`.`files`");
					
					if($res){
						$inf = mysql_fetch_array($res);
						
						$newname = "file" . $inf["id"] . "." . $ext;
						
						foreach($file as $key => $value){
							echo "<p>$key => $value</p>";
						}
						
						move_uploaded_file($temp_name, "../upload/video/" . $newname);
						
						if(mysql_query("INSERT INTO `uploads`.`files`(`file_name`,`type`, `song_name`, `user`) VALUES ('$newname','video','$song_name','$profile')")){
							$msg .= "File uploaded succesfully";
						}else{
							$msg .= "File failed uploading";
						}
					}else{
						$msg .= "Fail";
					}
				}else{
					$msg .= "Not supported format";
				}
			}
			
			unset($song_name);
			unset($file);
			unset($file_name);
		}else{
			$msg .= "File failed";
		}
	}else{
		$msg .= "Select file first";
	}
	
	echo $msg;
?>