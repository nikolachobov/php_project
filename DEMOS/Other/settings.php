<?php 
	session_start();
	include("../php/dbconfig.php");
	
	if( !isset($_SESSION['user']) ) {
		header("Location: ../index.php");
		exit;
	}
	
	$res = mysql_query("SELECT * FROM users WHERE user_id ='" . $_SESSION["user"] . "'");
	/* Information */
	$inf = mysql_fetch_assoc($res);
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Settings</title>
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
		<!-- Settings Style -->
		<link rel="stylesheet" type="text/css" href="../style/settings.css">
		<!-- Badge Style -->
		<link rel="stylesheet" type="text/css" href="../style/badge.css">
		<!-- Form Style -->
		<link rel="stylesheet" type="text/css" href="../style/form.css">
	</head>
	<body>
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
										<div class="menu-item">
											<div class="icon-holder">
												<span class="icon big power"></span>
											</div>
											<p>Настройки</p>
										</div>
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
		<div class="settings-wrap">
			<div class="settings-page">
				<div class="row" style="position: relative; min-height: 500px;">
					<div class="col-4" style="text-align: center;position: absolute;top: 0;left: 0;height: 100%;">
						<div class="profile-wrap">
							<div class="profile">
								<div class="profile-img-big">
									<?php if(empty($inf["img"])){ ?>
										<img src="../img/logo.png" class="response-img" alt="">
									<?php }else{ ?>
										<img src="../php/displayPhoto.php?id=<?php echo $inf["user_id"] ?>" class="response-img" alt="">
									<?php } ?>
								</div>
								<div class="username">
									<?php  echo $inf["user_fname"] . " " . $inf["user_lname"]; ?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-6" style="position: absolute; top: 0; right: 0;height: 100%;">
						<div class="badge-wrap">
							<span class="badge-title">Настройки</span>
							<div class="badge">
								<span class="badge-icon">
									<span class="icon normal settings"></span>
								</span>
							</div>
						</div>
						<form class="settings-form form" id="form" action="pages/no-js.html" method="post" onsubmit="return false;" autocomplete="off">
							<fieldset>
								<legend>Смени паролата</legend>
								<label class="input-holder">
									<input type="password" name="pass">
									<span class="err">
										!
									</span>
									<span class="succ">
										✓
									</span>
								</label>
							</fieldset>
							<fieldset>
								<legend>Повтори новата парола</legend>
								<label class="input-holder">
									<input type="password" name="repeat">
									<span class="err">
										!
									</span>
									<span class="succ">
										✓
									</span>
								</label>
							</fieldset>
							<fieldset>
								<legend>Смени профилната си снимка</legend>
								<input type="file" name="picture">
							</fieldset>
							<input type="submit"  name="set" value="Save">
						</form>
					</div>
				</div>
			</div>
		</div>
		<script src="../js/dropdown.js"></script>
		<script src="../js/logout.js"></script>
		<script src="../js/register.js"></script>
	</body>
</html>