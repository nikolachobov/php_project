/* Modal JS */

var wrapper = document.getElementsByClassName("modals")[0];

var subWrapper = document.getElementsByClassName("subModals")[0];
			
window.onclick = function(event) {
	if (event.target == subWrapper) {
		var prompts = document.getElementsByClassName("modal");
		
		var count = prompts.length;
		console.log(count);
		
		for(var i = 1; i < count; i++){
			prompts[i].style.animationName = "up";
			
			prompts[i].style.display = "none";
		}
		
		subWrapper.style.opacity = "0";
		setTimeout(function(){
			subWrapper.style.display = "none";
		}, 600);
	}else if(event.target == wrapper){
		var prompt = document.getElementsByClassName("modal")[0];
		
		prompt.style.animationName = "up";
		
		setTimeout(function(){
			prompt.style.display = "none";
		}, 300);
		
		wrapper.style.opacity = "0";
		setTimeout(function(){
			wrapper.style.display = "none";
		}, 600);
	}
}
			
function showModal(modal){
	var prompt = document.getElementsByClassName("modal")[(modal - 1)];
	
	prompt.style.display = "block";
	prompt.style.animationName = "down";
	if(modal == 1){
		wrapper.style.opacity = "1";
		wrapper.style.display = "block";
	}else if(modal > 1){
		subWrapper.style.opacity = "1";
		subWrapper.style.display = "block";
	}
}
			
function hideModal(modal){
	var prompt = document.getElementsByClassName("modal")[(modal - 1)];
	
	prompt.style.animationName = "up";
	
	setTimeout(function(){
			prompt.style.display = "none"; 
		},400);
	
	if(modal == 1){
		wrapper.style.opacity = "0";
		setTimeout(function(){
			wrapper.style.display = "none";
		}, 300);
	}else if(modal > 1){
		subWrapper.style.opacity = "0";
		setTimeout(function(){
			subWrapper.style.display = "none";
		}, 300);
	}
	/*
	setTimeout(function(){
			wrapper.style.display = "none";
		}, 600);
	*/
}