<?php 
	session_start();
	
	include("../php/dbconfig.php");
	
	if(isset($_SESSION['user'])!="" ) {
		header("Location: ../pages/main.php");
		exit;
	}
	
	if(isset($_POST["email"]) && isset($_POST["pass"])){
		/* Email */	
		$email = $_POST["email"];
		$email = htmlspecialchars($email);
		$email = strip_tags($email);
		$email = mysql_real_escape_string($email);
		/* Password */	
		$pass = $_POST["pass"];
		$pass = htmlspecialchars($pass);
		$pass = strip_tags($pass);
		$pass = mysql_real_escape_string($pass);
		/* Search query */
		$query = "SELECT * FROM `users` WHERE `user_email` = '$email'";
		$res = mysql_query($query);
		$inf = mysql_fetch_assoc($res);
		$count = mysql_num_rows($res);
		
		if($count > 0 && $inf["user_pass"]==$pass){
			$_SESSION["user"] = $inf["user_id"];
			header("location: http://localhost/myhour/pages/main.php?type=global&key=" . $inf["user_key"]);
		}
	}
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Verify Acc</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Layout Style -->
		<link rel="stylesheet" type="text/css" href="../style/layout.css">
		<!-- Verify Style -->
		<link rel="stylesheet" type="text/css" href="../style/login.css">
		<!-- Form Style -->
		<link rel="stylesheet" type="text/css" href="../style/form.css">
	</head>
	<body>
		<div class="page-wrap">
			<form class="login-form" id="form" action="<?php echo $_SERVER["PHP_SELF"]; ?>" onsubmit="submitForm('log'); return false;" method="post" autocomplete="off">
				<div class="form-logo">
						<div class="logo">
							<img src="../img/logo.png" width="100" height="100" alt="">
						</div>
				</div>
				<div class="form">
					<fieldset>
						<label class="input-holder" id="log-check">
							<input type="email" name="email" placeholder="Електронна поща" value="<?php if(isset($email)){ echo $email; } ?>" class="default" id="email">
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
						<label class="input-holder">
							<input type="password" name="pass" placeholder="Парола" value="<?php if(isset($pass)){ echo $pass; } ?>" class="default" id="pass">
							<span class="err">
								!
							</span>
							<span class="succ">
								✓
							</span>
						</label>
					</fieldset>
					<input type="submit" name="regon" value="Влез">
				</div>
			</form>
		</div>
		<script src="../js/register.js"></script>
	</body>
</html>