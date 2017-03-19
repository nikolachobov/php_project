<?php 
	include("dbconfig.php");
	
	$id = $_POST["post_id"];
	
	$showComments = mysql_query("SELECT `comments`.*, `users`.* FROM `comments` INNER JOIN `users` ON `comments`.`comment_author` = `users`.`user_id` WHERE `comments`.`post_id` = '$id' ORDER BY `comments`.`comment_id` DESC");
										
	$countComments = mysql_num_rows($showComments);
										
	if($countComments > 0){
		/* How many Current messages to display */
		$i = 3;
		while($i > 0 && $row = mysql_fetch_assoc($showComments)){
			echo "<div class='comment-box'>
				<!-- Profile img -->
				<div class='col-2'>
					<a href='profile.php?key=" . $row["user_key"] . "'>
						<div class='profile-img-small'>
							<img src='../img/logo.png' class='response-img' alt=''>
						</div>
					</a>
				</div>
				<!-- Comment -->
				<div class='col-8'>
					<span><b>" . $row["user_fname"] . " " . $row["user_lname"] . ":</b> " . $row['comment_cont'] . "</span>
				</div>
			</div>";
			$i--;
		}
	}else{
		echo "No comments";
	}
?>