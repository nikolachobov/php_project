/* Post Js */

function commentPost(form, id){
	
	var comment = form.getElementsByTagName('textarea')[0];
	
	console.log(comment);
	
	if(comment.value != ""){
		createComment(form, id);
	}else{
		console.log("Fill all the fields");
	}
}

function createComment(form, id){
	/*****************************************************/
	/* Group Of the needed values */
	var author = form.getElementsByClassName('author')[0].value;
	var comment = form.getElementsByClassName('comment')[0].value;

	/***************************************************/
	var req = new XMLHttpRequest();
	/***************************************************/
	var values = "author=" + author + "&comment=" + comment + "&post_id=" + id;
	/***************************************************/
	req.open("POST", location.protocol + "//" + location.hostname + "/myhour/php/comment.php", true);
	
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.onreadystatechange = function() {
        if (req.readyState == 4 && req.status == 200) {
			if(req.responseText == "true"){
				console.log("Posted" + id);
				form.reset();
				showComments(form, id);
			}else{
				console.log(this.responseText);
			}
       }
    };
	req.send(values);
}

function showComments(form, id){
	
	console.log(form);
	
	var comments = form.parentElement.getElementsByClassName("comments")[0];
		
	var req = new XMLHttpRequest();
	var values = "post_id=" + id;
	req.open("POST", location.protocol + "//" + location.hostname + "/myhour/php/showComments.php", true);
		
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.onreadystatechange = function() {
		if (req.readyState == 4 && req.status == 200) {
			comments.innerHTML = this.responseText;
		}
	};
	req.send(values);
}