/* Post Js */

var post_box = document.getElementById("post_box"), content = post_box.getElementsByTagName("textarea")[0], icon = post_box.getElementsByClassName("err-icon")[0], loader = post_box.getElementsByClassName("uploadLoader")[0], submit = document.getElementById("submit_post");

var img = [];
var vid = [];

function submitPost(){
	if(content.value != ""){
		createPost();
	}else{
		console.log("Fill all the fields");
		content.style.borderColor = "#D32F2F";
		icon.style.display = "block";
	}
}

function resetPost(){
	var dsp = document.getElementById("showPhoto");
	var dsp1 = document.getElementById("showVideo");
	dsp.innerHTML = "";
	dsp1.innerHTML = "";
	post_box.reset();
	img.splice(0, img.length);
	console.log(img);
	vid.splice(0, vid.length);
	icon.style.display = "none";
	content.style.borderColor = "";
}

function createPost(){
	/*****************************************************/
	/* Group Of the needed values */
	var author = document.getElementById("author").value;
	var content = document.getElementById("content").value;
	var category = document.getElementById("category").value;
	/***************************************************/
	var req = new XMLHttpRequest();
	/***************************************************/
	var values = new FormData();
	
	values.append("author", author);
	values.append("content", content);
	values.append("category", category);
	
	if(img.length > 0 || vid.length > 0){
		var file = img.concat(vid);
		
		console.log("Kachena e snimka ili video");
		console.log(file);
		for(var i = 0; i < file.length; i++){
			console.log(file[i]);
			values.append("files[]", file[i]);
		}
	}else{
		console.log("Ne e kachena snimka ili video");
	}
	
	/***************************************************/
	req.open("POST", location.protocol + "//" + location.hostname + "/myhour/php/create-post.php", true);
	req.onreadystatechange = function() {
        if (req.readyState == 4 && req.status == 200) {
			if(req.responseText == "true"){
				console.log("Posted");
				loader.style.display = "none";
				submit.disabled = false;
				hideModal(1);
				resetPost();
				updatePosts();
			}else{
				loader.style.display = "none";
				console.log(this.responseText);
			}
       }
    };
	req.send(values);
	
	loader.style.display = "block";
	submit.disabled = true;
}

/****************/
/* New DEVELOP */
/**************/

function handleFiles(files,type){
	if(type == "photo"){
		for(var i = 0; i < files.length; i++) {
			img[i] = files[i];
		}
		
		hideModal(2);
		showFiles();
		console.log(img);
	}else if(type == "video"){
		for(var i = 0; i < files.length; i++) {
			vid[i] = files[i];
		}
		
		hideModal(2);
		showVid();
		console.log(vid);
	}
}


function showFiles(){
	var dsp = document.getElementById("showPhoto");
	console.log(img.length);
	var files = "";
	
	for(var k = 0; k < img.length; k++){
		var url = URL.createObjectURL(img[k]);
		files += "<li>" +
							"<div class='uploadBox-cont' style='background-image: url(" + url + "); background-size: cover;'>" +
							"</div>" +
							"<div class='uploadBox-actions'>" +
								"<button class='btn-3' onclick='removeFile(this.parentNode.parentNode," + k + ")'><span class='icon normal close'></span></button>" + 
							"</div>" + 
						"</li>";
	}
	
	dsp.innerHTML = files;
}

function showVid(){
	var dsp = document.getElementById("showVideo");
	console.log(vid.length);
	var files = "";
	
	for(var k = 0; k < vid.length; k++){
		var url = URL.createObjectURL(vid[k]); 
		files += "<li>" +
						"<audio controls>" + 
						"<source src='" + url + "'>" + 
						"</audio>" +
					"</li>";
	}
	
	dsp.innerHTML = files;
}

function removeFile(elem, data_id){
	elem.parentNode.removeChild(elem);
	img.splice(data_id, 1);
	console.log(img);
}
