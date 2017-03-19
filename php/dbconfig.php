<?php 
	define("name", "root");
	define("pass", "");
	define("host", "localhost");
	define("dbname", "social");
	
	$conn = mysql_connect(host, name, pass);
	
	if(!$conn){
		die("Failed to connect. Error: " . mysql_error());
	}
	
	$select = mysql_select_db(dbname, $conn);
	
	if(!$select){
		die("Failed to select the given database. Error: " . mysql_error());
	}
?>