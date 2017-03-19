/* Form Validation */

window.onload = function() {
	var inp = document.getElementById("form").getElementsByTagName("input");
	var sel = document.getElementById("form").getElementsByTagName("select");
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var count1 = inp.length;
	var count2 = sel.length;
	/* Input remove errors on focus */
	for(var i = 0; i < count1; i++){
		if(inp[i].type != "submit"){
			inp[i].onfocus = 
			function(){
				this.style.borderColor = "";
				this.parentElement.getElementsByClassName("err")[0].style.display = "none";
				this.parentElement.getElementsByClassName("succ")[0].style.display = "none";
			}
		}
	}
	/* Input validate */
	for(var i = 0; i < count1; i++){
		console.log(inp[i].className);
		if(inp[i].type != "submit"){
			inp[i].onblur = 
			function(){
				if(this.value == ""){
					console.log("Empty");
					this.className = "error-input";
					this.style.borderColor = "#D32F2F";
					this.parentElement.getElementsByClassName("succ")[0].style.display = "none";
					this.parentElement.getElementsByClassName("err")[0].style.display = "block";
				}else if(this.id == "email"){
					if(this.value.match(re) == null){
						this.className = "error-input";
						this.style.borderColor = "#D32F2F";
						this.parentElement.getElementsByClassName("succ")[0].style.display = "none";
						this.parentElement.getElementsByClassName("err")[0].style.display = "block";
					}else if(this.parentElement.id == "reg-check"){
						this.style.borderColor = "#D32F2F";
						this.parentElement.getElementsByClassName("load")[0].style.display = "block";
						checkMail(this.value, this.parentElement, "regon");
					}else if(this.parentElement.id == "log-check"){
						this.style.borderColor = "#D32F2F";
						this.parentElement.getElementsByClassName("load")[0].style.display = "block";
						checkMail(this.value, this.parentElement, "logon");
					}
				}else if(this.id == "pass" && this.value.length < 5){
					console.log("Password should be at least 5 charecters long");
					this.className = "error-input";
					this.style.borderColor = "#D32F2F";
					this.parentElement.getElementsByClassName("succ")[0].style.display = "none";
					this.parentElement.getElementsByClassName("err")[0].style.display = "block";
				}else{
					console.log("Full");
					this.className = "no-error-input";
					this.style.borderColor = "#F57C00";
					this.parentElement.getElementsByClassName("err")[0].style.display = "none";
					this.parentElement.getElementsByClassName("succ")[0].style.display = "block";
				}
			};
		}
	}
	for(var i = 0; i < count2; i++){
		console.log(sel[i].className);
		sel[i].onchange = 
		function(){
			if(this.value == "default"){
				console.log("Empty");
				this.className = "error-input";
				this.style.borderColor = "#D32F2F";
				this.parentElement.getElementsByClassName("sel")[0].style.display = "none";
				this.parentElement.getElementsByClassName("succ")[0].style.display = "none";
				this.parentElement.getElementsByClassName("err")[0].style.display = "block";
			}else{
				console.log("Full");
				this.className = "no-error-input";
				this.style.borderColor = "#F57C00";
				this.parentElement.getElementsByClassName("sel")[0].style.display = "none";
				this.parentElement.getElementsByClassName("err")[0].style.display = "none";
				this.parentElement.getElementsByClassName("succ")[0].style.display = "block";
			}
		}
	}
}

