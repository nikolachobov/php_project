/* Upload Js */

function uploadFile(elem){
	var file = document.getElementsByClassName("uploadForm")[(elem - 1)].querySelectorAll(".upload-btn input[type='file']")[0].files[0];
	var profile = document.getElementById("profile");
	
	if(file){
		var req = new XMLHttpRequest();
					
		var values = new FormData();
					
		values.append("file", file);
		values.append("profile", profile.value);
		
		req.open("POST", location.protocol + "//" + location.hostname + "/myhour/php/uploadPhoto.php", true);
		req.send(values);
		
		/* Response Message */
		req.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				if(this.responseText != "true"){
					console.log(this.responseText);
				}else{
					hideModal(1);
					resetUpload(1);
					location.reload();
				}
			}
		}
	}else{
		console.log("Upload a file first");
	}
}

function showUpload(elem){
	
	var wrap = elem.parentElement.querySelectorAll("img")[0];
	var file = elem.files[0];
	
	var reader = new FileReader();
	
	reader.onload = function(){
		wrap.src = reader.result;
	}
	
	if(file){
		reader.readAsDataURL(file);
	}
}

function resetUpload(elem){
	window.setTimeout(function(){
		var form = document.getElementsByClassName("uploadForm")[(elem - 1)];
		form.getElementsByClassName("upload-btn")[0].querySelectorAll("img")[0].src = "../img/file.svg";
		form.reset();
	}, 100);
}