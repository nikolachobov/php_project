/***********************/
/* Update Post Script */
/*********************/

var posts = document.getElementsByClassName("posts")[0];

/* Update posts function */

function Update(type, key){
	var req = new XMLHttpRequest();
	if(type == "global"){
		req.open("GET", location.protocol + "//" + location.hostname + "/myhour/php/read03.php?type=global&key=" + key, true);
	}else{
		req.open("GET", location.protocol + "//" + location.hostname + "/myhour/php/read03.php?type=local&key=" + key, true);
	}
	// Display the posts
	req.onreadystatechange = function() {
		if (req.readyState == 4 && req.status == 200) {
			posts.innerHTML = req.responseText;
		}	
	}
	req.send();
}