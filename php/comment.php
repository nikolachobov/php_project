<?php 
	include("dbconfig.php");
	
	if(isset($_POST['author']) && isset($_POST['comment']) && isset($_POST['post_id'])){
		
		$comment = $_POST['comment'];
		$author = $_POST['author'];
		$post_id = $_POST['post_id'];
		
		
		if(!empty($comment)){
			$query = mysql_query("INSERT INTO `comments` (`comment_cont`, `comment_author`, `post_id`) VALUES ('$comment', '$author', '$post_id')");
			
			if($query){
				echo "true";
			}else{
				echo "Failed to save your comment";
			}
		}else{
			echo "Write a comment first";
		}
		
		unset($_POST['post']);
	}
?>