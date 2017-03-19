<?php
	session_start();
	include("../php/dbconfig.php");
	
	if( !isset($_SESSION['user']) ) {
		header("Location: ../index.php");
		exit;
	}
	
	$res = mysql_query("SELECT profile_pictures.img, users.* FROM users INNER JOIN profile_pictures ON users.user_id = profile_pictures.user WHERE users.user_id ='" . $_SESSION["user"] . "'");
	/* Information */
	$inf = mysql_fetch_assoc($res);
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Landing Page</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Layout Style -->
		<link rel="stylesheet" type="text/css" href="../style/layout.css">
		<!-- Post Style Sheet Navigaton Posts Box and More -->
		<link rel="stylesheet" type="text/css" href="../style/post.css">
		<!-- All icons used for buttons etc -->
		<link rel="stylesheet" type="text/css" href="../style/icons.css">
		<!-- Special Style using for development -->
		<link rel="stylesheet" type="text/css" href="../style/developer.css">
		<!-- Style for custom popup boxes -->
		<link rel="stylesheet" type="text/css" href="../style/modals.css">
		<!-- Drop down menu style -->
		<link rel="stylesheet" type="text/css" href="../style/dropdown.css">
		<!-- Player Style -->
		<link rel="stylesheet" type="text/css" href="../style/player.css">
		<!-- Form Style -->
		<link rel="stylesheet" type="text/css" href="../style/form.css">
	</head>
	<body onload="Update('global', '<?php echo $inf["user_key"]; ?>');">
		<div class="modals">
			<!--///////////////-->
			<!-- Modal Section -->
			<!--///////////////-->
			<div class="createPost modal">
				<div class="modalHeader">
					<a href="#profile" style="display: inline-block;">
						<div class="profile-img-small">
							<?php if(empty($inf["img"])){ ?>
								<img src="../img/logo.png" class="response-img" alt="">
							<?php }else{ ?>
								<img src="../php/displayPhoto.php?id=<?php echo $inf["user_id"] ?>" class="response-img" alt="">
							<?php } ?>
						</div>
					</a>
					<span><?php echo $inf["user_fname"] . " " . $inf["user_lname"]; ?></span>
				</div>
				<div class="modalCont">
					<!-- Main form -->
					<form id="post_box" action="#" method="post" onsubmit="return false;">
						<label class="input-holder">
							<div class="err-icon">!</div>
							<textarea placeholder="Напиши какво ще публикуваш" class="err-inp" name="content" id="content"></textarea>
						</label>
						<ul class="uploadBox-list" id="showPhoto">
						</ul>
						<ul id="showVideo">
						</ul>
						<div class="uploadLoader">
							<div>
							</div>
							<p>Публикува се</p>
						</div>
						<ul class="actionList">
							<li>
								<button onclick="showModal(2)">
									<span class="icon normal photo"></span>
								</button>
							</li>
							<!-- Upload Video Under Reconstruction -->
							<li>
								<button onclick="showModal(3)">
									<span class="icon normal video"></span>
								</button>
							</li>
						</ul>
						<input type="submit" name="regon" value="" style="display: none;" id="post">
						<input type="hidden" name="author" value="<?php echo $inf["user_id"]; ?>" id="author">
						<input type="hidden" name="category" value="None" id="category">
						<input type="file" name="photo" style="display: none;" multiple onchange="handleFiles(this.files,'photo');" id="uploadphoto">
						<input type="file" name="video" style="display: none;" multiple onchange="handleFiles(this.files,'video');" id="uploadvideo">
					</form>
					<!--/////////////////////////-->
				</div>
				<div class="modalFoot">
					<button onclick="submitPost();" class="btn-5" id="submit_post">Публикувай</button>
					<button onclick="hideModal(1); resetPost();" class="btn-6">Затвори</button>
				</div>
			</div>
			<div class="subModals">
				<!--///////////////-->
				<!-- Modal Section -->
				<!--///////////////-->
				<div class="uploadBox modal">
					<div class="modalHeader">
						<a href="#profile" style="display: inline-block;">
							<div class="profile-img-small">
								<?php if(empty($inf["img"])){ ?>
									<img src="../img/logo.png" class="response-img" alt="">
								<?php }else{ ?>
									<img src="../php/displayPhoto.php?id=<?php echo $inf["user_id"] ?>" class="response-img" alt="">
								<?php } ?>
							</div>
						</a>
						<span><?php echo $inf["user_fname"] . " " . $inf["user_lname"]; ?></span>
					</div>
					<div class="modalCont">
						<p style="padding: 2% 0; text-align:center; color: #444">Допустими формати: JPG, JPEG, PNG</p>
						<label class="uploadBox-btn" onclick="document.getElementById('uploadphoto').value = '';" for="uploadphoto">
							<!-- Upload Button -->
							<button class="btn-8">
								<span class="icon normal plus"></span>
							</button>
						</label>
					</div>
					<div class="modalFoot">
						<button class="btn-6" onclick="hideModal(2);">Затвори</button>
					</div>
				</div>
				<!--///////////////-->
				<!-- Modal Section -->
				<!--///////////////-->
				<div class="uploadBox modal">
					<div class="modalHeader">
						<a href="#profile" style="display: inline-block;">
							<div class="profile-img-small">
								<?php if(empty($inf["img"])){ ?>
									<img src="../img/logo.png" class="response-img" alt="">
								<?php }else{ ?>
									<img src="../php/displayPhoto.php?id=<?php echo $inf["user_id"] ?>" class="response-img" alt="">
								<?php } ?>
							</div>
						</a>
						<span><?php echo $inf["user_fname"] . " " . $inf["user_lname"]; ?></span>
					</div>
					<div class="modalCont">
						<p style="padding: 2% 0; text-align:center; color: #444">Допустими формати: MP3, MP4, WAV</p>
						<label class="uploadBox-btn" for="uploadvideo">
							<!-- Upload Button -->
							<button class="btn-8">
								<span class="icon normal plus"></span>
							</button>
						</label>
					</div>
					<div class="modalFoot">
						<button class="btn-6" onclick="hideModal(3);">Затвори</button>
					</div>
				</div>
			</div>
		</div>
		<nav class="main-menu">
			<div class="col-8">
				<ul class="nav-left">
					<li>
						<button class="btn-1" onclick="showMenu();">
							<span class="icon normal menu"></span>
						</button>
					</li>
					<li>
						<h2>Моят час!</h2>
					</li>
				</ul>
			</div>
			<div class="col-2">
				<ul class="nav-right">
					<li>
						<div class="dropdown">
							<div class="btn" id="mybtn">
								<?php if(empty($inf["img"])){ ?>
									<img src="../img/logo.png" class="response-img" alt="">
								<?php }else{ ?>
									<img src="../php/displayPhoto.php?id=<?php echo $inf["user_id"] ?>" class="response-img" alt="">
								<?php } ?>
							</div>
							<div class="content" id="profile_menu">
								<ul>
									<li>
										<a href="main.php" class="menu-item">
											<div class="icon-holder">
												<span class="icon big home"></span>
											</div>
											<p>Начало</p>
										</a>
									</li>
									<li>
										<a href="profile.php?key=<?php echo $inf["user_key"]; ?>" class="menu-item">
											<div class="icon-holder">
												<span class="icon big user"></span>
											</div>
											<p>Моят профил</p>
										</a>
									</li>
									<li>
										<a href="settings.php" class="menu-item">
											<div class="icon-holder">
												<span class="icon big settings"></span>
											</div>
											<p>Настройки</p>
										</a>
									</li>
									<li>
										<button class="menu-item" onclick="Logout();">
											<div class="icon-holder">
												<span class="icon big power"></span>
											</div>
											<p>Изход</p>
										</button>
									</li>
								</ul>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</nav>
		<div class="row">
			<div class="container-md">
				<div class="posts-header">
					<button class="btn-4" onclick="showModal(1)">
						<span class="icon normal plus"></span>
					</button>
				</div>
				<div class="posts">
					<!--///////////////////////////-->
					<!-- Here are placed the posts -->
					<!--///////////////////////////-->
					<div class="loader-wrap">
						<div class="loader">
						</div>
						<p>Зареждане</p>
					</div>
				</div>
				<div class="posts-footer">
					<div class="row">
						<div class="col-1">
							<button class="btn-1" onclick="window.scrollTo(0,0)">
								<span class="icon normal up"></span>
							</button>
						</div>
						<div class="col-9">
							<p>Няма повече публикации</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			/*
			function closeMenu(){
				document.getElementsByClassName("aside-menu")[0].style.left = "-30%";
			}
			
			function showMenu(){
				document.getElementsByClassName("aside-menu")[0].style.left = "0";
			}
			*/

			/* Update posts every 5 minutes */
			window.setInterval(function(){
				Update("global");
			}, 300000);
		</script>
		<script src="../js/dropdown.js"></script>
		<script src="../js/post.js"></script>
		<script src="../js/update_post.js"></script>
		<script src="../js/logout.js"></script>
		<script src="../js/player.js"></script>
		<script src="../js/modal.js"></script>
		<script src="../js/comment.js"></script>
	</body>
</html>