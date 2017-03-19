<?php 
	include("dbconfig.php");
	/* Message */
	$msg = "";
	/* Making the author name safe */
	$author = trim($_POST["author"]);
	$author = htmlspecialchars($author);
	$author = strip_tags($author);
	$author = mysql_real_escape_string($author);
	/* Making the content safe */
	$content = trim($_POST["content"]);
	$content = htmlspecialchars($content);
	$content = strip_tags($content);
	$content = mysql_real_escape_string($content);
	/* Making the category info safe */
	$category = trim($_POST["category"]);
	$category = htmlspecialchars($category);
	$category = strip_tags($category);
	$category = mysql_real_escape_string($category);
	/*
	$ip = $_POST["ip"];
	*/
	$date = date("Y-m-d");
	
	if(!empty($author) && !empty($content) && !empty($category)){
		$query = "INSERT INTO posts (`author_id`, `content`, `category`, `date_publish`) VALUES ('$author', '$content', '$category', '$date')";
		$result = mysql_query($query);
		
		if($result){
			if(isset($_FILES["files"]) && !empty($_FILES["files"])){
				$files = $_FILES["files"];
				
				foreach ($files["error"] as $key => $error) {
					if ($error == UPLOAD_ERR_OK) {
						$ext = strtolower(pathinfo($files["name"][$key], PATHINFO_EXTENSION));
						/* Check File Type */
						if($ext == "png" || $ext == "jpg" || $ext == "jpeg"){
							$read_file = mysql_query("SELECT COUNT(`file_id`) as id FROM `files`");
							
							$file_inf = mysql_fetch_array($read_file);
							
							$newname = "file" . $file_inf["id"] . "." . $ext;
							
							if(move_uploaded_file( $files["tmp_name"][$key], "../upload/img/" . $newname)){
								$read_post = mysql_query("SELECT MAX(id) as id FROM `posts` WHERE `author_id` = '$author' ORDER BY `id` DESC");
								
								$post_inf = mysql_fetch_array($read_post);
								if(mysql_query("INSERT INTO `files` (`file_name`, `type`, `post_id`) VALUES ('$newname','1','" . $post_inf['id'] . "')")){
									//File uploaded succesfully
									$msg = "true";
								}else{
									//File failed uploading in the database
									$msg = "false";
								}
							}else{
								//File failed uploading in the file system
								$msg = "false";
							}
						}elseif($ext == "mp3" || $ext == "mp4" || $ext == "wav"){
							$read_file = mysql_query("SELECT COUNT(`file_id`) as id FROM `files`");
							
							$file_inf = mysql_fetch_array($read_file);
							
							$newname = "file" . $file_inf["id"] . "." . $ext;
							
							if(move_uploaded_file( $files["tmp_name"][$key], "../upload/video/" . $newname)){
								$read_post = mysql_query("SELECT MAX(id) as id FROM `posts` WHERE `author_id` = '$author' ORDER BY `id` DESC");
								
								$post_inf = mysql_fetch_array($read_post);
								if(mysql_query("INSERT INTO `files` (`file_name`, `type`, `post_id`) VALUES ('$newname','2','" . $post_inf['id'] . "')")){
									//File uploaded succesfully
									$msg = "true";
								}else{
									//File failed uploading in the database
									$msg = "false";
								}
							}else{
								//File failed uploading in the file system
								$msg = "false";
							}
						}else{
							//Not supported format
							$msg = "false";
						}
					}
				}
			}else{
				//Post without imgs
				$msg = "true";
			}
		}
	}else{
		//Failed to save the post in the database
		$msg = "false";
	}
	
	echo $msg;
?>