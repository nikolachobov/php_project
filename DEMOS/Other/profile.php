<?php
	session_start();
	include("../php/dbconfig.php");
	
	if( !isset($_SESSION['user']) ) {
		header("Location: ../index.php");
		exit;
	}
	
	if(isset($_GET["key"])){
		
		$key = $_GET["key"];
		
		$read_profile = mysql_query("SELECT users.user_id as id, users.user_fname as fname, users.user_lname as lname, profile_pictures.img, profile_pictures.picture_id as img_id FROM users LEFT JOIN profile_pictures ON users.user_id = profile_pictures.user WHERE user_key = '$key' AND date_deleted IS NULL");
		
		$count = mysql_num_rows($read_profile);
		
		if($count > 0){
			while($row = mysql_fetch_assoc($read_profile)){
				$fname = $row["fname"];
				$lname = $row["lname"];
				$user_id = $row["id"];
				$user_img = $row["img"];
				$img_id = $row["img_id"];
			}
		}else{
			$fname = "Empty";
			$lname = "Empty";
		}
	}
	
	$res = mysql_query("SELECT profile_pictures.img, users.* FROM users INNER JOIN profile_pictures ON users.user_id = profile_pictures.user WHERE users.user_id ='" . $_SESSION["user"] . "'");
	/* Information */
	$inf = mysql_fetch_assoc($res);
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Hello world</title>
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
		<!-- Profile Style -->
		<link rel="stylesheet" type="text/css" href="../style/profile.css">
		<!-- Player Style -->
		<link rel="stylesheet" type="text/css" href="../style/player.css">
	</head>
	<body onload="Update('local','<?php echo $key; ?>')">
		<div class="modals">
			<!--///////////////-->
			<!-- Modal Section -->
			<!--///////////////-->
			<div class="uploadFile modal">
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
					<form action="../pages/other/no-js.html" method="post" enctype="multipart/form-data" class="uploadForm" onsubmit="return false;">
						<label class="upload-wrap">
							<div class="upload-btn">
								<p>
									<img width="200" height="200" src="../img/file.svg" alt="Upload File">
								</p>
								<input type="file" name="file" onchange="showUpload(this);">
								<span class="upload">Избери файл</span>
								<p>Поддържани формати JPEG,JPG,PNG</p>
							</div>
						</label>
						<input type="hidden" name="profile" value="<?php echo $inf["user_id"];?>" id="profile">
						<input type="submit" name="upload" id="submitfile" onclick="uploadFile(1);" style="display: none;">
					</form>
				</div>
				<div class="modalFoot">
					<button class="btn-5" onclick="document.getElementById('submitfile').click();">Качи</button>
					<button class="btn-6" onclick="hideModal(1); resetUpload(1);">Затвори</button>
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
									<img src="../php/displayPhoto.php?id=<?php echo $inf["user_id"]; ?>" class="response-img" alt="">
								<?php } ?>
							</div>
							<div class="content" id="profile_menu">
								<ul>
									<li>
										<a href="main.php" class="menu-item">
											<div class="icon-holder">
												<span class="user big home"></span>
											</div>
											<p>Начало</p>
										</a>
									</li>
									<li>
										<a href="profile.php?key=<?php echo $inf["user_key"]; ?>" class="menu-item">
											<div class="icon-holder">
												<span class="user big power"></span>
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
		<header class="profile-review">
			<div class="container-md">
				<div class="profile-img-big">
					<?php if(empty($user_img)){ ?>
						<img src="../img/logo.png" class="response-img" alt="">
					<?php }else{ ?>
						<img src="../php/displayPhoto.php?id=<?php echo $img_id ?>" class="response-img" alt="">
					<?php } ?>
				</div>
				<p><?php echo $fname . " " . $lname; ?></p>
			</div>
			<?php if($_SESSION['user'] == $user_id){ ?>
			<button class="change-photo" onclick="showModal(1);">
				<span class="icon normal photo"></span>
			</button>
			<?php } ?>
		</header>
		<section>
			<div class="container-md">
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
		</section>
		<script>
			var modal = document.getElementsByClassName("modals")[0];
			
			var box = document.getElementById("modal");
			
			/* Update posts every 1 minute */
			window.setInterval(function(){
				Update("local", "<?php echo $user_key; ?>");
			}, 60000);
		</script>
		<script src="../js/dropdown.js"></script>
		<script src="../js/update_post.js"></script>
		<script src="../js/logout.js"></script>
		<script src="../js/profilePhoto.js"></script>
		<script src="../js/modal.js"></script>
		<script src="../js/player.js"></script>
	</body>
</html>