<?php
	if(!defined("name")){
		include("dbconfig.php");
	}
	if(!empty($_GET['type']) && !empty($_GET['key'])){
		
		$user_key = $_GET["key"];
		
		if($_GET['type']=='global'){
			$user_inf = mysql_query("SELECT `users`.`user_id`, `users`.`user_key`, `users`.`user_fname`, `users`.`user_lname`, `profile_pictures`.`img`, `profile_pictures`.`picture_id`
								FROM `users`
								INNER JOIN `profile_pictures`
								ON `users`.`user_id` = `profile_pictures`.`user`
								WHERE `users`.`user_key` = '$user_key'");
							 
			$user = mysql_fetch_array($user_inf);
			
			$post = mysql_query("SELECT `posts`.`id` as post, `users`.`user_id` as id, `users`.`user_fname` as fname, `users`.`user_lname` as lname, `users`.`user_key` as link, `posts`.`date_publish` as date, `posts`.`content` as content, `posts`.`category` as category
								 FROM `posts`
								 INNER JOIN `users`
								 ON `posts`.`author_id` = `users`.`user_id`
								 WHERE `posts`.`date_deleted` IS NULL
								 ORDER BY `posts`.`id` DESC");
		}elseif($_GET['type']=='local'){
			
			$user_inf = mysql_query("SELECT `users`.`user_id`, `users`.`user_key`, `users`.`user_fname`, `users`.`user_lname`, `profile_pictures`.`img`, `profile_pictures`.`picture_id`
							 FROM `users`
							 INNER JOIN `profile_pictures`
							 ON `users`.`user_id` = `profile_pictures`.`user`
							 WHERE `users`.`user_key` = '$user_key'");
							 
			$user = mysql_fetch_array($user_inf);
			
			/* Search query */
			$post = mysql_query("SELECT `posts`.`id` as post, `users`.`user_id` as id, `users`.`user_fname` as fname, `users`.`user_lname` as lname, `users`.`user_key` as link, `posts`.`date_publish` as date, `posts`.`content` as content, `posts`.`category` as category
								 FROM `posts`
								 INNER JOIN `users`
								 ON `posts`.`author_id` = `users`.`user_id`
								 WHERE `posts`.`date_deleted` IS NULL AND `users`.`user_key` = '$user_key'
								 ORDER BY `posts`.`id` DESC");
		}
		/* Posts Counter */
		$post_count = mysql_num_rows($post);
?>			
<!doctype html>
<html>
	<body>
		<?php
			if($post_count > 0){
				while($row = mysql_fetch_assoc($post)){	
		?>
			<div class='post'>
				<div class='post-head'>
					<div class='col-5'>
						<a style='display: inline-block;' href='profile.php?type=local&key=<?php echo $row["link"];  ?>'>
							<div class='profile-img-small'>
								<?php
								$img = mysql_query("SELECT `profile_pictures`.`img` FROM `profile_pictures` INNER JOIN `users` ON `users`.`user_id` = `profile_pictures`.`user` WHERE `profile_pictures`.`user`='  $row[id]  '");
											
								$dspImg = mysql_fetch_assoc($img);
											
								if(!empty($dspImg['img'])){ ?>
									<img src='../php/displayPhoto.php?id=<?php echo $row['id']; ?>' class='response-img' alt=''>
									;
								<?php }else{ ?>
									<img src='../img/logo.png' class='response-img' alt=''>;
								<?php } ?>		
							</div> 
							<span class='post-author'><?php echo $row['fname'] . " " . $row['lname']  ?></span> 
						</a> 
					</div> 
					<div class='col-5' style='text-align: right;'> 
						<span style='margin-right: 10px;'>Публикувано на   <?php echo date('d/m/Y', strtotime($row['date'])); ?>   в група <a href='#group'><?php echo $row['category'];  ?></a></span> 
					</div> 
				</div> 
				<div class='post-cont'> 
					<div class='post-review'> 
						<p><?php echo $row['content'];  ?></p> 
						<div class='player'>
						<?php
						$dsp = mysql_query("SELECT `files`.`file_id`, `files`.`file_name`, `files`.`type` FROM `files` INNER JOIN `posts` ON `files`.`post_id` = `posts`.`id` WHERE `posts`.`id` = '  $row[post]  '");
										
						if(mysql_num_rows($dsp) > 0){ ?>
							<!-- Img List -->
							<ul>
							<?php 
							while($dsp_inf = mysql_fetch_assoc($dsp)){
								if($dsp_inf['type'] == 'photo'){ ?>
									<li style='display: inline-block; margin: 10px;'>
										<img width='400' src='../upload/img/<?php  echo $dsp_inf['file_name'];  ?>' alt=''>
									</li>
							<?php
								}elseif($dsp_inf['type'] == 'video'){ ?>
									<li style='display: block; margin-top: 15px;'>
										<div class='videoWrap'>
											<audio class='music' ontimeupdate='changeRange(this);'>
												<source src='../upload/video/<?php echo $dsp_inf['file_name']; ?>'>
											</audio>
											<div class='videoCont'>
												<span class='icon big volume-up'></span>
											</div>
											<div class='videoActions'>
												<div class='innerAct'>
													<h3><?php echo $dsp_inf['file_name'];  ?></h3>
													<input type='range' value='0' min='0' max='100' oninput='thisparentElementparentElementparentElementgetElementsByTagName(\audio\)[0]pause();' onchange='seekVid(this)' class='range'>
													<ul>
														<li>
															<button class='small-btn' onclick='changeVolume(this);'>
																<span class='icon small volume-up'></span>
															</button>
														</li>
														<li>
															<button class='big-btn' onclick='playVid(this);'>
																<span class='icon normal play'></span>
															</button>
														</li>
														<li>
															<button class='small-btn' onclick='replayVid(this);'>
																<span class='icon small replay'></span>
															</button>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</li>
								<?php 
								}
							} ?>
							</ul>
						<?php
						} ?>
						</div> 
					</div> 
				</div> 
				<!--
				<div class='post-actions'> 
					<div class='row'> 
						<div class='col-10'> 
							<ul> 
								<li><a href='#visit' class='btn-2'><span class='icon like'></span></a><span class='count'>10</span></li> 
								<li><a href='#visit' class='btn-2'><span class='icon comment'></span></a><span class='count'>200</span></li> 
							</ul> 
						</div> 
					</div> 
				</div>
				-->
				<div class='comment-post'>
					<form action='' method='post' class='comment-wrap' onsubmit='commentPost(this,<?php echo  $row["post"]; ?> ); return false;'>
						<div class='row'>
							<div class='col-2'>
								<a style='display: inline-block;' href='../pages/profile.php?type=local&key=<?php echo $user["user_key"]; ?>'>
									<div class='profile-img-small'>
										<?php
											if(!empty($user['img'])){ ?>
												<img src='../php/displayPhoto.php?id=<?php echo  $user['picture_id'];  ?>' class='response-img' alt=''>;
										<?php
										}else{ ?>
												<img src='../img/logo.png' class='response-img' alt=''>;
										<?php
										} ?>
									</div>
								</a>
							</div>
							<div class='col-8'>
								<textarea class='comment'></textarea>
								<input type='hidden' name='author' class='author' value='<?php echo $user['user_id']; ?>'>
								<input type='hidden' name='post_id' class='post_id' value='<?php echo $row['post'];  ?>'>
							</div>
							<div class='col-10'>
								<button class='btn-7' name='post'>Коментирай</button>
							</div>
						</div>
					</form>
					<div class='post-comments'>
						<p>Коментари</p>
						<div class='comments'>
						<?php
							$showComments = mysql_query("SELECT * FROM `comments` INNER JOIN `users` ON `comments`.`comment_author` = `users`.`user_id` INNER JOIN `posts` ON `comments`.`post_id` = `posts`.`id` WHERE `posts`.`id`='  $row[post]  ' ORDER BY `comments`.`comment_id` DESC");
												
							$countComments = mysql_num_rows($showComments);
																			
							if($countComments > 0){
								$i = 3;
								while($i > 0 && $row = mysql_fetch_assoc($showComments)){ ?>
									<div class='comment-box'>
										<!-- Profile img -->
										<div class='col-2'>
											<a href='../pages/profile.php?type=local&key=<?php echo $row["user_key"]; ?>'>
												<div class='profile-img-small'>
														<img src='../img/logo.png' class='response-img' alt=''>
												</div>
											</a>
										</div>
										<!-- Comment -->
										<div class='col-8'>
												<span><b><?php echo $row['user_fname'] . " " . $row['user_lname'];  ?>:</b><?php echo   $row['comment_cont']; ?></span>
										</div>
									</div>
									<?php
									$i--;
								}
							}else{
								echo "Все още няма коментари Бързо напиши един преди своите приятели!";
							} ?>
						</div>
					</div>
				</div>
			</div>
			<?php
				}
			}else{ ?>
				<div class='post'><p class='no-posts'>Все още няма публикации тук :(</p></div>
			<?php
			}
	}else{
		echo "No key set";
	}			
			?>