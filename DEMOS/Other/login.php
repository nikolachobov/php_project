<?php 
	session_start();
	
	if(isset($_SESSION['user'])!="" ) {
		header("Location: ../pages/main.php");
		exit;
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
			<form class="login-form" id="form" action="no-js.html" method="post" onsubmit="submitForm('log'); return false;" autocomplete="off">
				<div class="form-logo">
						<div class="logo">
							<img src="../img/logo.png" width="100" height="100" alt="">
						</div>
				</div>
				<div class="form">
					<fieldset>
						<label class="input-holder" id="log-check">
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
						<label class="input-holder">
							<input type="password" name="pass" placeholder="Парола" class="default" id="pass">
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