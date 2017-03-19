/* Player JS */

function playVid(btn){
	var audio = btn.parentElement.parentElement.parentElement.parentElement.parentElement.getElementsByTagName("audio")[0];
				
	if(audio.paused){
		audio.play();
		btn.firstElementChild.classList.remove("play");
		btn.firstElementChild.classList.add("pause");
	}else{
		audio.pause();
		btn.firstElementChild.classList.remove("pause");
		btn.firstElementChild.classList.add("play");
	}
}
			
function replayVid(btn){
	var audio = btn.parentElement.parentElement.parentElement.parentElement.parentElement.getElementsByTagName("audio")[0];
				
	if(audio.ended){
		audio.currentTime = 0;
		audio.play();
	}else{
		audio.currentTime = 0;
	}
}
			
function seekVid(range){
	var audio = range.parentElement.parentElement.parentElement.getElementsByTagName("audio")[0];
				
	var seekto = audio.duration * (range.value / 100);
				
	audio.currentTime = seekto;
	audio.play();
}
			
function changeVolume(btn){
	var audio = btn.parentElement.parentElement.parentElement.parentElement.parentElement.getElementsByTagName("audio")[0];
				
	if(audio.volume == 1.0){
		audio.volume = 0.5;
		btn.firstElementChild.classList.remove("volume-up");
		btn.firstElementChild.classList.add("volume-down");
	}else if(audio.volume == 0.5){
		audio.volume = 0.0;
		btn.firstElementChild.classList.remove("volume-down");
		btn.firstElementChild.classList.add("volume-off");
	}else{
		audio.volume = 1.0;
		btn.firstElementChild.classList.remove("volume-off");
		btn.firstElementChild.classList.add("volume-up");
	}
} 
			
function changeRange(vid){
	var range = vid.parentElement.getElementsByClassName("range")[0];
				
	range.value = vid.currentTime * (100 / vid.duration);
}