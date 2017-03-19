/* Another Piece of code */
			
var btn = document.getElementById("mybtn");
var menu = document.getElementById("profile_menu");
			
var state = "close";
			
btn.onclick = function() {
	if(state == "open"){
		state = "close";
		menu.style.animationName = "close";
		setTimeout(function(){
			menu.style.display = "none";
		}, 350);
	}else{
		state = "open";
		menu.style.animationName = "open";
		menu.style.display = "block";
	}
}
			