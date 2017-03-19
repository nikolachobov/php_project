<?php 
	session_start();
	include("dbconfig.php");
	
	if(isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["email"]) && isset($_POST["pass"]) && isset($_POST["region"]) && isset($_POST["type"])){
		/* First Name */
		$fname = trim($_POST["fname"]);
		$fname = htmlspecialchars($fname);
		$fname = strip_tags($fname);
		$fname = mysql_real_escape_string($fname);
		/* Last Name */
		$lname = trim($_POST["lname"]);
		$lname = htmlspecialchars($lname);
		$lname = strip_tags($lname);
		$lname = mysql_real_escape_string($lname);
		/* Email */	
		$email = trim($_POST["email"]);
		$email = htmlspecialchars($email);
		$email = strip_tags($email);
		$email = mysql_real_escape_string($email);
		/* Password */	
		$pass = trim($_POST["pass"]);
		$pass = htmlspecialchars($pass);
		$pass = strip_tags($pass);
		$pass = mysql_real_escape_string($pass);
		/* Region */		
		$region = trim($_POST["region"]);
		$region = htmlspecialchars($region);
		$region = strip_tags($region);
		$region = mysql_real_escape_string($region);
		/* Account Type */
		$type = trim($_POST["type"]);
		$type = htmlspecialchars($type);
		$type = strip_tags($type);
		$type = mysql_real_escape_string($type);
		/* Execute query */
		if($type == "student"){
			$query = "INSERT INTO users
					(`user_fname`, `user_lname`, `user_pass`, `user_email`, `user_region`) 
					VALUES 
					('$fname', '$lname', '$pass', '$email', '$region')";
			$res = mysql_query($query);
		}elseif($type == "teacher"){
			$query = "INSERT INTO users
					(`user_fname`, `user_lname`, `user_pass`, `user_email`, `user_region`, `type`) 
					VALUES 
					('$fname', '$lname', '$pass', '$email', '$region', 'b')";
			$res = mysql_query($query);
		}
		
		if($res){
			$gen = mysql_query("SELECT `user_id` FROM users WHERE `user_email`='$email'");
			/* Get the user ID */
			$inf = mysql_fetch_assoc($gen);
			/* User Id */
			$id = $inf["user_id"];
			/* Generate the public Key */
			$key = publicKey($id);
			/* Update the public Key */
			$add = mysql_query("UPDATE `users` SET `user_key`='$key' WHERE `user_id`='$id'");
			$img = mysql_query("INSERT INTO `profile_pictures` (`user`) VALUES ('$id')");
			
			if($add && $img){
				echo "true";
			}else{
				echo "false";
			}
		}else{
			echo "false";
		}
	}else{
		echo "false";
	}
	
	function publicKey($id){
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		
		$code = hash("md5", substr(str_shuffle($chars),0,5) . "_" . $id);
		
		return $code;
	}
?>