function checkMail(input_val, elem, type){
	var req = new XMLHttpRequest();
	var values = "email=" + input_val; 
	req.open("POST", location.protocol + "//" + location.hostname + "/myhour/php/mail.php", true);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.onreadystatechange = function() {
        if (req.readyState == 4 && req.status == 200) {
			console.log("Response");
			elem.getElementsByClassName("load")[0].style.display = "none";
			if(type == "regon"){
				if(req.responseText == "true"){
					console.log("Email is Registered!");
					elem.getElementsByTagName("input")[0].className = "error-input";
					elem.getElementsByTagName("input")[0].style.borderColor = "#D32F2F";
					elem.getElementsByClassName("err")[0].style.display = "block";
				}else{
					console.log("Email is not Registered");
					elem.getElementsByTagName("input")[0].className = "no-error-input";
					elem.getElementsByTagName("input")[0].style.borderColor = "#F57C00";
					elem.getElementsByClassName("succ")[0].style.display = "block";
				}
			}else{
				if(req.responseText == "true"){
					console.log("Email is Registered!");
					elem.getElementsByTagName("input")[0].className = "no-error-input";
					elem.getElementsByTagName("input")[0].style.borderColor = "#F57C00";
					elem.getElementsByClassName("succ")[0].style.display = "block";
				}else{
					console.log("Email is not Registered");
					elem.getElementsByTagName("input")[0].className = "error-input";
					elem.getElementsByTagName("input")[0].style.borderColor = "#D32F2F";
					elem.getElementsByClassName("err")[0].style.display = "block";
				}
			}
       }
    };
	req.send(values);
}

/*********************/
/* Submission Check */
/*******************/

function submitForm(type){
	var form = document.getElementById("form");
	var inp = document.getElementById("form").getElementsByTagName("input");
	var sel = document.getElementById("form").getElementsByTagName("select");
	var count1 = inp.length;
	var count2 = sel.length;
	var err = 0;
	for(var i = 0; i < count1; i++){
		if(inp[i].className == "default" || inp[i].className == "error-input" || inp[i].value == ""){
			console.log("Fill all the fields");
			inp[i].className = "error-input";
			inp[i].style.borderColor = "#D32F2F";
			inp[i].parentElement.getElementsByClassName("err")[0].style.display = "block";
			err++;
		}
	}
	for(var i = 0; i < count2; i++){
		if(sel[i].className == "default" || sel[i].className == "error-input" || sel[i].value == "default"){
			console.log("Fill all the fields");
			sel[i].className = "error-input";
			sel[i].style.borderColor = "#D32F2F";
			sel[i].parentElement.getElementsByClassName("err")[0].style.display = "block";
			err++;
		}
	}
	if(err > 0){
		return false;
	}else if(type == "log"){
		console.log("Submitted log");
		form.submit();
	}else{
		console.log("Submitted");
		regon();
	}
}

/*************************/
/* Submission Functions */
/***********************/

function regon(){
	/*****************************************************/
	/* Group Of the needed values */
	var type = document.getElementById("type").value;
	var fname = document.getElementById("fname").value;
	var lname = document.getElementById("lname").value;
	var email = document.getElementById("email").value;
	var pass = document.getElementById("pass").value;
	var region = document.getElementById("region").value;
	/****************************************************/
	var req = new XMLHttpRequest();
	/***************************************************/
	var values = "type=" + type + "&fname=" + fname + "&lname=" + lname + "&email=" + email + "&pass=" + pass + "&region=" + region; 
	/**************************************************/
	req.open("POST", location.protocol + "//" + location.hostname + "/myhour/php/register.php", true);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.onreadystatechange = function() {
        if (req.readyState == 4 && req.status == 200) {
			if(req.responseText == "true"){
				window.location = "pages/login.php";
			}else{
				console.log("Fail");
			}
       }
    };
	req.send(values);
}

function logon(){
	/*****************************************************/
	/* Group Of the needed values */
	var email = document.getElementById("email").value;
	var pass = document.getElementById("pass").value;
	/****************************************************/
	var req = new XMLHttpRequest();
	/***************************************************/
	var values = "email=" + email + "&pass=" + pass; 
	/**************************************************/
	req.open("POST", location.protocol + "//" + location.hostname + "/myhour/php/login.php", true);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.onreadystatechange = function() {
        if (req.readyState == 4 && req.status == 200) {
			if(req.responseText == "true"){
				window.location = "main.php";
			}else{
				console.log("Fail");
			}
       }
    };
	req.send(values);
}