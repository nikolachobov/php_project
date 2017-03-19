/**************/
/* Logout Js */
/************/


function Logout(){
	var req = new XMLHttpRequest();
	req.open("POST", location.protocol + "//" + location.hostname + "/myhour/php/logout.php", true);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.onreadystatechange = function() {
		if (req.readyState == 4 && req.status == 200) {
			if(req.responseText){
				window.location = location.protocol + "//" + location.hostname + "/myhour/index.php";
			}else{
				console.log("Fail");
			}
		}	
	}
	req.send();
}