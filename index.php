<?php 
	session_start();
	
	if(isset($_SESSION['user'])!="" ) {
		header("Location: pages/main.php");
		exit;
	}
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Landing Page</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Layout Style -->
		<link rel="stylesheet" type="text/css" href="style/layout.css">
		<!-- Icons Feature -->
		<link rel="stylesheet" type="text/css" href="style/icons.css">
		<!-- For Response Img Feature -->
		<link rel="stylesheet" type="text/css" href="style/post.css">
		<!-- Main Page Style -->
		<link rel="stylesheet" type="text/css" href="style/landing.css">
		<!-- Form Style -->
		<link rel="stylesheet" type="text/css" href="style/form.css">
		<!-- Badge Style -->
		<link rel="stylesheet" type="text/css" href="style/badge.css">
	</head>
	<body>
		<header class="land-menu">
			<div class="row">
				<div class="col-10">
					<div class="nav-logo-wrap">
						<a href="index.php" class="small-logo">
							<img src="img/logo.png" width="60" alt="Logo">
							<h1>
								VratsaSoftwarePosts
							</h1>
						</a>
						<a href="#register" class="btn-5">Регистрирай ме</a>
						<a href="pages/login.php" class="btn-6">Влез</a>
					</div>
				</div>
				</div>
		</header>
		<header>
			<div class="landing-logo">
				<a href="index.php" class="big-logo">
					<img src="img/logo.png" width="200" alt="Logo">
					<h1>
						VratsaSoftwarePosts
					</h1>
				</a>
			</div>
		</header>
		<section class="slide-odd"  id="register">
			<h2 class="slide-title">Регистрация</h2>
			<form id="form" class="register-form" action="pages/no-js.html" method="post" onsubmit="submitForm('reg'); return false;" autocomplete="off">
				<div class="form-logo">
					<div class="logo">
						<img src="img/logo.png" width="100" height="100" alt="">
					</div>
				</div>
				<div class="form" id="regon">
					<fieldset>
						<legend>Ти си?</legend>
						<label class="input-holder" for="type">
							<select class="default" id="type">
								<option value="default">Ученик, Учител</option>
								<option value="student">Ученик</option>
								<option value="teacher">Учител</option>
							</select>
							<span class="sel">
								<span class="icon small down">
								</span>
							</span>
							<span class="err">
								<span class="icon small down">
								</span>
							</span>
							<span class="succ">
								<span class="icon small down">
								</span>
							</span>
						</label>
					</fieldset>
					<fieldset>
						<legend>Имена</legend>
						<div class="row">
							<div class="col-5" style="padding-right: 5px;">
								<label class="input-holder">
									<input type="text" name="fname" placeholder="Име" class="default" id="fname">
									<span class="err">
										!
									</span>
									<span class="succ">
										✓
									</span>
								</label>
							</div>
							<div class="col-5"  style="padding-left: 5px;">
								<label class="input-holder">
									<input type="text" name="lname" placeholder="Фамилия" class="default" id="lname">
									<span class="err">
										!
									</span>
									<span class="succ">
										✓
									</span>
								</label>
							</div>
						</div>
					</fieldset>
					<fieldset>
						<legend>Поща</legend>
						<label class="input-holder" id="reg-check">
							<input type="email" name="email" placeholder="Електронна поща" class="default" id="email">
							<span class="err">
								!
							</span>
							<span class="succ">
								✓
							</span>
							<span class="load">
								X
							</span>
						</label>
					</fieldset>
					<fieldset>
						<legend>Създай парола</legend>
						<label class="input-holder">
							<input type="password" name="password" placeholder="Твоята парола" class="default" id="pass">
							<span class="err">
								!
							</span>
							<span class="succ">
								✓
							</span>
						</label>
					</fieldset>
					<fieldset>
						<legend>Къде живееш ?</legend>
						<label class="input-holder">
							<input type="text" name="region" placeholder="Гр./с." class="default" id="region">
							<span class="err">
								!
							</span>
							<span class="succ">
								✓
							</span>
						</label>
					</fieldset>
					<input type="submit" name="regon" value="Регистрация">
					<input type="hidden" value="disabled" name="js-check" id="js">
				</div>
			</form>
		</section>
		<!--
		<footer class="land-footer">
			<span class="copyright">© 2017 Моят час! Всички права запазени.</span>
			<a href="#author" class="author">Уеб: Цветослав Гърков</a>
		</footer>
		-->
		<script src="js/register.js"></script>
	</body>
</html>